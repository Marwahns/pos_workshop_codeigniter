<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SparepartsModel;
use App\Models\SupplierModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpareParts extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $SpareParts_model;
    protected $supplier_model;
    protected $kategori_model;

    ######################################## Initialize Objects ########################################
    public function __construct()
    {
        $this->SpareParts_model = new SparepartsModel();
        $this->supplier_model = new SupplierModel();
        $this->kategori_model = new KategoriModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        helper(['fungsi_helper']);
    }

    ######################################## Home Page ########################################
    public function index()
    {
        $this->data['page_title'] =  "List Spare Parts";
        $this->data['tb_spareparts'] =  $this->SpareParts_model->detailProduk();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('spareparts/list', $this->data);
        echo view('partial/footer');
    }

    ######################################## Create Form Page ########################################
    public function createSpareParts()
    {
        $this->data['page_title'] =  "Add New";
        $this->data['request'] =  $this->request;
        $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['kategori_id'] =  $this->kategori_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['kode_spareparts'] = $this->SpareParts_model->generateKodeSpareParts();
        $this->data['validation'] =  \Config\Services::validation();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('spareparts/create', $this->data);
        echo view('partial/footer');
    }

    ######################################## Save Form Page ########################################
    public function saveSpareParts()
    {
        // validasi input
        if (!$this->validate([
            'kategori_id' => [
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

            'spareparts' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'harga' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'stok' => [
                'rules' => 'required|min_length[1]|max_length[11]',
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
            return redirect()->to('/spareparts/createSpareParts')->withInput()->with('validation', $validation);
            return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

        $this->data['request'] = $this->request;
        $post = [
            'supplier_id' => $this->request->getPost('supplier_id'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kode_spareparts' => $this->request->getPost('kode_spareparts'),
            'spareparts' => $this->request->getPost('spareparts'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->SpareParts_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->SpareParts_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Data has been updated successfully');
            else
                $this->session->setFlashdata('success_message', 'Data has been added successfully');
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/spareparts/view_detailSpareParts/' . $id);
        } else {
            return view('spareparts/create', $this->data);
        }
    }

    ######################################## Edit Form Page ########################################
    public function editSpareParts($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/spareparts/create');
        }
        $this->data['page_title'] = "Edit SpareParts Details";
        $this->data['request'] =  $this->request;
        $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['kategori_id'] =  $this->kategori_model->orderBy('id ASC')->select('*')->get()->getResult();
        $qry = $this->SpareParts_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('spareparts/edit', $this->data);
        echo view('partial/footer');
    }

    ######################################## Delete Data ########################################
    public function deleteSpareParts($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/spareparts/index');
        }
        $delete = $this->SpareParts_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Contact Details has been deleted successfully.');
            return redirect()->to('/spareparts/index');
        }
    }

    ######################################## View Data ########################################
    public function view_detailSpareParts($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/spareparts/index');
        }
        $this->data['page_title'] = "View Contact Details";
        $qry = $this->SpareParts_model->select('tb_spareparts.id, tb_spareparts.kode_spareparts, tb_spareparts.spareparts, tb_spareparts.harga, tb_spareparts.stok, tb_spareparts.supplier_id, tb_spareparts.kategori_id, tb_supplier.nama, tb_kategori.kategori')
        ->join('tb_kategori', 'tb_kategori.id = tb_spareparts.kategori_id')
        ->join('tb_supplier', 'tb_supplier.id = tb_spareparts.supplier_id')
        ->where(['tb_spareparts.id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('spareparts/view', $this->data);
        echo view('partial/footer');
    }

    ######################################## Cari Produk ########################################
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

    ######################################## Download Spreadhsheet ########################################
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
        foreach ($this->SpareParts_model->detailProduk() as $key => $data) {
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

    ######################################## Detail Produk ########################################
    public function detail()
    {
        $data    = $this->SpareParts_model->orderBy('date(created_at)ASC')->select('*')->get()->getResult();
        if (!empty($data)) {
            return $this->response->setJSON($data);
        }
    }

    ######################################## Search Barcode ########################################
    public function barcode()
    {
        $keyword = $this->request->getGet('term', FILTER_SANITIZE_SPECIAL_CHARS);
        $data    = $this->SpareParts_model->barcodeModel($keyword);
        $barcode = [];
        foreach ($data as $item) {
            array_push($barcode, [
                'label' => "{$item->kode_spareparts} - {$item->nama_item}",
                'value' => $item->kode_spareparts,
            ]);
        }

        return $this->response->setJSON($barcode);
    }

    ######################################## Search Produk ########################################
    function search()
    {
        $keyword = $this->request->getPost('keyword');
        $this->data['search_produk'] = $this->SpareParts_model->barcodeModel($keyword);
        echo json_encode($this->SpareParts_model->barcodeModel($keyword));
    }
}
