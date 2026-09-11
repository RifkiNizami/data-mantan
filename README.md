# Mantanku — CRUD Web + Mobile

Aplikasi CRUD data "mantan terindah" (nama, no_hp, alamat, makanan_favorit) serta manajemen "makanan favorit", terdiri dari:
- **`web/`** — Laravel 11, CRUD via halaman web + REST API JSON (termasuk navbar Makanan Favorit dan dropdown makanan favorit).
- **`mobile/`** — Android native (Kotlin, minSdk 29 – targetSdk/compileSdk 36), CRUD via REST API ke Laravel dengan dropdown menu 3 makanan favorit.
- **`mantanku.sql`** — skrip pembuatan database `mantanku`, tabel `makanan_favorit`, dan tabel `mantan_terindah` (dengan data contoh).

Web dan mobile sama-sama membaca/menulis ke satu database MySQL yang sama (`mantanku`), web langsung lewat Eloquent, mobile lewat API Laravel (`/api/mantan` dan `/api/makanan-favorit`).

## 1. Database

1. Jalankan MySQL (mis. lewat Laragon).
2. Import `mantanku.sql`:
   ```
   mysql -u root < mantanku.sql
   ```
   Ini membuat database `mantanku`, tabel `makanan_favorit` (dengan 3 makanan favorit default), tabel `mantan_terindah` (id, nama, no_hp, alamat, makanan_favorit, timestamps), dan data contoh.

## 2. Web (Laravel 11)

```
cd web
composer install      # jika belum
php artisan migrate    # opsional, tabel sudah dibuat oleh mantanku.sql
php artisan serve
```
Buka `http://127.0.0.1:8000`:
- `/mantan` — CRUD Mantan Terindah (dengan pilihan makanan favorit).
- `/makanan-favorit` — CRUD Makanan Favorit (dapat diakses langsung via Navbar).

`.env` sudah diset ke `DB_DATABASE=mantanku`, `DB_USERNAME=root`, `DB_PASSWORD=` (default Laragon). Sesuaikan bila kredensial MySQL berbeda.

**REST API** (dipakai juga oleh app mobile):
| Method | Endpoint | Keterangan |
|---|---|---|
| GET | `/api/mantan` | daftar semua data mantan |
| GET | `/api/mantan/{id}` | detail satu data mantan |
| POST | `/api/mantan` | tambah mantan (`nama`, `no_hp`, `alamat`, `makanan_favorit`) |
| PUT | `/api/mantan/{id}` | update mantan |
| DELETE | `/api/mantan/{id}` | hapus mantan |
| GET | `/api/makanan-favorit` | daftar semua makanan favorit |
| POST | `/api/makanan-favorit` | tambah makanan favorit |
| PUT | `/api/makanan-favorit/{id}` | update makanan favorit |
| DELETE | `/api/makanan-favorit/{id}` | hapus makanan favorit |

Semua response berbentuk JSON `{ success, message, data }`.

## 3. Mobile (Android)

Buka folder `mobile/` di Android Studio (Sync Gradle otomatis mengunduh dependency). Aplikasi sudah dicoba build (`./gradlew assembleDebug`) dan **berhasil**.

- Base URL API ada di `app/src/main/java/com/datamantan/mantanku/data/RetrofitClient.kt`:
  - Default `http://10.0.2.2:8000/` → alamat ini otomatis mengarah ke `localhost:8000` milik komputer host **saat dijalankan di emulator Android**.
  - Untuk **HP fisik**, ganti ke IP LAN komputer, mis. `http://192.168.1.10:8000/`, lalu pastikan HP & komputer satu jaringan Wi-Fi dan `php artisan serve` dijalankan dengan `--host=0.0.0.0`.
- Pastikan `php artisan serve` (web Laravel) sedang berjalan sebelum membuka app mobile, karena mobile murni konsumsi API, tidak ada mode offline.
- Fitur: daftar mantan dengan makanan favorit (RecyclerView + pull-to-refresh), tambah mantan dengan dropdown menu 3 makanan favorit, edit, hapus (dengan konfirmasi), dan halaman detail.

## Catatan

- Route API dan route web sama-sama bernama `mantan.*` secara default oleh Laravel; route API sengaja diberi prefix nama `api.mantan.*` (`routes/api.php`) supaya tidak bentrok dengan `route('mantan.index')` dsb. yang dipakai di Blade view.
- PHP 8.5 di lingkungan ini mendeprecate `PDO::MYSQL_ATTR_SSL_CA` — sudah ditangani di `config/database.php` dan `public/index.php` agar tidak "membocorkan" warning ke response JSON API.
