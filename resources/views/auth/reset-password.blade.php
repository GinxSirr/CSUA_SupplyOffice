<x-guest-layout>
    <div class="win-titlebar">
        🔐 Reset Password
    </div>

    <div class="p-6">
        <!-- Errors -->
        @if ($errors->any())
            <div class="win-panel bg-red-100 border-red-500 mb-4 p-3">
                <p class="font-bold text-red-800">⚠ Error</p>
                @foreach ($errors->all() as $error)
                    <p class="text-red-700 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block font-bold mb-2">Email Address:</label>
                <input
                    id="email"
                    class="win-input w-full"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email"
                />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-bold mb-2">New Password:</label>
                <input
                    id="password"
                    class="win-input w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter new password"
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
                    placeholder="Confirm new password"
                />
            </div>

            <button type="submit" class="win-button-primary w-full">
                ✓ Reset Password
            </button>
        </form>
    </div>
</x-guest-layout>
