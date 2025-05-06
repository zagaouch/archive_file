@extends('layouts.app')

@section('content')
<div class="py-8 bg-[#FDEEEF] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Your Files</h2>
            <a href="{{ route('files.create') }}" 
               class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Upload New File
            </a>
        </div>

        <!-- Search and Filter Bar -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
            <form action="{{ route('files.index') }}" method="GET" class="space-y-4 sm:space-y-0 sm:flex sm:space-x-4">
                <!-- Search -->
                <div class="flex-1">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2"
                               placeholder="Search files...">
                    </div>
                </div>

                <!-- File Type Filter -->
                <div class="w-full sm:w-48">
                    <label for="extension" class="sr-only">File Type</label>
                    <select id="extension" name="extension"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">All Types</option>
                        @foreach($extensions as $ext)
                            <option value="{{ $ext }}" {{ request('extension') == $ext ? 'selected' : '' }}>{{ strtoupper($ext) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort By -->
                <div class="w-full sm:w-48">
                    <label for="sort" class="sr-only">Sort By</label>
                    <select id="sort" name="sort"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="size_asc" {{ request('sort') == 'size_asc' ? 'selected' : '' }}>Size (Smallest)</option>
                        <option value="size_desc" {{ request('sort') == 'size_desc' ? 'selected' : '' }}>Size (Largest)</option>
                    </select>
                </div>

                <!-- Submit and Reset -->
                <div class="flex space-x-2">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Apply
                    </button>
                    <a href="{{ route('files.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Files List -->
        @if($files->count() > 0)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="divide-y divide-gray-200">
                @foreach($files as $file)
                <div class="p-6 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <!-- File Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    .{{ $file->extension }}
                                </span>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 truncate">{{ $file->name }}</h3>
                                    @if($file->description)
                                    <p class="mt-1 text-sm text-gray-600">{{ $file->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-500">
                                <span>Uploaded {{ $file->created_at->diffForHumans() }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ number_format($file->size / 1024, 2) }} KB</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="ml-4 flex items-center space-x-4">
                             <a href="{{ route('files.download', $file) }}" 
                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Download
                            </a>
                            <form action="{{ route('files.destroy', $file) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No files found</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->hasAny(['search', 'extension']))
                    Try adjusting your search or filter criteria.
                @else
                    Get started by uploading a new file.
                @endif
            </p>
            <div class="mt-6">
                <a href="{{ route('files.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Upload File
                </a>
            </div>
        </div>
        @endif

        <!-- Pagination -->
        @if($files->hasPages())
        <div class="mt-8">
            {{ $files->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection