<?php

class laporanAbsensi extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('hak_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Silahkan Login terlebih dahulu!</strong> 
                </div>');
            redirect('welcome', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Absensi";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/filterLaporanAbsensi');
        $this->load->view('templates/footer');
    }

    public function cetakLaporanAbsensi()
    {
        $data['title'] = "Cetak Laporan Absensi";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['lap_kehadiran'] = $this->db->query("SELECT * FROM data_kehadiran
                                                        WHERE bulan='$bulantahun'
                                                        ORDER BY nama_pegawai ASC")->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/cetakLaporanAbsensi');
    }
}
