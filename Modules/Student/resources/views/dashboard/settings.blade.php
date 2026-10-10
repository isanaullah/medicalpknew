@extends('student::dashboard.layouts.app')

@section('title', 'Settings')
@section('page_title', 'Settings')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Settings</h1>
    <p class="text-gray-500 text-sm mt-1">Manage your account settings</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Settings -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Profile Information</h2>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('student.settings.profile') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email"
                           id="email"
                           value="{{ $user->email }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed"
                           disabled>
                    <p class="text-xs text-gray-400 mt-1">Email cannot be changed</p>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition-colors">
                    Update Profile
                </button>
            </form>
        </div>
    </div>

    <!-- Account Info -->
    <div>
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Account Info</h2>

            <div class="space-y-3">
                <div>
                    <p class="text-xs text-gray-500">Member Since</p>
                    <p class="text-sm font-medium text-gray-800">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Role</p>
                    <p class="text-sm font-medium text-gray-800">Student</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Status</p>
                    <span class="inline-block text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded">Active</span>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-medium px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
