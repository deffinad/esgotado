<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    public function getInventory()
    {
        return $this->db->table('t_inventory')->get()->getResult();
    }

    public function getInventoryById($id)
    {
        return $this->db->table('t_inventory')->where('code_sku', $id)->get()->getRowArray();
    }

    public function addInventory($data)
    {
        return $this->db->table('t_inventory')->set($data)->insert();
    }

    public function editInventory($data, $id)
    {
        return $this->db->table('t_inventory')->set($data)->where('code_sku', $id)->update();
    }

    public function deleteInventory($id)
    {
        return $this->db->table('t_inventory')->where('code_sku', $id)->delete();
    }
}
