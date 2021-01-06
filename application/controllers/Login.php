<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index()
	{
		$islogin = $this->Login_model->is_login();

		if ($islogin) {
			$username = $this->session->userdata('username');
			$first_page = $this->Login_model->first_page($username);
			redirect($first_page, 'refresh');
		}

		$config = $this->config->item('app');
		$this->load->view('login', ['config' => $config]);
	}

	public function proses_login()
	{
		$islogin = $this->Login_model->is_login();

		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$remember = $this->input->post('remember', TRUE);

		$first_page = $this->Login_model->first_page($username);

		if ($islogin) {
			redirect($first_page, 'refresh');
		}

		$login = $this->Login_model->login($username, $password);

		$islogin = isset($login['islogin']) ? $login['islogin'] : FALSE;
		$session = isset($login['session']) ? $login['session'] : '';
		$language = isset($login['language']) ? $login['language'] : '';

		$config = $this->config->item('app');

		if ($islogin == true) {
			if ($remember == 1) {
				set_cookie('auth-login', $session, 36000);
			}

			$session_data = array(
				'site_lang' => $language,
				'session' => $session,
				'username' => $username
			);
			
			$this->session->set_userdata( $session_data );
			redirect($first_page, 'refresh');
		}

		$this->session->set_flashdata('message', 'Username / password salah');
		$this->load->view('login', ['config' => $config]);
	}

	public function clear_session()
	{
		$this->session->sess_destroy();
		delete_cookie('auth-login');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */ ?>