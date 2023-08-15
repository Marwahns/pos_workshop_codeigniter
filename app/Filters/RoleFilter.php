<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil peran pengguna dari sesi atau tempat penyimpanan lainnya
        $session = \Config\Services::session();
        $role = $session->get('id_role'); // Ubah ini sesuai dengan penyimpanan peran yang Anda gunakan
        // print_r($role);
        // die();

        // Tentukan halaman-halaman yang diperbolehkan berdasarkan peran
        $allowedPages = [
            '1' => ['dashboard', 'supplier', 'kategori', 'spareparts', 'pembayaran', 'stok', 'profile', 'users'], // Superadmin
            '2' => ['dashboard', 'supplier', 'kategori', 'spareparts', 'pembayaran', 'stok', 'profile'], // Admin
            '3' => ['dashboard', 'pembayaran', 'profile'], // Kasir
        ];

        $controller = strtolower($request->uri->getSegment(1)); // Mendapatkan nama kontroler

        // Jika user belum login
        if(!session()->get('id_role')){
            // maka redirect ke halaman login
            return redirect()->to('/auth/index');
        }

        // Periksa apakah pengguna memiliki akses ke halaman ini berdasarkan peran
        if (!isset($allowedPages[$role]) || !in_array($controller, $allowedPages[$role])) {
            // $session->setFlashdata('alert', 'Anda tidak memiliki akses ke halaman ini.'); // Set flashdata untuk pesan notifikasi
            // return redirect()->to('Auth::index'); // Ubah halaman yang sesuai
            // return redirect()->to('/auth/index');
            return redirect()->back()->with('permission', 'Anda tidak memiliki akses ke halaman yang dituju');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan sesuatu setelah permintaan selesai
    }
}
