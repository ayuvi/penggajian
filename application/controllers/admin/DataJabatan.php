<?php 

/**
 * 
 */
class DataJabatan extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Data Jabatan';
		$data['jabatan'] = $this->penggajianModel->get_data('data_jabatan')
			->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/dataJabatan', $data);
		$this->load->view('templates/footer');
	}

	public function tambahData()
	{
		$data['title'] = 'Tambah data Jabatan';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/tambahDataJabatan', $data);
		$this->load->view('templates/footer');
	}

	public function tambahDataAksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambahData();
		}else{
			$nama_jabatan = $this->input->post('nama_jabatan');
			$gaji_pokok = $this->input->post('gaji_pokok');
			$tj_transport = $this->input->post('tj_transport');
			$uang_makan = $this->input->post('uang_makan');

			$data = [
				'nama_jabatan' => $nama_jabatan,
				'gaji_pokok' => $gaji_pokok,
				'tj_transport' => $tj_transport,
				'uang_makan' => $uang_makan
			];

			$this->penggajianModel->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil ditambahkan</strong> 
				</div>');
			redirect('admin/dataJabatan');
		}
	}

	public function updateData($id)
	{
		$where = ['id_jabatan' => $id];
		$data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan = '$id'")->result();
		$data['title'] = 'Tambah data Jabatan';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/updateDataJabatan', $data);
		$this->load->view('templates/footer');
	}

	public function updateDataAksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->updateData();
		}else{
			$id 			= $this->input->post('id_jabatan');
			$nama_jabatan 	= $this->input->post('nama_jabatan');
			$gaji_pokok 	= $this->input->post('gaji_pokok');
			$tj_transport	= $this->input->post('tj_transport');
			$uang_makan 	= $this->input->post('uang_makan');

			$data = [
				'nama_jabatan' => $nama_jabatan,
				'gaji_pokok' => $gaji_pokok,
				'tj_transport' => $tj_transport,
				'uang_makan' => $uang_makan
			];

			$where = [
				'id_jabatan' => $id
			];

			$this->penggajianModel->update_data('data_jabatan',$data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil diupdate</strong> 
				</div>');
			redirect('admin/dataJabatan');
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('nama_jabatan','Nama Jabatan', 'required');
		$this->form_validation->set_rules('gaji_pokok','Gaji Pokok', 'required');
		$this->form_validation->set_rules('tj_transport','Tunjangan Transport', 'required');
		$this->form_validation->set_rules('uang_makan','Uang Makan', 'required');
	}

	public function deleteData($id)
	{
		$where = ['id_jabatan' => $id];
		$this->penggajianModel->delete_data($where, 'data_jabatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Data berhasil dihapus</strong> 
				</div>');
			redirect('admin/dataJabatan');
	}
}



?>