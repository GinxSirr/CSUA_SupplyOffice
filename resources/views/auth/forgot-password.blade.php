<x-guest-layout>
    <div class="win-titlebar">
        🔑 Forgot Password
    </div>

    <div class="p-6">
        <div class="win-groupbox p-4 mb-4 bg-blue-50">
            <p class="text-sm text-gray-700">
                Forgot your password? No problem. Enter your email address and we will send you a password reset link.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="win-panel bg-green-100 border-green-500 mb-4 p-3">
                <p class="text-green-800">{{ session('status') }}</p>
            </div>
        @endif

        <!-- Errors -->
        @if ($errors->any())
            <div class="win-panel bg-red-100 border-red-500 mb-4 p-3">
                <p class="font-bold text-red-800">⚠ Error</p>
                @foreach ($errors->all() as $error)
                    <p class="text-red-700 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

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
                    autofocus
                    placeholder="Enter your email"
                />
            </div>

            <div class="flex flex-col gap-3">
                <button type="submit" class="win-button-primary w-full">
                    📧 Send Password Reset Link
                </button>

                <a href="{{ route('login') }}" class="win-button w-full text-center">
                    ← Back to Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
