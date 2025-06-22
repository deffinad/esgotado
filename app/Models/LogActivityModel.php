<?php

namespace App\Models;

use CodeIgniter\Model;

class LogActivityModel extends Model
{
    public function getLog()
    {
        return $this->db
            ->table('t_log as log')
            ->select('log.id_log, log.date, log.action, u.id_user, u.nama')
            ->join('t_user as u', 'log.id_user = u.id_user')
            ->get()
            ->getResult();
    }

    public function addLog($data)
    {
        return $this->db->table('t_log')->set($data)->insert();
    }
}
