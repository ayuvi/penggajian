<?php
class gantiPassword extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Ubah Password";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('formGantiPassword', $data);
        $this->load->view('templates/footer');
    }

    public function gantiPasswordAksi()
    {
        $newPassword    = $this->input->post('newPassword');
        $repeatPassword = $this->input->post('repeatPassword');

        $this->form_validation->set_rules('newPassword', 'New Password', 'required|matches[repeatPassword]');
        $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required');

        if ($this->form_validation->run() != FALSE) {
            $data = ['password' => md5($newPassword)];
            $id = ['id_pegawai' => $this->session->userdata('id_pegawai')];

            $this->penggajianModel->update_data('data_pegawai', $data, $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Password berhasil diupdate</strong> 
				</div>');
            redirect('welcome');
        } else {
            $data['title'] = "Ubah Password";

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('formGantiPassword', $data);
            $this->load->view('templates/footer');
        }
    }
}
