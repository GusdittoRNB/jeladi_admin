<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportEndUser implements ToModel, WithHeadingRow, WithBatchInserts
{
    private $rows = 0;

    public function model(array $row)
    {
        $row['nik'] = str_replace(' ', '', $row['nik']);
        $row['email'] = str_replace(' ', '', $row['email']);

        $validator = Validator::make($row, [
            'nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8'
        ]);

        if ($validator->passes()) {
            ++$this->rows;
            return new User([
                'nik' => $row['nik'],
                'name' => $row['nama'],
                'gender' => $row['jenis_kelamin'],
                'email' => $row['email'],
                'phone' => $row['no_hp'],
                'address' => $row['alamat'],
                'password' => Hash::make($row['password'] != '' ? $row['password'] : '@jehem2024'),
                'status' => $row['status'] != '' ? $row['status'] : 'active',
                'role' => 'user'
            ]);
        }
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
