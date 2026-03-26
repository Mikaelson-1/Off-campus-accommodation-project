<x-guest-layout>
    <x-slot name="title">Sign In — BOUESTI Off-Campus Accommodation</x-slot>

    <div class="bouesti-auth-wrapper">

        <!-- ── Brand Panel ─────────────────────────────────────────── -->
        <div class="bouesti-brand-panel">
            <div class="bouesti-logo-area">
                <div class="bouesti-logo-circle">B</div>
                <div class="bouesti-logo-title">BOUESTI</div>
                <div class="bouesti-logo-subtitle">Bells University of Technology — Off-Campus Accommodation System</div>
            </div>

            <div class="bouesti-brand-tagline">
                <p>Your verified <strong>off-campus accommodation</strong> marketplace — safe, secure, and student-focused.</p>
            </div>
        </div>

        <!-- ── Form Panel ──────────────────────────────────────────── -->
        <div class="bouesti-form-panel">
            <div class="bouesti-form-card">

                <h2>Welcome Back</h2>
                <p class="bouesti-form-desc">Sign in to continue to your dashboard</p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="bouesti-alert bouesti-alert-success">
                        ✓ {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bouesti-alert bouesti-alert-error">
                        ✕ {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="bouesti-field">
                        <label for="email">Email Address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="you@bouesti.edu.ng"
                        />
                        @error('email')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="bouesti-field">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me / Forgot Password -->
                    <div class="bouesti-check-row">
                        <label class="bouesti-check-label">
                            <input type="checkbox" name="remember" id="remember_me">
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="bouesti-link" style="font-size:.85rem;">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="bouesti-btn bouesti-btn-primary" id="loginBtn">
                        <span id="loginBtnText">Sign In</span>
                        <span id="loginBtnSpinner" style="display:none;">⏳</span>
                    </button>
                </form>

                <div class="bouesti-auth-footer">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="bouesti-link">Create one here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show loading state on form submit
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn  = document.getElementById('loginBtn');
            const txt  = document.getElementById('loginBtnText');
            const spin = document.getElementById('loginBtnSpinner');
            btn.disabled = true;
            txt.textContent = 'Signing In…';
            spin.style.display = 'inline';
        });
    </script>
</x-guest-layout>
