<?php

/**
 * 
 */
class DataPegawai extends CI_Controller
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
		$data['title'] = 'List Data Pegawai';
		$data['pegawai'] = $this->penggajianModel->get_data('data_pegawai')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/dataPegawai', $data);
		$this->load->view('templates/footer');
	}

	public function tambahData()
	{
		$data['title'] = 'List Tambah Data Pegawai';
		$data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/TambahDataPegawai', $data);
		$this->load->view('templates/footer');
	}

	public function tambahDataAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambahData();
		} else {
			$nik			= $this->input->post('nik');
			$nama_pegawai	= $this->input->post('nama_pegawai');
			$jenis_kelamin	= $this->input->post('jenis_kelamin');
			$tanggal_masuk	= $this->input->post('tanggal_masuk');
			$jabatan		= $this->input->post('jabatan');
			$status			= $this->input->post('status');
			$hak_akses		= $this->input->post('hak_akses');
			$username		= $this->input->post('username');
			$password		= md5($this->input->post('password'));
			$photo			= $_FILES['photo']['name'];
			if ($photo = '') {
			} else {
				$config['upload_path']		= './assets/photo';
				$config['allowed_types']	= 'jpg|jpeg|png|tiff';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('photo')) {
					echo "Photo Gagal di Upload";
				} else {
					$photo = $this->upload->data('file_name');
				}
			}

			$data = [
				'nik'				=> $nik,
				'nama_pegawai'		=> $nama_pegawai,
				'jenis_kelamin'		=> $jenis_kelamin,
				'tanggal_masuk'		=> $tanggal_masuk,
				'jabatan'			=> $jabatan,
				'status'			=> $status,
				'photo'				=> $photo,
				'hak_akses'			=> $hak_akses,
				'username'			=> $username,
				'password'			=> $password
			];

			$this->penggajianModel->insert_data($data, 'data_pegawai');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil ditambahkan</strong> 
				</div>');
			redirect('admin/dataPegawai');
		}
	}

	public function updateData($id)
	{
		$where = ['id_pegawai' => $id];
		$data['title'] = 'Update Data Pegawai';
		$data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')->result_array();
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/FormUpdatePegawai', $data);
		$this->load->view('templates/footer');
	}

	public function updateDataAksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->updateData();
		} else {
			$id				= $this->input->post('id_pegawai');
			$nik			= $this->input->post('nik');
			$nama_pegawai	= $this->input->post('nama_pegawai');
			$jenis_kelamin	= $this->input->post('jenis_kelamin');
			$tanggal_masuk	= $this->input->post('tanggal_masuk');
			$jabatan		= $this->input->post('jabatan');
			$status			= $this->input->post('status');
			$hak_akses		= $this->input->post('hak_akses');
			$username		= $this->input->post('username');
			$password		= md5($this->input->post('password'));
			$photo			= $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path']		= './assets/photo';
				$config['allowed_types']	= 'jpg|jpeg|png|tiff';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					$photo = $this->upload->data('file_name');
					$this->db->set('photo', $photo);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'nik'				=> $nik,
				'nama_pegawai'		=> $nama_pegawai,
				'jenis_kelamin'		=> $jenis_kelamin,
				'tanggal_masuk'		=> $tanggal_masuk,
				'jabatan'			=> $jabatan,
				'status'			=> $status,
				'hak_akses'			=> $hak_akses,
				'username'			=> $username,
				'password'			=> $password
			];

			$where = [
				'id_pegawai' => $id
			];

			$this->penggajianModel->update_data('data_pegawai', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil diupdate!</strong> 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				</div>');
			redirect('admin/dataPegawai');
		}
	}

	public function deleteData($id)
	{
		$where = ['id_pegawai' => $id];
		$this->penggajianModel->delete_data($where, 'data_pegawai');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Data berhasil dihapus</strong> 
				</div>');
		redirect('admin/dataPegawai');
	}


	public function _rules()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
	}
}
