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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

        @if(Auth::user()->role === 'student')
        <div>
            <x-input-label for="skill_category" :value="__('Skill Category')" />
            <select id="skill_category" name="skill_category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Category</option>
                <option value="web_development" {{ old('skill_category', $user->skill_category) == 'web_development' ? 'selected' : '' }}>Web Development</option>
                <option value="mobile_development" {{ old('skill_category', $user->skill_category) == 'mobile_development' ? 'selected' : '' }}>Mobile Development</option>
                <option value="design" {{ old('skill_category', $user->skill_category) == 'design' ? 'selected' : '' }}>Design</option>
                <option value="marketing" {{ old('skill_category', $user->skill_category) == 'marketing' ? 'selected' : '' }}>Digital Marketing</option>
                <option value="data_entry" {{ old('skill_category', $user->skill_category) == 'data_entry' ? 'selected' : '' }}>Data Entry</option>
                <option value="writing" {{ old('skill_category', $user->skill_category) == 'writing' ? 'selected' : '' }}>Content Writing</option>
                <option value="sales" {{ old('skill_category', $user->skill_category) == 'sales' ? 'selected' : '' }}>Sales</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('skill_category')" />
        </div>

        <div>
            <x-input-label for="skills" :value="__('Skills (comma separated)')" />
            <textarea id="skills" name="skills" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="e.g., React, Python, Photoshop">{{ old('skills', $user->skills) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        </div>

        <div>
            <x-input-label for="portfolio_url" :value="__('Portfolio/GitHub URL')" />
            <x-text-input id="portfolio_url" name="portfolio_url" type="url" class="mt-1 block w-full" :value="old('portfolio_url', $user->portfolio_url)" placeholder="https://github.com/username" />
            <x-input-error class="mt-2" :messages="$errors->get('portfolio_url')" />
        </div>

        <div>
            <x-input-label for="education_level" :value="__('Education Level')" />
            <select id="education_level" name="education_level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Level</option>
                <option value="undergraduate" {{ old('education_level', $user->education_level) == 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                <option value="graduate" {{ old('education_level', $user->education_level) == 'graduate' ? 'selected' : '' }}>Graduate</option>
                <option value="masters" {{ old('education_level', $user->education_level) == 'masters' ? 'selected' : '' }}>Master's</option>
                <option value="phd" {{ old('education_level', $user->education_level) == 'phd' ? 'selected' : '' }}>PhD</option>
                <option value="diploma" {{ old('education_level', $user->education_level) == 'diploma' ? 'selected' : '' }}>Diploma</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('education_level')" />
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>