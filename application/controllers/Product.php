<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$page = $this->Login_model->isvalid_page();
		if ($page == false) {
			show_404();
		}

		$header = [];

		$body = [
			'content' => 'product/index',
			'title' => lang('menu_products')
		];

		$footer = [
			'js' => ['assets/js/apps/product/index.js']
		];

		$plugins = ['datatables'];

		$this->template($header, $body, $footer, $plugins);
	}

}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */ ?>