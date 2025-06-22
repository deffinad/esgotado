<?php

namespace App\Controllers;

use App\Models\InventoryModel;
use App\Models\LogActivityModel;
use PhpParser\Node\Stmt\Break_;

class Inventory extends BaseController
{
    protected $session;
    protected $mInventory;
    protected $mLog;
    protected $validation;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->validation = \Config\Services::validation();

        $this->mInventory = new InventoryModel();
        $this->mLog = new LogActivityModel();
    }

    public function addInventoryProcess()
    {
        $input = $this->request->getPost();

        $validation = [
            'type_materials' => $input['type_materials'] ?? '',
            'amount' => $input['amount'] ?? '',
            'code' => $input['code'] ?? '',
            'unit' => $input['unit'] ?? '',
        ];

        if (!$this->validation->run($validation, 'inventory')) {
            $this->session->setFlashdata('input', $this->request->getPost());
            $this->session->setFlashdata('validationError', $this->validation->getErrors());

            return redirect()->back();
        } else {
            $data = [
                'code_sku' => $input['code'],
                'type_of_material' => $input['type_materials'],
                'stock' => $input['amount'],
                'unit' => $input['unit'],
            ];

            $result = $this->mInventory->addInventory($data);

            if ($result) {
                $data = [
                    'id_user' => $this->session->get('isLogged')['id_user'],
                    'date' => date('Y-m-d H:i:s'),
                    'action' => 'Add inventory ' . $input['type_materials'] . '/' . $input['code']
                ];

                $this->mLog->addLog($data);
                $this->session->setFlashdata('sukses', 'Data Inventory Berhasil Ditambahkan');
            } else {
                $this->session->setFlashdata('gagal', 'Data Inventory Gagal Ditambahkan');
            }

            return redirect()->to('production/inventory');
        }
    }

    public function editInventoryProcess($id)
    {
        $input = $this->request->getPost();

        $validation = [
            'type_materials' => $input['type_materials'] ?? '',
            'amount' => $input['amount'] ?? '',
            'code' => $input['code'] ?? '',
            'unit' => $input['unit'] ?? '',
        ];

        if (!$this->validation->run($validation, 'inventory')) {
            $this->session->setFlashdata('input', $this->request->getPost());
            $this->session->setFlashdata('validationError', $this->validation->getErrors());

            return redirect()->back();
        } else {
            $data = [
                'type_of_material' => $input['type_materials'],
                'stock' => $input['amount'],
                'unit' => $input['unit'],
            ];

            $result = $this->mInventory->editInventory($data, $id);

            if ($result) {
                $data = [
                    'id_user' => $this->session->get('isLogged')['id_user'],
                    'date' => date('Y-m-d H:i:s'),
                    'action' => 'Edit inventory ' . $input['type_materials'] . '/' . $input['code']
                ];

                $this->mLog->addLog($data);
                $this->session->setFlashdata('sukses', 'Data Inventory Berhasil Diubah');
            } else {
                $this->session->setFlashdata('gagal', 'Data Inventory Gagal Diubah');
            }

            return redirect()->to('production/inventory');
        }
    }

    public function deleteInventoryProcess($id)
    {
        $inventory = $this->mInventory->getInventoryById($id);

        $data = [
            'id_user' => $this->session->get('isLogged')['id_user'],
            'date' => date('Y-m-d H:i:s'),
            'action' => 'Delete inventory ' . $inventory['type_of_material'] . '/' . $inventory['code_sku']
        ];

        $this->mLog->addLog($data);
        $result = $this->mInventory->deleteInventory($id);
        if ($result) {
            $this->session->setFlashdata('sukses', 'Data Inventory Berhasil Dihapus');
        } else {
            $this->session->setFlashdata('gagal', 'Data Inventory Gagal Dihapus');
        }

        return redirect()->to('production/inventory');
    }
}
