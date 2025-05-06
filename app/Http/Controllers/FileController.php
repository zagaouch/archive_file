<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FileController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = auth()->user()->files();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by file extension
        if ($request->has('extension') && $request->input('extension') != '') {
            $query->where('extension', $request->input('extension'));
        }

        // Sorting functionality
        switch ($request->input('sort', 'newest')) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'size_asc':
                $query->orderBy('size', 'asc');
                break;
            case 'size_desc':
                $query->orderBy('size', 'desc');
                break;
        }

        // Get unique extensions for filter dropdown
        $extensions = auth()->user()->files()
                        ->select('extension')
                        ->distinct()
                        ->pluck('extension');

        $files = $query->paginate(10)->withQueryString();

        return view('files.index', [
            'files' => $files,
            'extensions' => $extensions
        ]);
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // 20MB max
            'description' => 'nullable|string|max:255'
        ]);

        $uploadedFile = $request->file('file');
        
        $path = $uploadedFile->storeAs(
            'uploads',
            Str::random(40).'.'.$uploadedFile->getClientOriginalExtension(),
            'public'
        );

        auth()->user()->files()->create([
            'name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'extension' => $uploadedFile->getClientOriginalExtension(),
            'size' => $uploadedFile->getSize(),
            'description' => $request->description
        ]);

        return redirect()->route('files.index')
               ->with('success', 'File uploaded successfully');
    }

    public function show(File $file)
    {
        $this->authorize('view', $file);
        return view('files.show', compact('file'));
    }

    public function download(File $file)
    {
        $this->authorize('download', $file);
        
        $filePath = storage_path('app/public/'.$file->path);
        
        if (!file_exists($filePath)) {
            Log::error("File not found: {$file->path}");
            abort(404, 'The requested file does not exist');
        }

        return response()->download($filePath, $file->name);
    }

    public function destroy(File $file)
    {
        $this->authorize('delete', $file);
        
        try {
            Storage::disk('public')->delete($file->path);
            $file->delete();
            
            return back()->with('success', 'File deleted successfully');
        } catch (\Exception $e) {
            Log::error("File deletion failed: {$e->getMessage()}");
            return back()->with('error', 'Failed to delete file');
        }
    }
}