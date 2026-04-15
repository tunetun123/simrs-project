# Perencanaan Implementasi API Backend (Layered Architecture)

Dokumen ini berisi perencanaan untuk pembuatan backend API menggunakan framework Laravel dengan menerapkan pola **Layered Architecture** (Controller -> Service -> Repository -> Model). Harap gunakan dokumen ini sebagai panduan implementasi.

## Spesifikasi API

Buat API untuk operasi CRUD data Pasien dan proses Registrasi Pasien (Kunjungan) dengan endpoint berikut:

*   **Endpoint CRUD Pasien:** `/api/front-office/patients`
*   **Endpoint Registrasi Pasien:** `/api/front-office/register`

*Catatan: Pastikan format request dan response disesuaikan dengan struktur tabel `patients` dan `registrations` yang sudah ada pada migrasi sebelumnya.*

---

## Tahapan Pengerjaan

Berikut adalah langkah-langkah sistematis yang harus dilakukan oleh AI untuk mengimplementasikan planning ini:

### 1. Persiapan Struktur Layered Architecture
*   Buat direktori baru di dalam `app/` untuk layer Service dan Repository, yaitu `app/Services` dan `app/Repositories`.
*   Terapkan *Dependency Injection* agar Controller memanggil Service, dan Service memanggil Repository.

### 2. Pembuatan Model & Relasi
*   Pastikan Model `Patient` dan `Registration` sudah memiliki konfigurasi `$fillable` (atau `$guarded`) yang sesuai dengan struktur kolom tabel.
*   Tambahkan relasi antar Model. Misalnya: Model `Patient` memiliki relasi `hasMany` ke `Registration`, dan Model `Registration` memiliki relasi `belongsTo` ke `Patient`, `Polyclinic`, dan `Insurance`.

### 3. Pembuatan Interface dan Class Repository
*   **PatientRepository:** Buat interface dan implementasinya untuk menangani query langsung ke database (misal: ambil semua data, cari berdasarkan ID, simpan data baru, update data, hapus data).
*   **RegistrationRepository:** Buat interface dan implementasinya untuk menangani query terkait tabel registrasi kunjungan.
*   *(Opsional)* Binding Interface ke Implementasi melalui Service Provider (contoh: `RepositoryServiceProvider`).

### 4. Pembuatan Service Class (Business Logic)
*   **PatientService:** Menangani logika bisnis untuk pasien (seperti memformat/generate Nomor Rekam Medis dengan metode *Straight Numerical Filing* secara otomatis sebelum menyimpan data).
*   **RegistrationService:** Menangani logika bisnis untuk pendaftaran (seperti memformat `visit_number` otomatis sesuai format `[tahun/bulan/tanggal/nomor urut]`).

### 5. Pembuatan API Resource & Form Request (Validasi)
*   **API Resources:** Buat `PatientResource` dan `RegistrationResource` (`php artisan make:resource`) untuk memformat / mem-filter respons JSON agar konsisten.
*   **Form Request:** Buat request class (`php artisan make:request`) seperti `StorePatientRequest`, `UpdatePatientRequest`, dan `StoreRegistrationRequest` untuk memvalidasi input dari client sebelum masuk ke Controller.

### 6. Pembuatan Controller
*   Buat Controller khusus API di dalam folder `app/Http/Controllers/Api/FrontOffice/`.
*   **PatientController:** Implementasikan metode `index`, `store`, `show`, `update`, dan `destroy`. Injeksi `PatientService` ke dalam konstruktor.
*   **RegistrationController:** Implementasikan metode untuk menangani proses POST ke endpoint registrasi. Injeksi `RegistrationService` ke dalam konstruktor.
*   Pastikan Controller hanya mengurus HTTP Request & Response (menerima input, memanggil service, dan mengembalikan respons JSON melalui API Resource).

### 7. Pendefinisian Routing
*   Buka file `routes/api.php`.
*   Tambahkan `Route::prefix('front-office')` dan daftarkan routing untuk:
    *   `Route::apiResource('patients', PatientController::class);`
    *   `Route::post('register', [RegistrationController::class, 'store']);`

### 8. Testing (Unit Test & Validasi)
*   **Unit Testing (PHPUnit/Pest):** Buat test cases untuk menguji fungsionalitas Service dan Repository (misalnya, pastikan logika *Straight Numerical Filing* untuk nomor rekam medis berjalan dengan benar dan increment-nya sesuai).
*   **Feature Testing:** Buat test cases untuk menguji endpoint API (`/api/front-office/patients` dan `/api/front-office/register`), pastikan HTTP status code yang dikembalikan sesuai (200 OK, 201 Created, 422 Unprocessable Entity untuk validasi gagal).
*   **Validasi Manual:** Pastikan nomor rekam medis dan nomor kunjungan (visit number) ter-generate otomatis saat menyimpan data baru di database.