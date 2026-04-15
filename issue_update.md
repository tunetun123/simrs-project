# Perencanaan & Implementasi Integrasi API Front-End (jQuery & SweetAlert)

Dokumen ini berisi perencanaan dan catatan implementasi untuk mengintegrasikan API backend dengan tampilan front-end menggunakan jQuery dan SweetAlert2.

## Spesifikasi Kebutuhan & Fitur Utama

1.  **Integrasi API via AJAX:** Menghubungkan form UI dengan endpoint API tanpa reload halaman.
2.  **Notifikasi Interaktif:** Menggunakan **SweetAlert2** untuk konfirmasi, loading state, pesan sukses, dan pesan error.
3.  **Manajemen Pasien (Enhanced):**
    *   Tampilan nomor rekam medis otomatis (SNF) yang di-*disable*.
    *   Checkbox khusus untuk **Pasien Luar Negeri (WNA)** yang mengubah input NIK menjadi Nomor Passport.
    *   Integrasi field **Agama** dan **Golongan Darah**.
    *   **Integrasi Wilayah.id + Select2**: Dropdown otomatis untuk Provinsi, Kota, Kecamatan, dan Kelurahan dengan fitur **ketik manual (tags)** jika data tidak ditemukan.
    *   **SatuSehat Ready**: Field Nomor IHS dengan validasi identitas (NIK/Passport) sebelum melakukan request.
4.  **Manajemen Pendaftaran (Admission):**
    *   Fitur **Pencarian Pasien** otomatis berbasis AJAX.
    *   Data Poliklinik dan Asuransi dimuat secara dinamis dari database.

---

## Detail Implementasi (Update)

### 1. Library & Asset
*   Menambahkan **SweetAlert2** (v11) via CDN.
*   Menambahkan **Select2** (v4.1) dengan tema Bootstrap 5 untuk mendukung pencarian wilayah dan input manual.

### 2. Keamanan & Validasi UI
*   **Konfirmasi Simpan**: Menampilkan dialog konfirmasi sebelum mengirim data.
*   **Validasi Field Kosong**: Peringatan khusus jika ada kolom wajib yang belum diisi menggunakan `checkValidity()`.
*   **Konfirmasi Batal**: Mencegah kehilangan data yang sudah diketik dengan konfirmasi sebelum kembali ke halaman index.
*   **Loading State**: Menampilkan animasi loading "Mohon Tunggu" saat request AJAX sedang diproses.

### 3. Perbaikan Teknis yang Dilakukan
*   **Route Name Collision**: Menambahkan prefix `api.` pada semua rute API di `routes/api.php` untuk menghindari bentrokan dengan rute Web yang menyebabkan tampilan JSON mentah di browser.
*   **DataTables Fix**: Menghapus blok `@empty` pada file Blade untuk menghindari error "Incorrect column count" saat tabel kosong.
*   **JS Dynamic Routing**: Menggunakan placeholder `":patient"` pada fungsi `route()` Laravel di JavaScript untuk menghindari `UrlGenerationException`.

### 4. Tahapan Pengerjaan AJAX
*   Gunakan `e.preventDefault()` pada event submit.
*   Serialisasi data form dengan `$(this).serialize()`.
*   Tangani response sukses (HTTP 201) dengan alert sukses dan redirect.
*   Tangani response error (HTTP 422) dengan memetakan pesan error validasi ke dalam SweetAlert (HTML mode).

---

## Validasi & Pengujian
*   [x] Form pendaftaran pasien menyimpan data via AJAX.
*   [x] Pencarian pasien di form registrasi berfungsi.
*   [x] Notifikasi SweetAlert muncul di semua aksi CRUD (Simpan, Update, Hapus).
*   [x] Input wilayah mendukung pilihan otomatis dan pengetikan manual.
*   [x] DataTables menampilkan data secara dinamis dari database.
