<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="student" {{ isset($role) && $role == 'business' ? '' : 'selected' }}>Student</option>
                <option value="business" {{ isset($role) && $role == 'business' ? 'selected' : '' }}>Business</option>
            </select>
        </div>

        <!-- Student-only fields -->
        @if(request()->get('role') != 'business')
            <div class="mt-4">
                <x-input-label for="skill_category" :value="__('Skill Category')" />
                <select id="skill_category" name="skill_category"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Category</option>
                    <option value="web_development">Web Development</option>
                    <option value="mobile_development">Mobile Development</option>
                    <option value="design">Design</option>
                    <option value="marketing">Digital Marketing</option>
                    <option value="data_entry">Data Entry</option>
                    <option value="writing">Content Writing</option>
                    <option value="sales">Sales</option>
                </select>
            </div>

            <div class="mt-4">
                <x-input-label for="skills" :value="__('Skills (comma separated)')" />
                <textarea id="skills" name="skills" rows="2" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                    placeholder="e.g., React, Python, Photoshop"></textarea>
            </div>

            <div class="mt-4">
                <x-input-label for="portfolio_url" :value="__('Portfolio/GitHub URL')" />
                <x-text-input id="portfolio_url" class="block mt-1 w-full" type="url" name="portfolio_url"
                    placeholder="https://github.com/username" />
            </div>

            <div class="mt-4">
                <x-input-label for="education_level" :value="__('Education Level')" />
                <select id="education_level" name="education_level"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Level</option>
                    <option value="undergraduate">Undergraduate</option>
                    <option value="graduate">Graduate</option>
                    <option value="masters">Master's</option>
                    <option value="phd">PhD</option>
                    <option value="diploma">Diploma</option>
                </select>
            </div>
        @endif

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>