<?php

namespace App\Models;

use CodeIgniter\Model;

class InboundModel extends Model
{
    public function getInbound()
    {
        return $this->db
            ->table('t_inbound as in')
            ->select('in.id_inbound, in.date, in.code_sku, in.amount_unit, in.serial_number, u.id_user, u.nama, inv.type_of_material, inv.stock, inv.unit')
            ->join('t_user as u', 'in.id_user = u.id_user')
            ->join('t_inventory as inv', 'inv.code_sku = in.code_sku')
            ->get()
            ->getResult();
    }

    public function getInboundByQuery($where)
    {
        return $this->db
            ->table('t_inbound as in')
            ->select('in.id_inbound, in.date, in.code_sku, in.amount_unit, in.serial_number, u.id_user, u.nama, inv.type_of_material, inv.stock, inv.unit')
            ->join('t_user as u', 'in.id_user = u.id_user')
            ->join('t_inventory as inv', 'inv.code_sku = in.code_sku')
            ->where($where)
            ->get()
            ->getResult();
    }

    public function getInboundById($id)
    {
        return $this->db
            ->table('t_inbound as in')
            ->select('in.id_inbound, in.date, in.code_sku, in.amount_unit, in.serial_number, u.id_user, u.nama, inv.type_of_material, inv.stock, inv.unit')
            ->join('t_user as u', 'in.id_user = u.id_user')
            ->join('t_inventory as inv', 'inv.code_sku = in.code_sku')
            ->where('id_inbound', $id)
            ->get()
            ->getRowArray();
    }

    public function addInbound($data)
    {
        return $this->db->table('t_inbound')->set($data)->insert();
    }

    public function editInbound($data, $id)
    {
        return $this->db->table('t_inbound')->set($data)->where('id_inbound', $id)->update();
    }

    public function deleteInbound($id)
    {
        return $this->db->table('t_inbound')->where('id_inbound', $id)->delete();
    }
}
