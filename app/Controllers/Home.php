<?php

namespace App\Controllers;

use App\Models\InboundModel;
use App\Models\InventoryModel;
use App\Models\OutboundModel;
use PhpParser\Node\Stmt\Break_;

class Home extends BaseController
{
    protected $session;
    protected $mInbound;
    protected $mOutbound;
    protected $mInventory;
    protected $listMonth;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->mInbound = new InboundModel();
        $this->mOutbound = new OutboundModel();
        $this->mInventory = new InventoryModel();

        $this->listMonth = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
    }

    public function index()
    {
        $breadcrumb = [
            (object) [
                'name' => 'dashboard',
                'url' => '/'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        $inbound = $this->mInbound->getInbound();
        $outbound = $this->mOutbound->getOutbound();
        $inventory = $this->mInventory->getInventory();

        $count_stock_inbound = 0;
        $count_stock_outbound = 0;

        foreach ($inbound as $val) {
            $count_stock_inbound = $count_stock_inbound + $val->amount_unit;
        }
        foreach ($outbound as $val) {
            $count_stock_outbound = $count_stock_outbound + $val->amount_unit;
        }

        $data['count_stock_inbound'] = $count_stock_inbound;
        $data['count_stock_outbound'] = $count_stock_outbound;
        $data['count_activity'] = count($inbound) + count($outbound);
        $listMonth = [];
        $dataStockInbound = [];
        $dataStockOutbound = [];

        foreach ($this->listMonth as $val) {
            $countInbound = 0;
            $countOutbound = 0;
            array_push($listMonth, $val);
            foreach ($inbound as $valIn) {
                $date = $this->formatDateIndo($valIn->date);
                if ($date['month'] === $val) {
                    $countInbound = $countInbound + $valIn->amount_unit;
                }
            }
            array_push($dataStockInbound, $countInbound);

            foreach ($outbound as $valOut) {
                $date = $this->formatDateIndo($valOut->date);
                if ($date['month'] === $val) {
                    $countOutbound = $countOutbound + $valOut->amount_unit;
                }
            }
            array_push($dataStockOutbound, $countOutbound);
        }

        $data['listMonth'] = $listMonth;
        $data['dataStockInbound'] = $dataStockInbound;
        $data['dataStockOutbound'] = $dataStockOutbound;
        $data['dataInventory'] = $inventory;

        return view('dashboard/index', $data);
    }

    public function detailDashboardView($type = '')
    {
        $breadcrumb = [
            (object) [
                'name' => 'dashboard',
                'url' => '/'
            ],
            (object) [
                'name' => 'detail grafik',
                'url' => '/dashboard/detail/' . $type
            ],
        ];

        $this->session->set('route', $breadcrumb);
        $currentYear = date('Y');
        $inbound = $this->mInbound->getInboundByQuery(['YEAR(in.date)' => $currentYear]);
        $outbound = $this->mOutbound->getOutboundByQuery(['YEAR(out.date)' => $currentYear]);
        $inventory = $this->mInventory->getInventory();

        $listMonth = [];

        foreach ($this->listMonth as $val) {
            array_push($listMonth, $val);
        }

        $data['listMonth'] = $listMonth;
        $data['dataInbound'] = $inbound;
        $data['dataOutbound'] = $outbound;
        $data['dataInventory'] = $inventory;
        $data['type'] = $type;
        $data['currentYear'] = $currentYear;

        return view('dashboard/detail', $data);
    }

    function formatDateIndo($datetime)
    {
        $timestamp = strtotime($datetime);
        $date = date('d', $timestamp);
        $month = (int)date('m', $timestamp);
        $year = date('Y', $timestamp);

        return [
            'date' => $date,
            'month' => $this->listMonth[$month],
            'year' => $year,
        ];
    }

    public function getDataGrafikByYear($year)
    {
        $data['inbound'] = $this->mInbound->getInboundByQuery(['YEAR(in.date)' => $year]);
        $data['outbound'] = $this->mOutbound->getOutboundByQuery(['YEAR(out.date)' => $year]);

        return $this->response->setJSON($data);
    }

    public function profileView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'profile',
                'url' => '/profile'
            ]
        ];

        $this->session->set('route', $breadcrumb);
        $data['user'] = $this->session->get('isLogged');

        return view('profile/index', $data);
    }
}
