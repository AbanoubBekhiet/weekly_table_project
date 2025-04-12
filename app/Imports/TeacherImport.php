<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
class TeacherImport implements ToModel, WithHeadingRow, WithValidation{
    public function model(array $row)
    {
        return new User([
            'name'     => $row["name"],
            'email'    => $row["email"],
            'password' => Hash::make($row["password"]),
            'password_not_hashed' => $row["password"],
        ]);
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.unique' => 'This email already exists.',
            'email.email'  => 'The email format is invalid.',
        ];
    }
}
