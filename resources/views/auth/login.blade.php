<x-guest-layout>
<h2 class="auth-title">Bem-vinda de volta</h2>
<p class="auth-subtitle">Faça login para acessar o StockFlow</p>

<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}" id="loginForm">
    @csrf

    <div class="field">
        <label class="field-label" for="email">E-mail</label>
        <div class="field-wrapper">
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <input id="email" class="field-input @error('email') error @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required autofocus autocomplete="username" onchange="clearError('email')">
        </div>
        @error('email') <p class="field-error"><span class="field-error-dot"></span>{{ $message }}</p> @enderror
    </div>

    <div class="field">
        <label class="field-label" for="password">Senha</label>
        <div class="field-wrapper">
            <svg class="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <input id="password" class="field-input @error('password') error @enderror" type="password" name="password" placeholder="••••••••" required autocomplete="current-password" onchange="clearError('password')">
            <button type="button" class="field-toggle" onclick="togglePassword('password')">
                <svg id="password-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
        @error('password') <p class="field-error"><span class="field-error-dot"></span>{{ $message }}</p> @enderror
    </div>

    <div class="remember-row">
        <div class="remember-wrapper">
            <input type="checkbox" id="remember_me" name="remember">
            <label for="remember_me">Lembrar de mim</label>
        </div>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-password">Esqueceu a senha?</a>
        @endif
    </div>

    <button type="submit" class="btn-submit" id="submitBtn">
        <span>Entrar</span>
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
    Entrar com Google
</a>

@if (Route::has('register'))
<div class="auth-links">
    <span class="auth-link">Não tem uma conta?</span>
    <span class="auth-link-separator">·</span>
    <a href="{{ route('register') }}" class="auth-link" style="color:var(--primary);font-weight:500;">Criar conta</a>
</div>
@endif

<script>
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<div class="spinner"></div><span>Entrando...</span>';
});
</script>
</x-guest-layout>