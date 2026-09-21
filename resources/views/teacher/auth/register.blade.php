<x-teacher-layout title="Teacher registration">
    <h1 class="mb-2 text-center text-2xl font-bold text-[#7D3C98]">Create teacher account</h1>
    <p class="mb-8 text-center text-sm text-gray-600">Set up the site's teacher account.</p>

    <form method="POST" action="{{ route('teacher.register.store') }}" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username"
                maxlength="255" required autofocus placeholder="yourname@rsu.ac.th"
                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                @error('email') aria-describedby="email-error" @enderror
                class="w-full rounded-md border border-gray-400 px-4 py-2.5 placeholder-gray-400 focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-[#b085c2]" />
            @error('email')
                <p id="email-error" class="text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input id="password" type="password" name="password" autocomplete="new-password" minlength="8" maxlength="72" required
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                aria-describedby="password-hint{{ $errors->has('password') ? ' password-error' : '' }}"
                class="w-full rounded-md border border-gray-400 px-4 py-2.5 focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-[#b085c2]" />
            <p id="password-hint" class="text-xs text-gray-500">Use at least 8 characters.</p>
            @error('password')
                <p id="password-error" class="text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" minlength="8" maxlength="72" required
                class="w-full rounded-md border border-gray-400 px-4 py-2.5 focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-[#b085c2]" />
        </div>

        <button type="submit" class="w-full rounded-md bg-[#7D3C98] py-3 font-medium text-white transition hover:bg-[#701b94] focus:outline-none focus:ring-2 focus:ring-[#b085c2] focus:ring-offset-2">
            Create Account
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('teacher.login') }}" class="font-medium text-[#7D3C98] underline-offset-4 hover:underline">Log in</a>
    </p>
</x-teacher-layout>
