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


    // Initialize Objects
    public function __construct()
    {
        $this->SpareParts_model = new SparepartsModel();
        $this->supplier_model = new SupplierModel();
        $this->stok_model = new StokModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        helper(['fungsi_helper']);
    }

    // Home Page
    public function index()
    {
        // $uri  = $this->request->uri;
        // $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        // if ($uri->getSegment(2) == 'masuk') {
        //     $data['title'] = 'Stok Masuk';
        //     echo view('partial/header', $this->data);
        //     echo view('partial/top_menu');
        //     echo view('partial/side_menu');
        //     echo view('stok/masuk/list');
        //     echo view('partial/footer');
        // } else if ($uri->getSegment(2) == 'keluar') {
        //     $data['title'] = 'Stok Keluar';
        //     echo view('partial/header', $this->data);
        //     echo view('partial/top_menu');
        //     echo view('partial/side_menu');
        //     echo view('stok/keluar/list');
        //     echo view('partial/footer');
        // }

        $this->data['page_title'] =  "List Stock";
        $this->data['tb_stok'] =  $this->stok_model->orderBy('date(created_at)ASC')->select('*')->get()->getResult();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/list');
        echo view('partial/footer');
    }

    // Create Form Page
    public function createStokMasuk()
    {
        $this->data['page_title'] =  "Add New";
        $this->data['request'] =  $this->request;
        $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['spareparts_id'] =  $this->SpareParts_model->orderBy('id ASC')->select('*')->get()->getResult();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/create');
        echo view('partial/footer');
    }

    // Edit Form Page
    public function saveStokMasuk()
    {
        $this->data['request'] = $this->request;
        $post = [
            'supplier_id' => $this->request->getPost('supplier_id'),
            'spareparts_id' => $this->request->getPost('spareparts_id'),
            'jumlah' => $this->request->getPost('jumlah'),
            'keterangan' => $this->request->getPost('keterangan')
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->stok_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->stok_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Data has been updated successfully');
            else
                $this->session->setFlashdata('success_message', 'Data has been added successfully');
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/stok/view_detailStokMasuk/' . $id);
        } else {
            return view('stok/create', $this->data);
        }
    }

    // Edit Form Page
    public function editStokMasuk($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stok/create');
        }
        $this->data['page_title'] = "Edit Stok Details";
        $this->data['request'] =  $this->request;
        $this->data['supplier_id'] =  $this->supplier_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['spareparts_id'] =  $this->SpareParts_model->orderBy('id ASC')->select('*')->get()->getResult();
        $qry = $this->stok_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/edit');
        echo view('partial/footer');
    }

    // Delete Data
    public function deleteStokMasuk($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stok/index');
        }
        $delete = $this->stok_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Contact Details has been deleted successfully.');
            return redirect()->to('/stok/index');
        }
    }

    // View Data
    public function view_detailStokMasuk($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/stokMasuk/index');
        }
        $this->data['page_title'] = "View Contact Details";
        $qry = $this->stok_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        $this->data['join_supplier'] = $this->stok_model->getJoinToSupplier();
        $this->data['join_spareparts'] = $this->stok_model->getJoinToKategori();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('stok/masuk/view');
        echo view('partial/footer');
    }

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
