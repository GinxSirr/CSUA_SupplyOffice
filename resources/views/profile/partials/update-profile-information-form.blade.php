<section class="win-panel">
    <div class="win-titlebar mb-4">
        👤 Profile Information
    </div>

    <div class="p-4">
        <p class="text-sm text-gray-700 mb-4">
            {{ __("Update your account's profile information and email address.") }}
        </p>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block font-bold text-gray-700 mb-2">{{ __('Name') }}:</label>
                <input id="name" name="name" type="text" class="win-input w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="username" class="block font-bold text-gray-700 mb-2">{{ __('Username') }}:</label>
                <input id="username" name="username" type="text" class="win-input w-full" value="{{ old('username', $user->username) }}" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                <p class="mt-1 text-xs text-gray-600">Username can only contain letters, numbers, and underscores</p>
            </div>

            <div>
                <label for="email" class="block font-bold text-gray-700 mb-2">{{ __('Email') }}:</label>
                <input id="email" name="email" type="email" class="win-input w-full" value="{{ old('email', $user->email) }}" required autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="win-groupbox mt-3">
                        <div class="win-groupbox-title">⚠ Email Verification</div>
                        <p class="text-sm text-gray-700">
                            {{ __('Your email address is unverified.') }}
                        </p>
                        <button form="send-verification" class="text-sm text-blue-600 hover:text-blue-800 hover:underline mt-2">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-semibold text-sm text-green-700">
                                ✓ {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-300">
                <button type="submit" class="win-button-primary px-6 py-2">💾 {{ __('Save') }}</button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-700 font-semibold"
                    >✓ {{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
