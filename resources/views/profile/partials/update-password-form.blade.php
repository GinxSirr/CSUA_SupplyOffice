<section class="win-panel">
    <div class="win-titlebar mb-4">
        🔐 Update Password
    </div>

    <div class="p-4">
        <p class="text-sm text-gray-700 mb-4">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>

        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div>
                <label for="update_password_current_password" class="block font-bold text-gray-700 mb-2">{{ __('Current Password') }}:</label>
                <input id="update_password_current_password" name="current_password" type="password" class="win-input w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password" class="block font-bold text-gray-700 mb-2">{{ __('New Password') }}:</label>
                <input id="update_password_password" name="password" type="password" class="win-input w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block font-bold text-gray-700 mb-2">{{ __('Confirm Password') }}:</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="win-input w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-300">
                <button type="submit" class="win-button-primary px-6 py-2">💾 {{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
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
