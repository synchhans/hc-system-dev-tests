# HC System — Form Login

Aplikasi Laravel 12 dengan autentikasi menggunakan Username (bukan email). Proyek ini dibuat untuk memenuhi Soal Praktik Human Capital System Development: Pembuatan Form Login.

## Ringkasan Soal Praktik

- Tampilan Login: 2 input (ID/Username, Password) + tombol Login, desain sederhana (Bootstrap).
- Proses Login: verifikasi ke database; sukses → pindah ke halaman utama dan tampilkan pesan “Selamat datang, [nama pengguna]!”; gagal → tampilkan notifikasi “Login gagal! ID atau Password salah.” dan tetap di login.
- Syarat Tambahan: metode POST, validasi tidak boleh kosong, session untuk status login, halaman logout untuk mengakhiri session.
- Nilai Tambahan: password hashing, pesan flash (alert/toast).

## Implementasi di Proyek Ini

- Login Form: `resources/views/auth/login.blade.php` (Bootstrap, validasi frontend sederhana, tombol disabled hingga valid).
- Autentikasi: `app/Http/Requests/Auth/LoginRequest.php` (validasi + rate limit, `Auth::attempt` via username) dan `app/Http/Controllers/Auth/AuthenticatedSessionController.php` (POST `/login`, redirect ke `home`).
- Pesan: error kredensial pada key `credentials` ditampilkan sebagai toast; success message disupport.
- Home: `resources/views/home.blade.php` menampilkan “Selamat datang, {{ $user->name }}!”.
- Session & Logout: session Laravel, POST `/logout` mengakhiri sesi dan kembali ke halaman login.
- Keamanan: password disimpan hashed (`App\Models\User` cast `password` => `hashed`).

## Prasyarat

- PHP 8.2+
- Composer 2.x
- Node.js 18+ (disarankan 20+) dan npm
- Database: MySQL 8+ atau SQLite (opsional)

## Instalasi & Setup

1) Salin env dan generate app key

```bash
cp .env.example .env
php artisan key:generate
```

2) Konfigurasi database

- Opsi MySQL (disarankan untuk pengujian penuh):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hc_system
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `hc_system` sudah dibuat.

- Opsi SQLite (quick start):

```env
DB_CONNECTION=sqlite
```

```bash
mkdir -p database
type nul > database/database.sqlite   # Windows
# touch database/database.sqlite       # macOS/Linux
```

3) Install dependencies, migrasi, dan seeder

```bash
composer install
php artisan migrate --seed

npm install
npm run dev   # jalankan Vite untuk assets
```

4) Jalankan aplikasi

```bash
php artisan serve   # http://127.0.0.1:8000
```

Alternatif all-in-one (server + queue + logs + Vite) gunakan:

```bash
composer run dev
```

## Akun Uji (Seeder)

- Admin → username: `admin`, password: `12345`
- User  → username: `user`,  password: `12345`

Login di `/login` menggunakan Username.

## URL Penting

- `/login` → halaman login
- `/home` → halaman utama setelah login
- `/admin` → dashboard admin (hanya role admin)

## Catatan Tambahan

- Queue default: `database`. Saat menjalankan `composer run dev`, queue listener ikut aktif.
- Sesuaikan variabel `.env` seperti `APP_URL`, `MAIL_*`, Redis jika diperlukan.
- Skrip yang tersedia: `composer run setup`, `composer run dev`, `npm run dev`, `npm run build`.
