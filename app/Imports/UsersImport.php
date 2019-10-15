<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Hash;
use Illuminate\Support\Facades\Validator;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Validator::make($row, [
            '0' => 'required|min:6',
            '1' => 'required|unique:users,username',
            '2' => 'required|min:6',
            '3' => 'required|in:2,3,4',
        ])->validate();
        return new User([
          'name'     => $row[0],
          'username'    => $row[1],
          'password' => Hash::make($row[2]),
          'type'    => $row[3],
          'subscriber_id' => auth()->user()->subscriber_id,
          'status' => '1',
        ]);
    }

}
