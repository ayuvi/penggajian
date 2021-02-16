<?php

class Dashboard extends CI_Controller
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
		$data['title'] = "Dashboard";

		$pegawai = $this->db->query("SELECT * FROM data_pegawai");
		$admin = $this->db->query("SELECT * FROM data_pegawai WHERE 
			jabatan = 'Admin'");
		$jabatan = $this->db->query("SELECT * FROM data_jabatan");
		$kehadiran = $this->db->query("SELECT * FROM data_kehadiran");

		$data['pegawai'] = $pegawai->num_rows();
		$data['admin'] = $admin->num_rows();
		$data['jabatan'] = $jabatan->num_rows();
		$data['kehadiran'] = $kehadiran->num_rows();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer');
	}
}
