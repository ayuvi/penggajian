<?php

class laporanGaji extends CI_Controller
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
        $data['title'] = "Laporan gaji pegawai";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/filterLaporanGaji');
        $this->load->view('templates/footer');
    }

    public function cetakLaporanGaji()
    {
        $data['title'] = 'Cetak Laporan Gaji Pegawai';
        // apabila form bulan dan tampil kosong tampil bulan dan tahun saat ini
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')
            ->result();

        $data['cetakGaji'] = $this->db->query("SELECT data_pegawai.nik,data_pegawai.nama_pegawai,data_pegawai.jenis_kelamin,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha 
        FROM data_pegawai 
        INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
        INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
        WHERE data_kehadiran.bulan = '$bulantahun'
        ORDER BY data_pegawai.nama_pegawai ASC")->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/cetakDataGaji', $data);
    }
}