<x-guest-layout>
    <div class="win-titlebar">
        📝 Register for Supply Office System
    </div>

    <div class="p-6">
        <!-- Errors -->
        @if ($errors->any())
            <div class="win-panel bg-red-100 border-red-500 mb-4 p-3">
                <p class="font-bold text-red-800">⚠ Registration Failed</p>
                @foreach ($errors->all() as $error)
                    <p class="text-red-700 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-bold mb-2">Full Name:</label>
                <input
                    id="name"
                    class="win-input w-full"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                />
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block font-bold mb-2">Username:</label>
                <input
                    id="username"
                    class="win-input w-full"
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autocomplete="username"
                    placeholder="Enter your username"
                />
                <p class="text-xs text-gray-600 mt-1">Username can only contain letters, numbers, and underscores</p>
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block font-bold mb-2">Email Address:</label>
                <input
                    id="email"
                    class="win-input w-full"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="Enter your email"
                />
            </div>

            <!-- Department -->
            <div class="mb-4">
                <label for="department" class="block font-bold mb-2">Department:</label>
                <input
                    id="department"
                    class="win-input w-full"
                    type="text"
                    name="department"
                    value="{{ old('department') }}"
                    placeholder="Enter your department"
                />
            </div>

            <!-- Position -->
            <div class="mb-4">
                <label for="position" class="block font-bold mb-2">Position:</label>
                <input
                    id="position"
                    class="win-input w-full"
                    type="text"
                    name="position"
                    value="{{ old('position') }}"
                    placeholder="Enter your position"
                />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-bold mb-2">Password:</label>
                <input
                    id="password"
                    class="win-input w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your password"
                />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-bold mb-2">Confirm Password:</label>
                <input
                    id="password_confirmation"
                    class="win-input w-full"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                />
            </div>

            <div class="win-groupbox p-4 mb-4 bg-blue-50">
                <div class="text-sm text-gray-700">
                    <p class="font-bold mb-2">ℹ Registration Information:</p>
                    <p>• New accounts are registered as <strong>Employee</strong> users</p>
                    <p>• You will be able to submit supply requests after registration</p>
                    <p>• Password must be at least 8 characters</p>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button type="submit" class="win-button-primary w-full">
                    ✓ Register Account
                </button>

                <a href="{{ route('login') }}" class="win-button w-full text-center">
                    ← Back to Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
