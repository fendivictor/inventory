<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (! $this->input->is_ajax_request()) {
			show_404();
		}

		$islogin = $this->Login_model->is_login();
		if ($islogin == FALSE) {
			redirect(base_url());
		}

		$this->load->library('form_validation');
		$this->load->model(['Main_Model']);
	}

	public function add_products()
	{
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$harga = $this->input->post('harga', TRUE);
		$stok = $this->input->post('stok', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);

		$now = $this->Main_Model->get_time('%Y-%m-%d %H:%i:%s');
		$username = $this->session->userdata('username');

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

		$path = './assets/uploads/product/';

		if ($this->form_validation->run()) {
			# upload configuration
			if (! file_exists($path)) {
				mkdir($path, 0777, true);
			}
			
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'jpg|png|jpeg|gif';
			$config['file_name'] = date('YmdHi');

			$this->load->library('upload', $config);

			$upload_status = false;
			$filename = '';
			if ($this->upload->do_upload('foto')) {
				$upload_status = true;
				$filename = $this->upload->data('file_name');
			}

			$validasi_image = true;
			if ($upload_status === false && $id === '') {
				$validasi_image = false;
			}

			# jika tidak melampirkan foto / format tidak sesuai
			$status = 0;
			$message = $this->upload->display_errors();

			if ($validasi_image) {
				# hapus file foto jika diupdate
				$dataExists = $this->Main_Model->view_data('product', ['id' => $id], 0);
				if ($id != '' && $dataExists && $filename != '') {
					if (file_exists($path.$dataExists->foto)) {
						unlink($path.$dataExists->foto);
					}
				}

				$time = ($id != '') ? 'update_at' : 'insert_at';
				$user = ($id != '') ? 'user_update' : 'user_insert';

				$data = [
					'nama' => $nama,
					'foto' => $filename,
					'harga' => $harga,
					'deskripsi' => $deskripsi,
					'stok' => $stok,
					$time => $now,
					$user => $username
				];

				$condition = ($id != '') ? ['id' => $id] : [];

				$simpan = $this->Main_Model->store_data('product', $data, $condition);

				$status = 0;
				$message = lang('ajax_msg_save_fail');

				if ($simpan) {
					$status = 1;
					$message = lang('ajax_msg_save_success');
				}
			}
		} else {
			$status = 0;
			$message = validation_errors();
		}

		$result = [
			'status' => $status,
			'message' => $message
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function product_id()
	{
		$id = $this->input->get('id', TRUE);

		$data = $this->Main_Model->view_data('product', ['id' => $id], 0);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete_product()
	{
		$id = $this->input->post('id', TRUE);

		$dataExists = $this->Main_Model->view_data('product', ['id' => $id], 0);

		$status = 0;
		$message = lang('ajax_msg_delete_fail');

		if ($dataExists) {
			$foto = $dataExists->foto;

			$path = './assets/uploads/product/';

			$delete = $this->Main_Model->delete_data('product', ['id' => $id]);

			if ($delete) {
				$status = 1;
				$message = lang('ajax_msg_delete_success');

				unlink($path.$foto);
			}
		}	

		$result = [
			'status' => $status,
			'message' => $message 
		];

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */ ?>