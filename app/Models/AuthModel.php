<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function signin($email, $password)
    {
        return $this->db->table('t_user')->where(['email' => $email, 'password' => $password])->get()->getRowArray();
    }

    public function signup($data)
    {
        return $this->db->table('t_user')->set($data)->insert();
    }
}
