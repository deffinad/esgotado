<?php

namespace App\Models;

use CodeIgniter\Model;

class OutboundModel extends Model
{
    public function getOutbound()
    {
        return $this->db
            ->table('t_outbound as out')
            ->select('out.id_outbound, out.date, out.code_sku, out.amount_unit, out.serial_number, u.id_user, u.nama, inv.type_of_material, inv.stock, inv.unit')
            ->join('t_user as u', 'out.id_user = u.id_user')
            ->join('t_inventory as inv', 'inv.code_sku = out.code_sku')
            ->get()
            ->getResult();
    }

    public function getOutboundByQuery($where)
    {
        return $this->db
            ->table('t_outbound as out')
            ->select('out.id_outbound, out.date, out.code_sku, out.amount_unit, out.serial_number, u.id_user, u.nama, inv.type_of_material, inv.stock, inv.unit')
            ->join('t_user as u', 'out.id_user = u.id_user')
            ->join('t_inventory as inv', 'inv.code_sku = out.code_sku')
            ->where($where)
            ->get()
            ->getResult();
    }

    public function getOutboundById($id)
    {
        return $this->db->table('t_outbound as out')
            ->select('out.id_outbound, out.date, out.code_sku, out.amount_unit, out.serial_number, u.id_user, u.nama, inv.type_of_material, inv.stock, inv.unit')
            ->join('t_user as u', 'out.id_user = u.id_user')
            ->join('t_inventory as inv', 'inv.code_sku = out.code_sku')
            ->where('id_outbound', $id)->get()
            ->getRowArray();
    }

    public function addOutbound($data)
    {
        return $this->db->table('t_outbound')->set($data)->insert();
    }

    public function editOutbound($data, $id)
    {
        return $this->db->table('t_outbound')->set($data)->where('id_outbound', $id)->update();
    }

    public function deleteOutbound($id)
    {
        return $this->db->table('t_outbound')->where('id_outbound', $id)->delete();
    }
}
