# Job Tracker

Job Tracker adalah aplikasi untuk membantu pengguna melacak proses melamar kerja, mulai dari registrasi akun, login, menyimpan daftar lamaran, hingga memantau status proses rekrutmen.

Proyek ini terdiri dari dua bagian:

- `job-tracker-backend` sebagai API backend menggunakan Laravel
- `job-tracker-frontend` sebagai frontend menggunakan Next.js

## Fitur

- Registrasi dan login pengguna
- Autentikasi berbasis token
- Menampilkan daftar lamaran kerja
- Pengelolaan data lamaran, interview, dan contact
- Integrasi frontend dan backend melalui REST API

## Tech Stack

### Backend

- PHP 8.3
- Laravel 13
- Laravel Sanctum
- Laravel Tinker
- SQLite / database relasional lain sesuai konfigurasi `.env`
- Vite
- Tailwind CSS 4

### Frontend

- Next.js 16
- React 19
- TypeScript
- Tailwind CSS 4
- Axios
- ESLint

## Struktur Folder

### Root

- `job-tracker-backend/` - source code backend Laravel
- `job-tracker-frontend/` - source code frontend Next.js

### Backend

- `app/Http/Controllers/` - controller untuk autentikasi dan aplikasi
- `app/Models/` - model data seperti `Application`, `Interview`, `Contact`, dan `User`
- `bootstrap/` - bootstrap aplikasi Laravel
- `config/` - konfigurasi aplikasi Laravel
- `database/migrations/` - struktur tabel database
- `database/seeders/` - data awal database
- `public/` - entry point backend
- `resources/views/` - view Laravel
- `routes/api.php` - route API
- `routes/web.php` - route web
- `storage/` - file cache, log, dan file aplikasi

### Frontend

- `app/` - halaman Next.js seperti dashboard, login, dan register
- `app/login/` - halaman login
- `app/register/` - halaman registrasi
- `lib/axios.ts` - konfigurasi Axios dan base URL backend
- `public/` - aset statis frontend

## Instalasi

### 1. Clone repository

```bash
git clone <url-repository>
cd JobTracker
```

### 2. Setup Backend

Masuk ke folder backend:

```bash
cd job-tracker-backend
composer install
```

Salin file environment:

```bash
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur konfigurasi database di file `.env`, lalu jalankan migrasi:

```bash
php artisan migrate
```

Jalankan backend:

```bash
php artisan serve
```

Backend biasanya tersedia di:

```bash
http://127.0.0.1:8000
```

### 3. Setup Frontend

Masuk ke folder frontend:

```bash
cd ../job-tracker-frontend
npm install
```

Buat file `.env.local` jika diperlukan, lalu isi URL backend:

```env
NEXT_PUBLIC_BACKEND_URL=http://127.0.0.1:8000
```

Jalankan frontend:

```bash
npm run dev
```

Frontend biasanya tersedia di:

```bash
http://localhost:3000
```

## Cara Menjalankan Aplikasi

1. Jalankan backend Laravel.
2. Jalankan frontend Next.js.
3. Buka `http://localhost:3000` di browser.
4. Daftar akun atau login.
5. Mulai gunakan dashboard Job Tracker.

## Catatan

- Pastikan backend dan frontend berjalan secara bersamaan.
- Token autentikasi disimpan di `localStorage` pada sisi frontend.
- Jika memakai database selain SQLite, sesuaikan konfigurasi `.env` terlebih dahulu.
