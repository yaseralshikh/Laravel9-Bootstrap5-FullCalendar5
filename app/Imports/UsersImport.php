<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel , WithHeadingRow, WithStartRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'              => $row['name'],
            'email'             => $row['email'],
            'specialization_id' => $row['specialization_id'],
            'status'            => $row['status'],
            'password' => Hash::make($row['password']),
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function uniqueBy()
    {
        return 'email';
    }
}
