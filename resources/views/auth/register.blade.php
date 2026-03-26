<x-guest-layout>
    <x-slot name="title">Create Account — BOUESTI Off-Campus Accommodation</x-slot>

    <div class="bouesti-auth-wrapper">

        <!-- ── Brand Panel ─────────────────────────────────────────── -->
        <div class="bouesti-brand-panel">
            <div class="bouesti-logo-area">
                <div class="bouesti-logo-circle">B</div>
                <div class="bouesti-logo-title">BOUESTI</div>
                <div class="bouesti-logo-subtitle">Bells University of Technology — Off-Campus Accommodation System</div>
            </div>
            <div class="bouesti-brand-tagline">
                <p>Join thousands of students finding <strong>verified, safe accommodation</strong> near campus.</p>
            </div>
        </div>

        <!-- ── Form Panel ──────────────────────────────────────────── -->
        <div class="bouesti-form-panel">
            <div class="bouesti-form-card">

                <h2>Create Account</h2>
                <p class="bouesti-form-desc">Fill in the form below to get started</p>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bouesti-alert bouesti-alert-error">
                        ✕ {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Role Selector -->
                    <div class="bouesti-field">
                        <label>I am a…</label>
                        <div class="bouesti-role-group">
                            <div class="bouesti-role-option">
                                <input type="radio" id="role_student" name="role" value="student"
                                    {{ old('role', 'student') === 'student' ? 'checked' : '' }}
                                    onchange="toggleMatricField(this.value)">
                                <label for="role_student">
                                    <span class="role-icon">🎓</span>
                                    Student
                                </label>
                            </div>
                            <div class="bouesti-role-option">
                                <input type="radio" id="role_landlord" name="role" value="landlord"
                                    {{ old('role') === 'landlord' ? 'checked' : '' }}
                                    onchange="toggleMatricField(this.value)">
                                <label for="role_landlord">
                                    <span class="role-icon">🏠</span>
                                    Landlord
                                </label>
                            </div>
                        </div>
                        @error('role')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div class="bouesti-field">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            required autocomplete="name" placeholder="John Doe"
                            class="{{ $errors->has('name') ? 'is-invalid' : '' }}" />
                        @error('name')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="bouesti-field">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            required autocomplete="username" placeholder="you@example.com"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}" />
                        @error('email')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="bouesti-field">
                        <label for="phone">Phone Number</label>
                        <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                            placeholder="+234 800 000 0000"
                            class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" />
                        @error('phone')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Matriculation Number (Students only) -->
                    <div class="bouesti-field" id="matric-field"
                        style="{{ old('role','student') !== 'student' ? 'display:none;' : '' }}">
                        <label for="matriculation_number">Matriculation Number</label>
                        <input id="matriculation_number" type="text" name="matriculation_number"
                            value="{{ old('matriculation_number') }}"
                            placeholder="e.g. 20/ENG/CS/001"
                            class="{{ $errors->has('matriculation_number') ? 'is-invalid' : '' }}" />
                        @error('matriculation_number')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="bouesti-field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password"
                            required autocomplete="new-password" placeholder="Min. 8 characters"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}" />
                        @error('password')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="bouesti-field">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Re-enter password"
                            class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" />
                        @error('password_confirmation')
                            <div class="bouesti-field-error">✕ {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="bouesti-btn bouesti-btn-primary" id="registerBtn">
                        <span id="registerBtnText">Create Account</span>
                        <span id="registerBtnSpinner" style="display:none;">⏳</span>
                    </button>
                </form>

                <div class="bouesti-auth-footer">
                    Already have an account?
                    <a href="{{ route('login') }}" class="bouesti-link">Sign in</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMatricField(role) {
            const field = document.getElementById('matric-field');
            const input = document.getElementById('matriculation_number');
            if (role === 'student') {
                field.style.display = 'block';
                input.required = true;
            } else {
                field.style.display = 'none';
                input.required = false;
                input.value = '';
            }
        }

        // Initialize on page load (for old() values)
        document.addEventListener('DOMContentLoaded', function () {
            const checked = document.querySelector('input[name="role"]:checked');
            if (checked) toggleMatricField(checked.value);
        });

        // Loading state on submit
        document.getElementById('registerForm').addEventListener('submit', function () {
            const btn  = document.getElementById('registerBtn');
            const txt  = document.getElementById('registerBtnText');
            const spin = document.getElementById('registerBtnSpinner');
            btn.disabled = true;
            txt.textContent = 'Creating Account…';
            spin.style.display = 'inline';
        });
    </script>
</x-guest-layout>
