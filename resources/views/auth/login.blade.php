<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">LaporPak!</h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Masuk ke Akun Anda</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif

                    <x-primary-button class="bg-red-600 hover:bg-red-700">
                        Masuk
                    </x-primary-button>
                </div>

                <div class="mt-6 text-center border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-red-600 hover:text-red-700 font-semibold">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
