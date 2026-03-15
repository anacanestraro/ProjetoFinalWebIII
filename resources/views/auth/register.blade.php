<x-guest-layout>
<h2 class="auth-title">Criar conta</h2>
<p class="auth-subtitle">Junte-se ao StockFlow e comece a gerenciar seu estoque</p>

<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    <div class="field">
        <label class="field-label" for="name">Nome completo</label>
        <div class="field-wrapper">
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <input id="name" class="field-input @error('name') error @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Seu nome completo" required autofocus autocomplete="name" onchange="clearError('name')">
        </div>
        @error('name') <p class="field-error"><span class="field-error-dot"></span>{{ $message }}</p> @enderror
    </div>

    <div class="field">
        <label class="field-label" for="email">E-mail</label>
        <div class="field-wrapper">
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <input id="email" class="field-input @error('email') error @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required autocomplete="email" onchange="clearError('email')">
        </div>
        @error('email') <p class="field-error"><span class="field-error-dot"></span>{{ $message }}</p> @enderror
    </div>

    <div class="field">
        <label class="field-label" for="password">Senha</label>
        <div class="field-wrapper">
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <input id="password" class="field-input @error('password') error @enderror" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" onchange="clearError('password')" oninput="checkPasswordStrength()">
            <button type="button" class="field-toggle" onclick="togglePassword('password')">
                <svg id="password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
        @error('password') <p class="field-error"><span class="field-error-dot"></span>{{ $message }}</p> @enderror
        <div class="password-strength"><div id="passwordStrengthBar" class="password-strength-bar"></div></div>
    </div>

    <div class="field">
        <label class="field-label" for="password_confirmation">Confirmar senha</label>
        <div class="field-wrapper">
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <input id="password_confirmation" class="field-input @error('password_confirmation') error @enderror" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" onchange="clearError('password_confirmation')">
            <button type="button" class="field-toggle" onclick="togglePassword('password_confirmation')">
                <svg id="password_confirmation-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
        @error('password_confirmation') <p class="field-error"><span class="field-error-dot"></span>{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn-submit" id="submitBtn">
        <span>Criar conta</span>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
        </svg>
    </button>
</form>

<div class="divider">
    <span class="divider-line"></span>
    <span class="divider-text">ou continue com</span>
    <span class="divider-line"></span>
</div>

<a href="/socialite/google" class="btn-google">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
    </svg>
    Registrar com Google
</a>

<div class="auth-links">
    <span class="auth-link">Já tem uma conta?</span>
    <span class="auth-link-separator">·</span>
    <a href="{{ route('login') }}" class="auth-link" style="color:var(--primary);font-weight:500;">Fazer login</a>
</div>

<script>
function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const bar = document.getElementById('passwordStrengthBar');
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[^a-zA-Z\d]/.test(password)) strength++;
    bar.className = 'password-strength-bar';
    if (strength <= 2) bar.classList.add('weak');
    else if (strength <= 3) bar.classList.add('medium');
    else bar.classList.add('strong');
}

document.getElementById('registerForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<div class="spinner"></div><span>Criando conta...</span>';
});
</script>
</x-guest-layout>