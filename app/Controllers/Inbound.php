<?php

namespace App\Controllers;

use App\Models\InboundModel;
use App\Models\InventoryModel;
use App\Models\LogActivityModel;
use PhpParser\Node\Stmt\Break_;

class Inbound extends BaseController
{
    protected $session;
    protected $mInbound;
    protected $mInventory;
    protected $mLog;
    protected $validation;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->validation = \Config\Services::validation();

        $this->mInbound = new InboundModel();
        $this->mInventory = new InventoryModel();
        $this->mLog = new LogActivityModel();
    }

    public function addInboundProcess()
    {
        $input = $this->request->getPost();

        $validation = [
            'date' => $input['date'] ?? '',
            'type_materials' => $input['type_materials'] ?? '',
            'amount' => $input['amount'] ?? '',
            'code' => $input['code'] ?? '',
            'unit' => $input['unit'] ?? '',
            'serial_number' => $input['serial_number'] ?? ''
        ];

        if (!$this->validation->run($validation, 'production')) {
            $this->session->setFlashdata('input', $this->request->getPost());
            $this->session->setFlashdata('validationError', $this->validation->getErrors());

            return redirect()->back();
        } else {
            $data = [
                'date' => $input['date'],
                'code_sku' => $input['code'],
                'category' => isset($input['category']) ? $input['category'] : '',
                'amount_unit' => $input['amount'],
                'serial_number' => $input['serial_number'],
                'id_user' => $this->session->get('isLogged')['id_user']
            ];

            $dlInv = $this->mInventory->getInventoryById($input['code']);
            $stockInv = $dlInv['stock'] + $input['amount'];

            $result = $this->mInbound->addInbound($data);
            $resultStock = $this->mInventory->editInventory(['stock' => $stockInv], $input['code']);

            if ($result && $resultStock) {
                $data = [
                    'id_user' => $this->session->get('isLogged')['id_user'],
                    'date' => date('Y-m-d H:i:s'),
                    'action' => 'Add inbound ' . $input['type_materials'] . '/' . $input['code'] . '/' . $input['serial_number']
                ];

                $this->mLog->addLog($data);
                $this->session->setFlashdata('sukses', 'Data Inbound Berhasil Ditambahkan');
            } else {
                $this->session->setFlashdata('gagal', 'Data Inbound Gagal Ditambahkan');
            }

            return redirect()->to('production/inbound');
        }
    }

    public function editInboundProcess($id)
    {
        $input = $this->request->getPost();

        $validation = [
            'date' => $input['date'] ?? '',
            'type_materials' => $input['type_materials'] ?? '',
            'amount' => $input['amount'] ?? '',
            'code' => $input['code'] ?? '',
            'unit' => $input['unit'] ?? '',
            'serial_number' => $input['serial_number'] ?? ''
        ];

        if (!$this->validation->run($validation, 'production')) {
            $this->session->setFlashdata('input', $this->request->getPost());
            $this->session->setFlashdata('validationError', $this->validation->getErrors());

            return redirect()->back();
        } else {
            $data = [
                'date' => $input['date'],
                'code_sku' => $input['code'],
                'category' => isset($input['category']) ? $input['category'] : '',
                'amount_unit' => $input['amount'],
                'serial_number' => $input['serial_number'],
                'id_user' => $this->session->get('isLogged')['id_user']
            ];


            $dlInv = $this->mInventory->getInventoryById($input['code']);
            $dlInb = $this->mInbound->getInboundById($id);
            $stockInv = ($dlInv['stock'] - $dlInb['amount_unit']) + $input['amount'];

            $result = $this->mInbound->editInbound($data, $id);
            $resultStock = $this->mInventory->editInventory(['stock' => $stockInv], $input['code']);

            if ($result && $resultStock) {
                $data = [
                    'id_user' => $this->session->get('isLogged')['id_user'],
                    'date' => date('Y-m-d H:i:s'),
                    'action' => 'Edit inbound ' . $input['type_materials'] . '/' . $input['code'] . '/' . $input['serial_number']
                ];

                $this->mLog->addLog($data);
                $this->session->setFlashdata('sukses', 'Data Inbound Berhasil Diubah');
            } else {
                $this->session->setFlashdata('gagal', 'Data Inbound Gagal Diubah');
            }

            return redirect()->to('production/inbound');
        }
    }

    public function deleteInboundProcess($id)
    {
        $inbound = $this->mInbound->getInboundById($id);
        $dlInv = $this->mInventory->getInventoryById($inbound['code_sku']);
        $stockInv = ($dlInv['stock'] - $inbound['amount_unit']);

        $data = [
            'id_user' => $this->session->get('isLogged')['id_user'],
            'date' => date('Y-m-d H:i:s'),
            'action' => 'Delete inbound ' . $inbound['type_of_material'] . '/' . $inbound['code_sku'] . '/' . $inbound['serial_number']
        ];

        $this->mLog->addLog($data);
        $result = $this->mInbound->deleteInbound($id);
        if ($result) {
            $this->mInventory->editInventory(['stock' => $stockInv], $dlInv['code_sku']);
            $this->session->setFlashdata('sukses', 'Data Inbound Berhasil Dihapus');
        } else {
            $this->session->setFlashdata('gagal', 'Data Inbound Gagal Dihapus');
        }

        return redirect()->to('production/inbound');
    }
}
