<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="p-1 flex justify-start gap-4 items-center">
            <div class="h-28 w-28">
                <img class="inline-block h-full w-full overflow-hidden object-cover object-center rounded-full ring-2 ring-white"
                src="{{ asset('storage/' . $user->profile_image) }}" alt="">
            </div>
            <div x-data="{ fileName: '', file: null }">
                <input type="file" name="profile_image" x-ref="fileInput" class="hidden"
                    @change="file = $event.target.files[0]; fileName = file ? file.name : ''" accept="image/*">
                <button type="button" class="bg-black text-white rounded-full py-2 px-4 focus:outline-none"
                    @click="$refs.fileInput.click()">
                    Edit Profile
                </button>
                <p x-text="fileName" class="mt-2 text-gray-700"></p>
                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
            </div>
        </div>


        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="role" :value="__('Jabatan')" />
            <select id="role" name="role_id"
                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        @if ($role == $user->role) selected @endif>
                        {{ $role->role }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" />
        </div>

        <div>
            <x-input-label for="job_as" :value="__('Status')" />
            <select id="job_as" name="job_as"
                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="ASN" {{ $user->job_as === 'ASN' ? 'selected' : '' }}>ASN</option>
                <option value="Non ASN" {{ $user->job_as === 'Non ASN' ? 'selected' : '' }}>Non ASN</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('job_as')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
