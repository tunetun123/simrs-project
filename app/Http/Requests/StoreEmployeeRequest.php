<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_code' => 'required|string|max:255|unique:employees,employee_code',
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:employees,nik',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|in:laki-laki,perempuan',
            'last_education' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'village' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'marital_status' => 'required|string|max:50',
            'bank_account_number' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'department_code' => 'required|exists:departments,department_code',
            'position_code' => 'required|exists:positions,position_code',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
            'max' => ':attribute maksimal :max karakter.',
            'min' => ':attribute minimal :min karakter.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => 'Format :attribute harus :values.',
            'date' => 'Format tanggal :attribute tidak valid.',
            'exists' => ':attribute yang dipilih tidak valid.',
            'in' => ':attribute yang dipilih tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'employee_code' => 'Kode Pegawai',
            'full_name' => 'Nama Lengkap',
            'nik' => 'NIK',
            'birth_date' => 'Tanggal Lahir',
            'birth_place' => 'Tempat Lahir',
            'gender' => 'Jenis Kelamin',
            'last_education' => 'Pendidikan Terakhir',
            'contact' => 'Kontak',
            'address' => 'Alamat',
            'phone_number' => 'No. Telepon',
            'marital_status' => 'Status Pernikahan',
            'department_code' => 'Departemen',
            'position_code' => 'Jabatan',
            'photo' => 'Foto',
        ];
    }
}
