<?php

namespace App\Controllers;

use App\Models\SparepartsModel;
use App\Models\StokModel;
use App\Models\SupplierModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stok extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $SpareParts_model;
    protected $supplier_model;
    protected $stok_model;


    ######################################## Initialize Objects ########################################
    public function __construct()
    {
        $this->SpareParts_model = new SparepartsModel();
        $this->supplier_model = new SupplierModel();
        $this->stok_model = new StokModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        helper(['fungsi_helper']);
    }

    ######################################## Home Page Stock In ########################################
    public function index()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | List Stock In";
        $this->data['tb_stok'] =  $this->stok_model->detailStokMasuk();
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->stok_model->select('*')->where('tipe', 'masuk')->countAllResults();
        $this->data['stok_masuk'] = $this->stok_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['stok_masuk'])? count($this->data['stok_masuk']) : 0;
        $this->data['pager'] = $this->stok_model->pager;
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/list');
        echo view('partial/footer');
    }

    ######################################## Home Page Stock Out ########################################
    public function indexStokKeluar()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | List Stock Out";
        $this->data['tb_stok'] =  $this->stok_model->detailStokKeluar();
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->stok_model->select('*')->where('tipe', 'keluar')->countAllResults();
        $this->data['stok_keluar'] = $this->stok_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['stok_keluar'])? count($this->data['stok_keluar']) : 0;
        $this->data['pager'] = $this->stok_model->pager;
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/keluar/list');
        echo view('partial/footer');
    }

    ######################################## Create Stock In ########################################
    public function createStokMasuk()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | Add Stock In";
        $this->data['request'] =  $this->request;
        $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['spareparts_id'] =  $this->SpareParts_model->detailProduk();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/create', $this->data);
        echo view('partial/footer');
    }

    ######################################## Create Stock Out ########################################
    public function createStokKeluar()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | Add Stock Out";
        $this->data['request'] =  $this->request;
        $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['spareparts_id'] =  $this->SpareParts_model->detailProduk();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/keluar/create', $this->data);
        echo view('partial/footer');
    }

    ######################################## Save Stok Masuk ########################################
    public function saveStokMasuk()
    {
        // validasi input
        if (!$this->validate([
            'spareparts_id' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'supplier_id' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'jumlah' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'keterangan' => [
                'rules' => 'required|min_length[2]|max_length[50]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

        ])) {
            $respon = [
                'validasi' => false,
                'error'    => $this->validator->getErrors(),
            ];
            $validation = \Config\Services::validation();
            $this->data['validation'] = \Config\Services::validation();
            return redirect()->to('/stok/createStokMasuk')->withInput()->with('validation', $validation);
            // return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }
        
        $this->data['request'] = $this->request;
        $post = [
            'supplier_id'   => $this->request->getPost('supplier_id'),
            'spareparts_id' => $this->request->getPost('spareparts_id'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'tipe'          => $this->request->getPost('tipe'),
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->stok_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->stok_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Stok has been updated successfully');
            else{
                $this->stok_model->stok_bertambah($post);
                $data['hasil']=$this->session->setFlashdata('success_message', 'Stok has been added successfully');
            }
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;

            return redirect()->to('/stok/view_detailStokMasuk/' . $id);

        } else {
            return view('stok/create', $this->data);
        }
    }

    ######################################## Save Stok Keluar ########################################
    public function saveStokKeluar()
    {
        // validasi input
        if (!$this->validate([
            'spareparts_id' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'supplier_id' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'jumlah' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'keterangan' => [
                'rules' => 'required|min_length[1]|max_length[50]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

        ])) {
            $respon = [
                'validasi' => false,
                'error'    => $this->validator->getErrors(),
            ];
            $validation = \Config\Services::validation();
            $this->data['validation'] = \Config\Services::validation();
            return redirect()->to('/stok/createStokKeluar')->withInput()->with('validation', $validation);
            return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

        $this->data['request'] = $this->request;
        $post = [
            'supplier_id'   => $this->request->getPost('supplier_id'),
            'spareparts_id' => $this->request->getPost('spareparts_id'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'tipe'          => $this->request->getPost('tipe'),
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->stok_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->stok_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Stok has been updated successfully');
            else{
                $this->stok_model->stok_berkurang($post);
                $data['hasil']=$this->session->setFlashdata('success_message', 'Stok has been added successfully');
            }
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;

            return redirect()->to('/stok/view_detailStokKeluar/' . $id);

        } else {
            return view('stok/create', $this->data);
        }
    }

    ######################################## Delete Data Stok Masuk ########################################
    public function deleteStokMasuk($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stok/index');
        }
        $delete = $this->stok_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Stok has been deleted successfully.');
            return redirect()->to('/stok/index');
        }
    }

    ######################################## Delete Data Stok Keluar ########################################
    public function deleteStokKeluar($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stok/indexStokKeluar');
        }
        $delete = $this->stok_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Stok has been deleted successfully.');
            return redirect()->to('/stok/indexStokKeluar');
        }
    }

    ######################################## View Data Stock In ########################################
    public function view_detailStokMasuk($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stok/index');
        }
        $this->data['body_class'] = "";
        $this->data['title'] = "Bengkel ABC | View Stock In Details";
        $qry = $this->stok_model->select('tb_stok.id, tb_stok.supplier_id, tb_stok.jumlah, tb_stok.keterangan, tb_stok.tipe, tb_stok.ip_address, tb_stok.spareparts_id, tb_stok.created_at, tb_spareparts.kode_spareparts, tb_spareparts.spareparts, tb_spareparts.harga, tb_spareparts.stok, tb_supplier.nama, tb_kategori.kategori')
        ->join('tb_spareparts', 'tb_spareparts.id = tb_stok.spareparts_id')
        ->join('tb_kategori', 'tb_kategori.id = tb_spareparts.kategori_id')
        ->join('tb_supplier', 'tb_supplier.id = tb_stok.supplier_id')->where(['tb_stok.id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/view', $this->data);
        echo view('partial/footer');
    }

    ######################################## View Data Stock Out ########################################
    public function view_detailStokKeluar($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stok/index');
        }
        $this->data['body_class'] = "";
        $this->data['title'] = "Bengkel ABC | View Stock Out Details";
        $qry = $this->stok_model->select('tb_stok.id, tb_stok.supplier_id, tb_stok.jumlah, tb_stok.keterangan, tb_stok.tipe, tb_stok.ip_address, tb_stok.spareparts_id, tb_stok.created_at, tb_spareparts.kode_spareparts, tb_spareparts.spareparts, tb_spareparts.harga, tb_spareparts.stok, tb_supplier.nama, tb_kategori.kategori')
        ->join('tb_spareparts', 'tb_spareparts.id = tb_stok.spareparts_id')
        ->join('tb_kategori', 'tb_kategori.id = tb_spareparts.kategori_id')
        ->join('tb_supplier', 'tb_supplier.id = tb_stok.supplier_id')->where(['tb_stok.id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/keluar/view', $this->data);
        echo view('partial/footer');
    }

    ######################################## Search Produk ########################################
    public function cariProduk()
    {
        $keyword = $this->request->getGet('search', FILTER_SANITIZE_SPECIAL_CHARS);
        $cek     = $this->SpareParts_model->cariProduk($keyword);
        $data    = [];
        foreach ($cek as $row) {
            $array = [
                'id'   => $row->kode_spareparts,
                'text' => "$row->kode_spareparts - $row->spareparts",
            ];
            array_push($data, $array);
        }

        return $this->response->setJSON([
            'results' => $data,
        ]);
    }

    ######################################## Download ########################################
    public function download()
    {
        // Instansiasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        // styling
        $style = [
            'font'      => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($style); // tambahkan style
        $spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(30); // setting tinggi baris
        // setting lebar kolom otomatis
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        // set kolom head
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Barcode')
            ->setCellValue('C1', 'Spare Parts')
            ->setCellValue('D1', 'Kategori')
            ->setCellValue('E1', 'Harga')
            ->setCellValue('F1', 'Stok');
        $row = 2;
        // looping data item
        foreach ($this->SpareParts_model->detailItem() as $key => $data) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $row, $key + 1)
                ->setCellValue('B' . $row, $data->kode_spareparts)
                ->setCellValue('C' . $row, $data->spareparts)
                ->setCellValue('D' . $row, $data->kategori_id)
                ->setCellValue('E' . $row, $data->harga)
                ->setCellValue('F' . $row, $data->stok);
            $row++;
        }
        // tulis dalam format .xlsx
        $writer   = new Xlsx($spreadsheet);
        $namaFile = 'Daftar_Stok_Produk_' . date('d-m-Y');
        // Redirect hasil generate xlsx ke web browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $namaFile . '.xlsx');
        $writer->save('php://output');
        exit;
    }

}