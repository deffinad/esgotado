<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    public function getCategory()
    {
        return $this->db->table('t_category')->get()->getResult();
    }

    public function getCategoryByInventory($id)
    {
        return $this->db->table('t_category')->where('code_sku', $id)->get()->getResult();
    }

    public function addCategory($data)
    {
        return $this->db->table('t_category')->set($data)->insert();
    }

    public function editCategory($data, $id)
    {
        return $this->db->table('t_category')->set($data)->where('code_sku', $id)->update();
    }

    public function deleteCategoryByInventory($id)
    {
        return $this->db->table('t_category')->where('code_sku', $id)->delete();
    }
}
