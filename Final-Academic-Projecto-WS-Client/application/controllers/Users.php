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
	 * Book constructor.
	 */

	public function __construct()
	{
		parent::__construct();
        
        $this->api_url_users = 'http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user';

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}

	function addUser($post_data)
	{
		//echo $this->api_url_users; exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_users .'/adduser/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, TRUE);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 201: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n" . $response;
			}
		}

		curl_close($con);

		$data = array (
			'users' => json_decode($response, true)
		);

		$this->load->view('geral/header');
		$this->load->view('users/add_user_success', $data);
		$this->load->view('geral/footer');
	}

	function addUserForm()
	{
		$this->load->view('users/add_user_form');
	}

	function validateNewUser()
	{
		$this->form_validation->set_rules('inputIdUser', 'idUser', 'required');
		$this->form_validation->set_rules('inputName', 'Name', 'required');
		$this->form_validation->set_rules('inputProfile','Profile','required');
		$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('inputPassword', 'Password', 'required');
		$this->form_validation->set_rules('inputPasswordRetype', 'Password Retype','required');
		$this->form_validation->set_rules('inputBirth', 'Birth Day', 'required');
		$this->form_validation->set_rules('inputStatus','Status','required');

		if ($this->form_validation->run() === TRUE) {
			$post_data = array (
				'id_user' => $this->input->post('inputIdUser'),
				'name' => $this->input->post('inputName'),
				'id_profile' => $this->input->post('inputProfile'),
				'email' => $this->input->post('inputEmail'),
				'password' => $this->input->post('inputPassword'),
				'birthdate' => $this->input->post('inputBirth'),
				'status' => $this->input->post('inputStatus'),
			);

			$this->addUser($post_data);
		}
		else
		{
			$this->addUserForm();
		}

	}

	function getUser($id = 0)
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_users. '/getuser/'. ($id!=0 ? 'id/'.$id : ''));
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($con);
        if (!curl_errno($con)) {
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)) {
                case 200:
                    break;
                default:
                    echo "Unexpected HTTP code: ", $http_code, "\n";
                    exit;
            }
        }

        $data = array(
            'users' => json_decode($response, true)
		);
		
        $this->load->view('geral/header');
        $this->load->view('users/getuser', $data);
        $this->load->view('geral/footer');

    }

}
