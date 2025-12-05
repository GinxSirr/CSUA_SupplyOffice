<x-guest-layout>
    <div class="win-titlebar">
        🔐 Login to Supply Office System
    </div>

    <div class="p-6">
        <!-- Session Status -->
        @if (session('status'))
            <div class="win-panel bg-green-50 border-l-4 border-green-500 mb-4 p-3">
                <p class="text-green-800 font-semibold">✓ {{ session('status') }}</p>
            </div>
        @endif

        <!-- Errors -->
        @if ($errors->any())
            <div class="win-panel bg-red-50 border-l-4 border-red-500 mb-4 p-3">
                <p class="font-bold text-red-800 mb-1">⚠ Login Failed</p>
                @foreach ($errors->all() as $error)
                    <p class="text-red-700 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username or Email -->
            <div class="mb-4">
                <label for="login" class="block font-bold text-gray-700 mb-2">Username or Email:</label>
                <input
                    id="login"
                    class="win-input w-full"
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your username or email"
                />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-bold text-gray-700 mb-2">Password:</label>
                <input
                    id="password"
                    class="win-input w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center justify-between">
                <label class="inline-flex items-center cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="win-checkbox"
                        name="remember"
                    />
                    <span class="ms-2 text-sm text-gray-700">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Test Accounts Info -->
            <div class="win-groupbox mb-4">
                <div class="win-groupbox-title">📝 Test Accounts</div>
                <div class="text-xs text-gray-700 space-y-1">
                    <p><strong>Supply Officer:</strong> supplyofficer / supply123</p>
                    <p><strong>Employee:</strong> employee / employee123</p>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col gap-3">
                <button type="submit" class="win-button-primary w-full py-2.5">
                    🔓 Login
                </button>

                @if (Route::has('register'))
                    <div class="text-center pt-3 border-t border-gray-300">
                        <span class="text-sm text-gray-600">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline font-semibold ml-1">
                            Register here
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
