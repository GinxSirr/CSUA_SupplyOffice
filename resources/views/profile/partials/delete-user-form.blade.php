<section class="win-panel">
    <div class="win-titlebar mb-4">
        ⚠ Delete Account
    </div>

    <div class="p-4">
        <div class="win-groupbox bg-red-50 border-red-500 mb-4">
            <div class="win-groupbox-title">⚠ Warning</div>
            <p class="text-sm text-gray-700">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>

        <button
            type="button"
            class="win-button bg-red-600 hover:bg-red-700 text-black px-6 py-2"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >🗑 {{ __('Delete Account') }}</button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <div class="win-titlebar mb-4">
                    ⚠ Confirm Account Deletion
                </div>

                <div class="win-panel bg-red-50 border-red-500 p-4 mb-4">
                    <p class="font-bold text-red-800 mb-2">
                        {{ __('Are you sure you want to delete your account?') }}
                    </p>
                    <p class="text-sm text-gray-700">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-bold text-gray-700 mb-2">{{ __('Password') }}:</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="win-input w-full"
                        placeholder="{{ __('Enter your password') }}"
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" class="win-button px-6 py-2" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="win-button bg-red-600 hover:bg-red-700 text-black px-6 py-2">
                        🗑 {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </x-modal>
    </div>
</section>
