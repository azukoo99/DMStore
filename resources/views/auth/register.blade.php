<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight font-outfit">Daftar Akun</h2>
        <p class="text-slate-650 dark:text-slate-400 text-sm mt-1.5">Bergabung untuk kemudahan top up diamond</p>
    </div>

    <form method="POST" action="{{ route('register') }}" autocomplete="off" id="register-form">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-0 sm:gap-4">
            <!-- Password -->
            <div class="mb-5">
                <x-input-label for="password" :value="__('Kata Sandi')" />
                <div class="relative flex items-center">
                    <x-text-input id="password" class="block mt-1 w-full pr-10"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"
                                    placeholder="Min 8 karakter" />
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 dark:hover:text-white transition-colors duration-200" id="toggle-password" aria-label="Tampilkan kata sandi">
                        <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <!-- Strength bar -->
                <div class="flex items-center justify-between text-[10px] text-slate-600 dark:text-slate-400 mt-2">
                    <span>Kekuatan sandi</span>
                    <div class="w-24 h-1.5 bg-slate-200 dark:bg-slate-950 rounded-full overflow-hidden ml-2">
                        <div id="strength-bar" class="h-full w-0 bg-rose-500 transition-all duration-300"></div>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-5">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Sandi')" />
                <div class="relative flex items-center">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Ulangi sandi" />
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 dark:hover:text-white transition-colors duration-200" id="toggle-confirm-password" aria-label="Tampilkan kata sandi">
                        <svg id="eye-confirm-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <span id="match-error" class="text-xs text-rose-600 dark:text-rose-400 font-medium mt-1.5 hidden flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" stroke-linecap="round"/>
                        <line x1="12" y1="16" x2="12.01" y2="16" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Sandi tidak sesuai
                </span>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="mb-6 mt-2">
            <x-primary-button>
                {{ __('Buat Akun Baru') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-slate-650 dark:text-slate-400">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-500 hover:text-blue-500 dark:hover:text-blue-400 font-bold transition-colors duration-200">
                Masuk Di Sini
            </a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Password toggle logic
            const setupToggle = (inputId, buttonId, iconId) => {
                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);
                const icon = document.getElementById(iconId);

                button.addEventListener('click', function () {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);

                    if (type === 'text') {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />';
                    } else {
                        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                    }
                });
            };

            setupToggle('password', 'toggle-password', 'eye-icon');
            setupToggle('password_confirmation', 'toggle-confirm-password', 'eye-confirm-icon');

            // Password strength meter
            const password = document.getElementById('password');
            const strengthBar = document.getElementById('strength-bar');

            password.addEventListener('input', function () {
                const value = password.value;
                let strength = 0;

                if (value.length >= 8) strength += 25;
                if (value.match(/[a-z]/) && value.match(/[A-Z]/)) strength += 25;
                if (value.match(/\d/)) strength += 25;
                if (value.match(/[^a-zA-Z\d]/)) strength += 25;

                strengthBar.style.width = strength + '%';

                if (strength <= 25) {
                    strengthBar.className = 'h-full w-0 bg-rose-500 transition-all duration-300';
                } else if (strength <= 75) {
                    strengthBar.className = 'h-full w-0 bg-amber-500 transition-all duration-300';
                } else {
                    strengthBar.className = 'h-full w-0 bg-emerald-500 transition-all duration-300';
                }
            });

            // Match confirmation password
            const confirmation = document.getElementById('password_confirmation');
            const matchError = document.getElementById('match-error');

            const checkMatch = () => {
                if (confirmation.value && password.value !== confirmation.value) {
                    matchError.classList.remove('hidden');
                    confirmation.classList.add('!border-rose-500/50', '!focus:ring-rose-500/20');
                } else {
                    matchError.classList.add('hidden');
                    confirmation.classList.remove('!border-rose-500/50', '!focus:ring-rose-500/20');
                }
            };

            password.addEventListener('keyup', checkMatch);
            confirmation.addEventListener('keyup', checkMatch);
        });
    </script>
</x-guest-layout>
