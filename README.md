# 📦 StockFlow

Projeto final desenvolvido para a disciplina de **Desenvolvimento Web III**, ofertada no 4º semestre do curso de TADS (Tecnologia em Análise e Desenvolvimento de Sistemas) — TADS23.

---

## 📋 Sobre o projeto

StockFlow é um sistema web para controle de estoque com gerenciamento de produtos, categorias, unidades de medida e clientes. Permite registrar retiradas de produtos, gerar relatórios em PDF e emitir tickets com QR Code. Possui autenticação via e-mail e login social com Google.

---

## ✨ Funcionalidades

- **Produtos** — cadastro, edição, remoção e visualização com controle de quantidade em estoque
- **Categorias** — organização dos produtos por categoria
- **Unidades de medida** — gerenciamento das unidades (ex: kg, un, L)
- **Clientes** — cadastro e gerenciamento de clientes com endereço via CEP automático
- **Retiradas** — registro de retiradas de produtos por cliente, com emissão de ticket em PDF com QR Code
- **Relatórios em PDF** — produtos com estoque, produtos sem estoque, estoque crítico, movimentação de estoque, retiradas por cliente e retiradas por período
- **Autenticação** — login com e-mail/senha (Laravel Breeze) e login social com Google (Socialite)
- **Perfil** — edição e exclusão de conta do usuário
- **Dashboard** — visão geral do estoque com cards de resumo, últimas retiradas e produtos críticos

---

## 🚀 Tecnologias utilizadas

- [Laravel 11](https://laravel.com/) — framework PHP para o backend
- [Blade](https://laravel.com/docs/blade) — engine de templates
- [Tailwind CSS](https://tailwindcss.com/) — estilização da interface
- [Vite](https://vitejs.dev/) — bundler de assets
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze) — autenticação
- [Laravel Socialite](https://laravel.com/docs/socialite) — login com Google
- [DomPDF](https://github.com/barryvdh/laravel-dompdf) — geração de PDFs
- [Simple QrCode](https://github.com/SimpleSoftwareIO/simple-qrcode) — geração de QR Codes
- MySQL

---

## ⚙️ Como rodar o projeto

### Pré-requisitos

- PHP >= 8.2
- Composer
- Node.js e npm

### Instalação

```bash
# Clone o repositório
git clone https://github.com/anacanestraro/ProjetoFinalWebIII.git
cd ProjetoFinalWebIII

# Instale as dependências PHP
composer install

# Instale as dependências JavaScript
npm install

# Copie o arquivo de variáveis de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Rode as migrations
php artisan migrate
```

### Rodando a aplicação

```bash
# Inicia todos os serviços de uma vez (servidor, queue, logs e vite)
composer run dev
```

Acesse em: `http://localhost:8000`

---

## 🐳 Rodando com Docker

```bash
# Suba os containers
docker compose up -d

# Instale as dependências
docker compose exec app composer install
docker compose exec app npm install && npm run build

# Configure o ambiente
docker compose exec app cp .env.example .env
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Acesse em: `http://localhost:8000`

> Veja mais detalhes em [`docker/README-docker.md`](./docker/README-docker.md)

---

## 🔑 Login com Google (opcional)

Para habilitar o login social com Google, adicione as credenciais no `.env`:

```env
GOOGLE_CLIENT_ID=seu_client_id
GOOGLE_CLIENT_SECRET=seu_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

As credenciais podem ser obtidas no [Google Cloud Console](https://console.cloud.google.com/).

---

## 👩‍💻 Autora

Desenvolvido por **Ana Canestraro** como projeto de conclusão da disciplina de Desenvolvimento Web III — TADS23.