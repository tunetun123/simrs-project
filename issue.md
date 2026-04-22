# Perencanaan Perbaikan Bug & Peningkatan UI

Dokumen ini berisi daftar masalah (issues) yang ditemukan pada sistem beserta panduan langkah demi langkah untuk menyelesaikannya. Panduan ini dirancang agar mudah diikuti oleh programmer junior.

---

## Issue 1: Modal Menimpa Notifikasi & Tidak Tertutup Otomatis

**Deskripsi Masalah:**
Saat pengguna menyimpan data melalui form di dalam Modal (pop-up), modal tersebut tidak tertutup secara otomatis setelah proses berhasil. Akibatnya, notifikasi sukses (seperti SweetAlert) muncul di belakang atau tertimpa oleh modal tersebut.

**Langkah-langkah Pengerjaan:**
1. **Identifikasi File:** Cari semua file view (`.blade.php`) di dalam folder `resources/views` yang menggunakan Modal untuk menambah atau mengedit data (contohnya di menu master data, departemen, atau jabatan).
2. **Cari Script AJAX:** Di bagian bawah file view (biasanya di dalam `@push('myscript')`), cari blok kode JavaScript yang menangani pengiriman form (`$('form').on('submit', ...)`).
3. **Perbaiki Callback `success`:** Di dalam fungsi `success` pada AJAX, pastikan kamu menambahkan perintah untuk menyembunyikan modal *sebelum* memunculkan notifikasi sukses.
4. **Contoh Kode Perbaikan:**
   ```javascript
   $.ajax({
       url: '/api/endpoint-kamu',
       type: 'POST',
       data: formData,
       success: function(response) {
           // 1. Tutup modal terlebih dahulu (Ganti #idModal dengan ID modal yang sesuai)
           $('#idModal').modal('hide'); 
           
           // 2. Baru tampilkan notifikasi sukses
           Swal.fire('Berhasil!', 'Data berhasil disimpan.', 'success').then(() => {
               // Reload halaman atau update tabel
               location.reload();
           });
       },
       // ...
   });
   ```

---

## Issue 2: Konflik Route pada Nomor Registrasi Pasien (Visit Number)

**Deskripsi Masalah:**
Fitur melihat detail (Show) dan menghapus (Delete) registrasi pasien mengalami error. Hal ini terjadi karena parameter yang dikirim di URL adalah Nomor Registrasi (Visit Number) yang mungkin memiliki format tertentu (seperti mengandung huruf, angka, atau tanda strip), sehingga Laravel salah mengenalinya sebagai route lain, bukan sebagai parameter.

**Langkah-langkah Pengerjaan:**
1. **Periksa Urutan Route:** Buka file `routes/web.php` dan `routes/api.php`. Pastikan pendefinisian route statis diletakkan *sebelum* route dinamis. 
   *(Contoh yang SALAH: Route `registrations/{id}` ditulis di atas Route `registrations/report`, sehingga `/report` dianggap sebagai `{id}`).*
2. **Gunakan Regular Expression (Regex) Constraint:** Jika `visit_number` memiliki format khusus (misalnya mengandung karakter `/` atau format unik lainnya), beritahu Laravel agar memaklumi format tersebut.
   Buka file route dan tambahkan fungsi `->where()` pada route tersebut.
3. **Contoh Perbaikan di Route:**
   ```php
   // Mengizinkan visit_number mengandung huruf, angka, dan karakter tertentu seperti strip atau garis miring
   Route::get('registrations/{visit_number}', [RegistrationController::class, 'show'])
       ->name('registrations.show')
       ->where('visit_number', '.*'); // '.*' artinya menerima karakter apapun

   Route::delete('registrations/{visit_number}', [RegistrationController::class, 'destroy'])
       ->name('registrations.destroy')
       ->where('visit_number', '.*');
   ```
4. **Cek Controller:** Pastikan fungsi di Controller (misal `RegistrationController@show`) melakukan pencarian ke database menggunakan kolom yang benar (contoh: `where('visit_number', $visit_number)->first()`), bukan menggunakan `find()` yang mencari berdasarkan Primary Key (`id`).

---

## Issue 3: Peningkatan UX pada Validasi Form (Real-time Invalid Feedback & Tanda Wajib)

**Deskripsi Masalah:**
Saat form gagal divalidasi oleh sistem, input form hanya berubah menjadi bergaris merah, tetapi teks keterangan error-nya (`invalid-feedback`) tidak muncul. Selain itu, pengguna ingin agar pesan error otomatis hilang jika mereka mulai memperbaiki ketikannya (real-time validation) dan form yang wajib diisi harus diberi tanda bintang (*).

**Langkah-langkah Pengerjaan:**

**A. Menambahkan Tanda Bintang Wajib (HTML):**
1. Buka semua file view yang memiliki form input.
2. Cari tag `<input>`, `<select>`, atau `<textarea>` yang memiliki atribut `required`.
3. Pada tag `<label>` yang letaknya sebelum input tersebut, tambahkan simbol bintang merah.
   *Contoh:*
   ```html
   <!-- Sebelum -->
   <label class="form-label">Nama Lengkap</label>
   <input type="text" name="name" required>

   <!-- Sesudah -->
   <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
   <input type="text" name="name" required>
   ```

**B. Memperbaiki Pesan Error Tidak Muncul (HTML & JS):**
1. Pastikan struktur HTML kamu mengikuti standar Bootstrap. Tag `<div class="invalid-feedback"></div>` harus diletakkan *tepat di bawah* tag input.
2. Di dalam file JavaScript yang menangani form, pastikan fungsi yang menampilkan error benar-benar mengisi teks ke dalam div tersebut.
   *Contoh fungsi helper yang benar:*
   ```javascript
   function handleValidationErrors(form, errors) {
       // Reset error sebelumnya
       $(form).find('.is-invalid').removeClass('is-invalid');
       $(form).find('.invalid-feedback').text('');
       
       // Looping error dari server
       Object.keys(errors).forEach(key => {
           const input = $(form).find(`[name="${key}"]`);
           input.addClass('is-invalid'); // Bikin border merah
           
           // Cari div invalid-feedback di dekat input dan isi teksnya
           const feedback = input.siblings('.invalid-feedback');
           if (feedback.length) {
               feedback.text(errors[key][0]); // Isi dengan pesan error pertama
           } else {
               // Jika div belum ada di HTML, buatkan otomatis
               input.parent().append(`<div class="invalid-feedback d-block">${errors[key][0]}</div>`);
           }
       });
   }
   ```

**C. Menghilangkan Error Saat Mulai Mengetik (Real-time UX):**
1. Tambahkan satu blok kode JavaScript kecil ini di file layout utama (seperti `layouts/main.blade.php`) atau di setiap halaman form agar berlaku global.
2. Kode ini akan mendeteksi jika user mulai mengetik (`input`) atau memilih opsi (`change`), lalu langsung menghapus border merah dan teks errornya.
   *Tambahkan kode ini di dalam `$(document).ready(function() { ... });`:*
   ```javascript
   // Hapus class is-invalid dan teks error saat user mulai mengisi form
   $(document).on('input change', 'input.is-invalid, select.is-invalid, textarea.is-invalid', function() {
       $(this).removeClass('is-invalid');
       $(this).siblings('.invalid-feedback').text('');
   });
   ```