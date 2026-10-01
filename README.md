# Praktikum Manajemen Mahasiswa

Aplikasi web manajemen data mahasiswa berbasis **Laravel** yang dibangun sebagai tugas praktikum. Aplikasi ini mengimplementasikan sistem autentikasi dengan **role-based access control** menggunakan **Laravel Breeze**.

## 🎯 Fitur Utama

- **Autentikasi**: Register, Login, Logout menggunakan Laravel Breeze
- **Role Pengguna**:
  - `admin` — Dapat melakukan CRUD mahasiswa (Create, Read, Update, Delete)
  - `user` — Hanya dapat melihat daftar mahasiswa (Read Only)
- **Role Middleware**: Pembatasan akses berbasis role pada sisi server
- **CRUD Mahasiswa**: Pengelolaan data mahasiswa (NIM, Nama, Program Studi, Email, Angkatan)
- **Dashboard**: Statistik ringkasan dan matriks hak akses

## 🛠️ Tech Stack

- **Backend**: Laravel 13 (PHP 8.3+)
- **Autentikasi**: Laravel Breeze (Blade Stack)
- **Database**: MySQL (Laragon)
- **Frontend**: Blade Templates + Tailwind CSS
- **Testing**: PHPUnit (35 Tests ✅)

## ⚙️ Cara Instalasi Lokal

1. **Clone repository**
   ```bash
   git clone https://github.com/EleazarAmarya/praktikum-manajemen-mahasiswa.git
   cd praktikum-manajemen-mahasiswa
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database** — Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=praktikum_manajemen_mahasiswa
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi & seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets & jalankan server**
   ```bash
   npm run build
   php artisan serve
   ```

7. **Buka browser**: `http://127.0.0.1:8000`

## 🔑 Akun Pengujian Bawaan

| Role | Email | Password |
|:-----|:------|:---------|
| **Admin** | admin@gmail.com | password |
| **User** | user@gmail.com | password |

## 🔐 Hak Akses

| Fitur | Admin | User |
|:------|:-----:|:----:|
| Dashboard | ✅ | ✅ |
| Lihat Data Mahasiswa | ✅ | ✅ |
| Tambah Mahasiswa | ✅ | ❌ |
| Ubah Mahasiswa | ✅ | ❌ |
| Hapus Mahasiswa | ✅ | ❌ |

## 📂 Struktur File Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/RegisteredUserController.php   # Registrasi + role
│   │   └── MahasiswaController.php             # CRUD Mahasiswa
│   └── Middleware/
│       └── RoleMiddleware.php                  # Middleware role
├── Models/
│   ├── User.php         # Model user + helper isAdmin(), isUser()
│   └── Mahasiswa.php    # Model mahasiswa
database/
├── migrations/
│   ├── ..._create_users_table.php       # Tabel users + kolom role
│   └── ..._create_mahasiswas_table.php  # Tabel mahasiswas
└── seeders/
    └── DatabaseSeeder.php  # Data akun & mahasiswa awal
resources/views/
├── dashboard.blade.php
└── mahasiswa/
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php
routes/
└── web.php   # Route dengan proteksi middleware role
```

---

> **Dibuat oleh**: Eleazar Amarya — Praktikum Pemrograman Web
