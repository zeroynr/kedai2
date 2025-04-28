<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id_pegawai'))) {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->load->model('penjualan_model');
    }

    public function index()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['booking'] = $this->penjualan_model->getAllBooking();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/penjualan/index');
        $this->load->view('admin/layout/footer');
    }

    public function detail($invoice)
    {
        $data['title'] = 'Detail';
        $data['book'] = $this->penjualan_model->getBookingByInvoice($invoice);
        $data['menu'] = $this->penjualan_model->getTransaksiByInvoice($invoice);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/penjualan/detail');
        $this->load->view('admin/layout/footer');
    }

    public function filterLaporanPenjualan()
    {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $data['title'] = 'Laporan Penjualan';
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['booking'] = $this->penjualan_model->getBookingByDate($startDate, $endDate);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/penjualan/index');
        $this->load->view('admin/layout/footer');
    }

    public function filterCetakPenjualan()
    {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $profil = $this->penjualan_model->getProfilUsaha();
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['title'] = 'Laporan Penjualan';
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['booking'] = $this->penjualan_model->getBookingByDate($startDate, $endDate);
        $this->load->view('admin/penjualan/invoice', $data);
    }

    public function cetakLaporanPenjualan()
    {
        $profil = $this->penjualan_model->getProfilUsaha();
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['title'] = 'Laporan Penjualan';
        $data['booking'] = $this->penjualan_model->getAllBooking();
        $this->load->view('admin/penjualan/invoice', $data);
    }

    public function cetakNotaPenjualan($invoice)
    {
        $profil = $this->penjualan_model->getProfilUsaha();
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['title'] = 'Nota Penjualan';
        $data['book'] = $this->penjualan_model->getBookingByInvoice($invoice);
        $data['menu'] = $this->penjualan_model->getTransaksiByInvoice($invoice);
        $this->load->view('admin/penjualan/invoice2', $data);
    }
}
