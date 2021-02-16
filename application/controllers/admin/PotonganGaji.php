<?php

class PotonganGaji extends CI_Controller
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
        $data['title'] = "Setting Potongan Gaji";
        $data['pot_gaji'] = $this->penggajianModel->get_data('potongan_gaji')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/potonganGaji', $data);
        $this->load->view('templates/footer');
    }

    public function tambahData()
    {
        $data['title'] = "Tambah Potongan Gaji";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/formPotonganGaji', $data);
        $this->load->view('templates/footer');
    }

    public function tambahDataAksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambahData();
        } else {
            $potongan   = $this->input->post('potongan');
            $jml_potongan   = $this->input->post('jml_potongan');

            $data = [
                'potongan'  => $potongan,
                'jml_potongan'  => $jml_potongan,
            ];

            $this->penggajianModel->insert_data($data, 'potongan_gaji');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil ditambahkan</strong> 
				</div>');
            redirect('admin/potonganGaji');
        }
    }

    public function ubahData($id)
    {
        $where = ['id' => $id];
        $data['title'] = 'Update Data Potongan';
        $data['pot_gaji'] = $this->db->query("SELECT * FROM potongan_gaji WHERE id='$id'")->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/formUpdatePotonganGaji', $data);
        $this->load->view('templates/footer');
    }

    public function updateDataAksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->ubahData();
        } else {
            $id             = $this->input->post('id');
            $potongan       = $this->input->post('potongan');
            $jml_potongan   = $this->input->post('jml_potongan');

            $data = [
                'potongan'  => $potongan,
                'jml_potongan'  => $jml_potongan,
            ];
            $where = ['id' => $id];

            $this->penggajianModel->update_data('potongan_gaji', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Data berhasil diupdate</strong> 
                </div>');
            redirect('admin/potonganGaji');
        }
    }

    public function deleteData($id)
    {
        $where = ['id' => $id];
        $this->penggajianModel->delete_data($where, 'potongan_gaji');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Data berhasil dihapus</strong> 
                </div>');
        redirect('admin/potonganGaji');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('potongan', 'Jenis Potongan', 'required');
        $this->form_validation->set_rules('jml_potongan', 'Jumlah Potongan', 'required');
    }
}
