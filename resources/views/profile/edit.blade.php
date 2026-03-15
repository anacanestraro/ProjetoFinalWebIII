@section('title', 'Perfil')
<x-app-layout>
<style>
    .profile-page { padding: 2rem 1.5rem; min-height: 100%; }
    .profile-wrap { max-width: 700px; margin: 0 auto; }
    .profile-header { margin-bottom: 2rem; }
    .profile-header-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }
    .avatar-circle {
        width: 4rem; height: 4rem; border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.375rem; font-weight: 700; color: #fff;
        flex-shrink: 0;
    }
    .profile-name { font-size: 1.125rem; font-weight: 500; color: #111827; margin: 0; }
    .profile-email { font-size: 0.875rem; color: #6b7280; margin: 0.25rem 0 0; }

    .section-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .section-head { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6; }
    .section-title { font-size: 0.9375rem; font-weight: 500; color: #111827; margin: 0; }
    .section-desc { font-size: 0.8rem; color: #9ca3af; margin: 0.25rem 0 0; }
    .section-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }

    .field-label { font-size: 0.8rem; font-weight: 500; color: #374151; display: block; margin-bottom: 0.375rem; }
    .field-input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; font-size: 0.875rem; color: #111827; background: #fff; outline: none; transition: border-color .15s; box-sizing: border-box; font-family: inherit; }
    .field-input:focus { border-color: #6b7280; }
    .field-error { font-size: 0.75rem; color: #ef4444; margin-top: 0.25rem; }

    .section-footer { padding: 1rem 1.5rem; border-top: 1px solid #f3f4f6; display: flex; align-items: center; gap: 1rem; }
    .btn-save { background: #111827; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1.25rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background .15s; font-family: inherit; }
    .btn-save:hover { background: #374151; }
    .btn-saved { font-size: 0.8rem; color: #16a34a; }

    .danger-zone { background: #fff; border: 1px solid #fecaca; border-radius: 0.75rem; overflow: hidden; }
    .danger-head { padding: 1.25rem 1.5rem; border-bottom: 1px solid #fee2e2; }
    .danger-title { font-size: 0.9375rem; font-weight: 500; color: #dc2626; margin: 0; }
    .danger-desc { font-size: 0.8rem; color: #9ca3af; margin: 0.25rem 0 0; }
    .danger-body { padding: 1.5rem; }
    .btn-danger { background: #dc2626; color: #fff; border: none; border-radius: 0.5rem; padding: 0.5rem 1.25rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background .15s; font-family: inherit; }
    .btn-danger:hover { background: #b91c1c; }

    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 100; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal { background: #fff; border-radius: 0.75rem; padding: 1.5rem; width: 100%; max-width: 420px; margin: 1rem; }
    .modal-title { font-size: 1rem; font-weight: 500; color: #111827; margin-bottom: 0.5rem; }
    .modal-desc { font-size: 0.875rem; color: #6b7280; margin-bottom: 1.25rem; line-height: 1.6; }
    .modal-footer { display: flex; gap: 0.5rem; justify-content: flex-end; margin-top: 1.25rem; }
    .btn-cancel { background: #fff; color: #374151; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; font-family: inherit; }
    .btn-cancel:hover { border-color: #9ca3af; }

    @media (prefers-color-scheme: dark) {
        .profile-header-card, .section-card, .danger-zone, .modal { background: #111827; border-color: #374151; }
        .profile-name, .section-title { color: #f3f4f6; }
        .section-head, .section-footer { border-color: #1f2937; }
        .section-desc, .profile-email { color: #6b7280; }
        .field-label { color: #d1d5db; }
        .field-input { background: #1f2937; border-color: #374151; color: #f3f4f6; }
        .field-input:focus { border-color: #6b7280; }
        .btn-save { background: #374151; } .btn-save:hover { background: #4b5563; }
        .danger-zone { border-color: #7f1d1d; }
        .danger-head { border-color: #450a0a; }
        .btn-cancel { background: transparent; color: #d1d5db; border-color: #374151; }
        .modal-title { color: #f3f4f6; }
        .modal-desc { color: #9ca3af; }
    }
</style>

<div class="profile-page">
    <div class="profile-wrap">

        {{-- Card do usuário --}}
        <div class="profile-header">
            <div class="profile-header-card">
                <div class="avatar-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <p class="profile-name">{{ Auth::user()->name }}</p>
                    <p class="profile-email">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Informações do perfil --}}
        <div class="section-card">
            <div class="section-head">
                <p class="section-title">Informações do perfil</p>
                <p class="section-desc">Atualize seu nome e endereço de e-mail</p>
            </div>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="section-body">
                    <div>
                        <label class="field-label">Nome</label>
                        <input class="field-input" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="field-label">E-mail</label>
                        <input class="field-input" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="username">
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="section-footer">
                    <button type="submit" class="btn-save">Salvar alterações</button>
                    @if(session('status') === 'profile-updated')
                        <span class="btn-saved"
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)">
                            Salvo com sucesso!
                        </span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Atualizar senha --}}
        <div class="section-card">
            <div class="section-head">
                <p class="section-title">Atualizar senha</p>
                <p class="section-desc">Use uma senha longa e aleatória para manter sua conta segura</p>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="section-body">
                    <div>
                        <label class="field-label">Senha atual</label>
                        <input class="field-input" type="password" name="current_password" autocomplete="current-password">
                        @error('current_password', 'updatePassword') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="field-label">Nova senha</label>
                        <input class="field-input" type="password" name="password" autocomplete="new-password">
                        @error('password', 'updatePassword') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="field-label">Confirmar nova senha</label>
                        <input class="field-input" type="password" name="password_confirmation" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="section-footer">
                    <button type="submit" class="btn-save">Atualizar senha</button>
                    @if(session('status') === 'password-updated')
                        <span class="btn-saved"
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)">
                            Senha atualizada!
                        </span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Deletar conta --}}
        <div class="danger-zone">
            <div class="danger-head">
                <p class="danger-title">Deletar conta</p>
                <p class="danger-desc">Esta ação é permanente e não pode ser desfeita</p>
            </div>
            <div class="danger-body">
                <p style="font-size:0.875rem; color:#6b7280; margin-bottom:1rem; line-height:1.6;">
                    Uma vez que sua conta é deletada, todos os seus dados serão permanentemente removidos.
                    Antes de prosseguir, faça o download de qualquer informação que deseja manter.
                </p>
                <button class="btn-danger" onclick="document.getElementById('deleteModal').classList.add('open')">
                    Deletar conta
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Modal de confirmação --}}
<div class="modal-overlay" id="deleteModal" onclick="if(event.target===this) this.classList.remove('open')">
    <div class="modal">
        <p class="modal-title">Tem certeza que deseja deletar sua conta?</p>
        <p class="modal-desc">
            Esta ação é irreversível. Todos os seus dados serão permanentemente deletados.
            Para confirmar, insira sua senha abaixo.
        </p>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <div>
                <label class="field-label">Senha</label>
                <input class="field-input" type="password" name="password" placeholder="Sua senha atual">
                @error('password', 'userDeletion') <p class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="document.getElementById('deleteModal').classList.remove('open')">Cancelar</button>
                <button type="submit" class="btn-danger">Deletar conta</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>