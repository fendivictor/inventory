<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datatable extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Main_Model']);
	}

	public function dt_products()
	{
		$response = [];
		$data = $this->Main_Model->view_data('product', [], 1);

		if ($data) {
			$no = 1;
			foreach ($data as $row) {

				$btn_edit = '
					<div class="form-group" style="margin-bottom: 5px;">
						<button type="button" class="btn btn-warning btn-edit btn-xs" title="Edit data" data-id="'.$row->id.'">
							<i class="fa fa-edit"></i> Edit data
						</button>
					</div>';

				$btn_delete = '
					<div class="form-group" style="margin-bottom: 5px;">
						<button type="button" class="btn btn-danger btn-delete btn-xs" title="Delete data" data-id="'.$row->id.'">
							<i class="fa fa-trash"></i> Delete data
						</button>
					</div>';

				$response[] = [
					'no' => $no++,
					'nama' => $row->nama,
					'foto' => '<img src="' . base_url('assets/uploads/product/' . $row->foto) . '" class="img-thumbnail img-product" width="200" />',
					'harga' => number_format($row->harga, 0, ',', '.'),
					'deskripsi' => $row->deskripsi,
					'stok' => number_format($row->stok, 0, ',', '.'),
					'insert_at' => custom_date_format($row->insert_at, 'Y-m-d H:i:s', 'd/m/Y H:i'),
					'user_insert'=> $row->user_insert,
					'update_at' => custom_date_format($row->update_at, 'Y-m-d H:i:s', 'd/m/Y H:i'),
					'user_update' => $row->user_update,
					'tools' => $btn_edit . $btn_delete
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode(['data' => $response]));
	}
}

/* End of file Datatable.php */
/* Location: ./application/controllers/Datatable.php */ ?>