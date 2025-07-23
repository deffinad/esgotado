<?php

namespace App\Controllers;

use App\Models\OutboundModel;
use App\Models\InventoryModel;
use App\Models\LogActivityModel;
use PhpParser\Node\Stmt\Break_;

class Outbound extends BaseController
{
    protected $session;
    protected $mOutbound;
    protected $mInventory;
    protected $mLog;
    protected $validation;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->validation = \Config\Services::validation();

        $this->mOutbound = new OutboundModel();
        $this->mInventory = new InventoryModel();
        $this->mLog = new LogActivityModel();
    }

    public function addOutboundProcess()
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

            if($dlInv['stock'] < $input['amount'] || $dlInv['stock'] == 0){
                $this->session->setFlashdata('gagal', 'Data Amount/Unit Melebihi Stock Yang Ada');
                $this->session->setFlashdata('input', $this->request->getPost());
                return redirect()->back();
            }else{
                $stockInv = $dlInv['stock'] - $input['amount'];
    
                $result = $this->mOutbound->addOutbound($data);
                $resultStock = $this->mInventory->editInventory(['stock' => $stockInv], $input['code']);
    
                if ($result && $resultStock) {
                    $data = [
                        'id_user' => $this->session->get('isLogged')['id_user'],
                        'date' => date('Y-m-d H:i:s'),
                        'action' => 'Add outbound ' . $input['type_materials'] . '/' . $input['code'] . '/' . $input['serial_number']
                    ];
    
                    $this->mLog->addLog($data);
                    $this->session->setFlashdata('sukses', 'Data Outbound Berhasil Ditambahkan');
                } else {
                    $this->session->setFlashdata('gagal', 'Data Outbound Gagal Ditambahkan');
                }
    
                return redirect()->to('production/outbound');
            }
            
        }
    }

    public function editOutboundProcess($id)
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
            $dlInb = $this->mOutbound->getOutboundById($id);
            $stockInv = ($dlInv['stock'] + $dlInb['amount_unit']) - $input['amount'];

            $result = $this->mOutbound->editOutbound($data, $id);
            $resultStock = $this->mInventory->editInventory(['stock' => $stockInv], $input['code']);

            if ($result && $resultStock) {
                $data = [
                    'id_user' => $this->session->get('isLogged')['id_user'],
                    'date' => date('Y-m-d H:i:s'),
                    'action' => 'Edit outbound ' . $input['type_materials'] . '/' . $input['code'] . '/' . $input['serial_number']
                ];

                $this->mLog->addLog($data);
                $this->session->setFlashdata('sukses', 'Data Outbound Berhasil Diubah');
            } else {
                $this->session->setFlashdata('gagal', 'Data Outbound Gagal Diubah');
            }

            return redirect()->to('production/outbound');
        }
    }

    public function deleteOutboundProcess($id)
    {
        $outbound = $this->mOutbound->getOutboundById($id);
        $dlInv = $this->mInventory->getInventoryById($outbound['code_sku']);
        $stockInv = ($dlInv['stock'] + $outbound['amount_unit']);

        $data = [
            'id_user' => $this->session->get('isLogged')['id_user'],
            'date' => date('Y-m-d H:i:s'),
            'action' => 'Delete outbound ' . $outbound['type_of_material'] . '/' . $outbound['code_sku'] . '/' . $outbound['serial_number']
        ];

        $this->mLog->addLog($data);
        $result = $this->mOutbound->deleteOutbound($id);
        if ($result) {
            $this->mInventory->editInventory(['stock' => $stockInv], $dlInv['code_sku']);
            $this->session->setFlashdata('sukses', 'Data Outbound Berhasil Dihapus');
        } else {
            $this->session->setFlashdata('gagal', 'Data Outbound Gagal Dihapus');
        }

        return redirect()->to('production/outbound');
    }
}
