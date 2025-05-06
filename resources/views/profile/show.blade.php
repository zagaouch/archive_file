@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#FDEEEF] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">User Profile</h2>
                
                <div class="space-y-4">
                    <!-- Profile Photo -->
                    <div class="flex items-center">
                        <div class="mr-4">
                            @if($user->profile_photo_path)
                                <img class="h-16 w-16 rounded-full object-cover" 
                                     src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                                     alt="{{ $user->name }}">
                            @else
                                <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500 text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Registered Since</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $user->created_at->format('F j, Y') }}
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Login</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="mt-8">
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection