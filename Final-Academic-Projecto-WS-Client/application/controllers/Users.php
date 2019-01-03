<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property string api_url_book
 */

class Users extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	var $api_url_users;

	/**
	 * Bookworms constructor.
	 */

	public function __construct()
	{
		parent::__construct();
        
        $this->api_url_users = 'http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user/';

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}
}
