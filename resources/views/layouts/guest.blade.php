<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'StockFlow') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --primary: #818cf8;
                --primary-dark: #6366f1;
                --primary-light: #a5b4fc;
                --danger: #f87171;
                --slate-900: #0f172a;
                --slate-800: #1e293b;
                --slate-700: #334155;
                --slate-600: #475569;
                --slate-500: #64748b;
                --slate-400: #94a3b8;
                --slate-300: #cbd5e1;
                --slate-200: #e2e8f0;
                --slate-100: #f1f5f9;
            }
            @keyframes slideUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
            @keyframes slideIn { from{opacity:0;transform:translateY(-4px)} to{opacity:1;transform:translateY(0)} }
            @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(18px)} }
            @keyframes spin { to{transform:rotate(360deg)} }

            *{box-sizing:border-box}
            body{margin:0;font-family:'Figtree',sans-serif}

            .auth-page {
                min-height: 100vh;
                display: flex;
                background: var(--slate-900);
                position: relative;
                overflow: hidden;
            }

            .blob{position:absolute;border-radius:50%;pointer-events:none;filter:blur(80px)}
            .blob-1{width:500px;height:500px;background:rgba(79,70,229,.2);top:-150px;left:-100px;animation:float 7s ease-in-out infinite}
            .blob-2{width:300px;height:300px;background:rgba(59,130,246,.15);bottom:-80px;left:30%;animation:float 9s ease-in-out infinite 1s}
            .blob-3{width:200px;height:200px;background:rgba(129,140,248,.12);top:40%;left:55%;animation:float 8s ease-in-out infinite 2s}

            /* ESQUERDA */
            .auth-left {
                flex: 1;
                display: none;
                flex-direction: column;
                justify-content: center;
                padding: 4rem 5rem;
                position: relative;
                z-index: 1;
            }
            @media(min-width:1024px){.auth-left{display:flex}}

            .auth-brand{display:flex;align-items:center;gap:1rem;margin-bottom:3.5rem;animation:slideUp .6s ease-out}
            .auth-brand-icon{
                width:3.5rem;height:3.5rem;
                background:linear-gradient(135deg,#4f46e5,#3b82f6);
                border-radius:.875rem;
                display:flex;align-items:center;justify-content:center;
                font-size:1.125rem;font-weight:700;color:#fff;
                overflow:hidden;
                box-shadow:0 4px 16px rgba(79,70,229,.4);
            }
            .auth-brand-icon img{width:100%;height:100%;object-fit:cover}
            .auth-brand-name{font-size:1.375rem;font-weight:700;color:var(--slate-100);letter-spacing:.02em}

            .auth-tagline{
                font-size:3rem;font-weight:700;color:var(--slate-100);
                line-height:1.2;margin-bottom:1.25rem;
                animation:slideUp .6s ease-out .1s both;
            }
            .auth-tagline span{
                background:linear-gradient(135deg,#a5b4fc,#60a5fa);
                -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
            }
            .auth-desc{
                font-size:1rem;color:var(--slate-400);line-height:1.75;
                max-width:420px;margin-bottom:2.5rem;
                animation:slideUp .6s ease-out .2s both;
            }

            .auth-features{display:flex;flex-direction:column;gap:1rem}
            .auth-feature{
                display:flex;align-items:center;gap:.875rem;
                font-size:.9375rem;color:var(--slate-300);
                animation:slideUp .6s ease-out both;
            }
            .auth-feature:nth-child(1){animation-delay:.3s}
            .auth-feature:nth-child(2){animation-delay:.4s}
            .auth-feature:nth-child(3){animation-delay:.5s}
            .auth-feature:nth-child(4){animation-delay:.6s}
            .auth-feature-check{
                width:1.5rem;height:1.5rem;border-radius:50%;
                background:rgba(129,140,248,.2);border:1px solid rgba(129,140,248,.4);
                display:flex;align-items:center;justify-content:center;flex-shrink:0;
            }
            .auth-feature-check svg{width:.875rem;height:.875rem;stroke:#818cf8}

            .auth-left-footer{margin-top:4rem;font-size:.8rem;color:var(--slate-600);animation:slideUp .6s ease-out .7s both}

            /* DIREITA */
            .auth-right{
                width:100%;max-width:520px;
                display:flex;flex-direction:column;justify-content:center;align-items:center;
                padding:2rem;
                background:rgba(15,23,42,.5);
                border-left:1px solid rgba(71,85,105,.2);
                position:relative;z-index:1;
            }
            .auth-right-inner{width:100%;max-width:440px}

            .auth-card{
                background:rgba(30,41,59,.7);
                backdrop-filter:blur(12px);
                border:1px solid rgba(71,85,105,.3);
                border-radius:1.25rem;
                padding:2.5rem;
                width:100%;
                box-shadow:0 8px 40px rgba(0,0,0,.4);
                animation:slideUp .6s ease-out;
            }
            .auth-footer{text-align:center;font-size:.75rem;color:rgba(71,85,105,.6);margin-top:1.5rem}

            /* FORM */
            .auth-title{font-size:1.75rem;font-weight:700;color:var(--slate-100);margin-bottom:.375rem}
            .auth-subtitle{font-size:.875rem;color:var(--slate-400);margin-bottom:2rem}

            .field{margin-bottom:1.25rem}
            .field-label{font-size:.8rem;font-weight:500;color:var(--slate-300);display:block;margin-bottom:.5rem}
            .field-wrapper{position:relative}
            .field-icon{position:absolute;left:1rem;top:50%;transform:translateY(-50%);width:1.1rem;height:1.1rem;color:var(--slate-500);pointer-events:none;transition:color .3s}
            .field-wrapper:focus-within .field-icon{color:var(--primary)}
            .field-input{
                width:100%;padding:.75rem 1rem .75rem 2.75rem;
                background:rgba(51,65,85,.3);
                border:1px solid rgba(71,85,105,.5);
                border-radius:.625rem;
                font-size:.875rem;color:var(--slate-100);
                outline:none;transition:all .3s;font-family:inherit;
            }
            .field-input::placeholder{color:var(--slate-500)}
            .field-input:focus{border-color:var(--primary);background:rgba(51,65,85,.5);box-shadow:0 0 0 3px rgba(129,140,248,.1)}
            .field-toggle{position:absolute;right:1rem;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--slate-500);cursor:pointer;padding:.25rem;display:flex;align-items:center;justify-content:center;transition:color .3s}
            .field-toggle:hover{color:var(--slate-300)}
            .field-toggle svg{width:1.1rem;height:1.1rem}
            .field-error{font-size:.75rem;color:var(--danger);margin-top:.375rem;display:flex;align-items:center;gap:.375rem;animation:slideIn .2s ease-out}
            .field-error-dot{width:.25rem;height:.25rem;border-radius:50%;background:var(--danger);flex-shrink:0}

            .remember-row{display:flex;align-items:center;justify-content:space-between;gap:.5rem;margin:1rem 0}
            .remember-wrapper{display:flex;align-items:center;gap:.5rem}
            .remember-row input[type="checkbox"]{width:1rem;height:1rem;accent-color:var(--primary);cursor:pointer}
            .remember-row label{font-size:.8rem;color:var(--slate-400);cursor:pointer}
            .forgot-password{font-size:.8rem;color:var(--primary);text-decoration:none;font-weight:500}
            .forgot-password:hover{color:var(--primary-light)}

            .btn-submit{
                width:100%;padding:.8rem;
                background:linear-gradient(135deg,var(--primary),var(--primary-dark));
                color:#fff;border:none;border-radius:.625rem;
                font-size:.9375rem;font-weight:600;cursor:pointer;
                transition:all .3s;font-family:inherit;margin-top:.5rem;
                display:flex;align-items:center;justify-content:center;gap:.5rem;
                box-shadow:0 4px 16px rgba(129,140,248,.35);
            }
            .btn-submit:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 8px 24px rgba(129,140,248,.45)}
            .btn-submit:active:not(:disabled){transform:translateY(0)}
            .btn-submit:disabled{opacity:.6;cursor:not-allowed}
            .btn-submit svg{transition:transform .3s;width:1.1rem;height:1.1rem}
            .btn-submit:hover:not(:disabled) svg{transform:translateX(3px)}
            .spinner{width:1rem;height:1rem;border:2px solid rgba(255,255,255,.2);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite}

            .divider{display:flex;align-items:center;gap:.75rem;margin:1.25rem 0}
            .divider-line{flex:1;height:1px;background:linear-gradient(90deg,transparent,rgba(71,85,105,.5),transparent)}
            .divider-text{font-size:.7rem;color:var(--slate-500);font-weight:500;text-transform:uppercase;letter-spacing:.05em}

            .btn-google{
                width:100%;padding:.75rem;background:transparent;
                color:var(--slate-400);border:1px solid rgba(71,85,105,.5);
                border-radius:.625rem;font-size:.875rem;font-weight:500;
                cursor:pointer;transition:all .3s;font-family:inherit;
                display:flex;align-items:center;justify-content:center;gap:.5rem;text-decoration:none;
            }
            .btn-google:hover{border-color:rgba(71,85,105,.7);color:var(--slate-200);background:rgba(71,85,105,.1)}

            .auth-links{display:flex;align-items:center;justify-content:center;gap:.75rem;margin-top:1.25rem}
            .auth-link{font-size:.8rem;color:var(--slate-400);text-decoration:none;transition:color .3s}
            .auth-link:hover{color:var(--primary)}
            .auth-link-separator{color:rgba(71,85,105,.5)}

            .password-strength{height:3px;background:rgba(71,85,105,.3);border-radius:2px;margin-top:.5rem;overflow:hidden}
            .password-strength-bar{height:100%;width:0;border-radius:2px;transition:all .3s}
            .password-strength-bar.weak{width:33%;background:#f87171}
            .password-strength-bar.medium{width:66%;background:#facc15}
            .password-strength-bar.strong{width:100%;background:#4ade80}

            @media(max-width:640px){
                .auth-card{padding:1.5rem}
                .auth-title{font-size:1.375rem}
                .field-input{font-size:16px}
            }
        </style>
    </head>
    <body>
        <div class="auth-page">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>

            <div class="auth-left">
                <div class="auth-brand">
                    <div class="auth-brand-icon">
                        <img src="/favicon.ico" alt="SF" onerror="this.style.display='none';this.parentElement.innerText='SF'">
                    </div>
                    <span class="auth-brand-name">StockFlow</span>
                </div>

                <h1 class="auth-tagline">
                    Controle de estoque<br>
                    <span>simples e eficiente</span>
                </h1>

                <p class="auth-desc">
                    Gerencie produtos, clientes e retiradas em um só lugar.
                    Relatórios completos e histórico de movimentações ao alcance de um clique.
                </p>

                <div class="auth-features">
                    <div class="auth-feature">
                        <span class="auth-feature-check">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Controle de entrada e saída de produtos
                    </div>
                    <div class="auth-feature">
                        <span class="auth-feature-check">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Relatórios em PDF com um clique
                    </div>
                    <div class="auth-feature">
                        <span class="auth-feature-check">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Histórico completo de movimentações
                    </div>
                    <div class="auth-feature">
                        <span class="auth-feature-check">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Tickets com QR Code para retiradas
                    </div>
                </div>

                <p class="auth-left-footer">TADS23 &bull; Ana Canestraro</p>
            </div>

            <div class="auth-right">
                <div class="auth-right-inner">
                    <div class="auth-card">
                        {{ $slot }}
                    </div>
                    <p class="auth-footer">StockFlow &bull; TADS23 &bull; Ana Canestraro</p>
                </div>
            </div>
        </div>

        <script>
            function togglePassword(inputId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(inputId + '-icon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856A3 3 0 1112 9m0 0a3 3 0 013 3"/>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                }
            }
            function clearError(fieldName) {
                const field = document.getElementById(fieldName);
                if (field) field.classList.remove('error');
            }
        </script>
    </body>
</html>