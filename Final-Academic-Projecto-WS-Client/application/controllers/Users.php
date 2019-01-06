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
	 * Users constructor.
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

	function getUser()
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_users. '/getuser/'. 'id_user/1');
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

	function addFriend()
	{
		$response = file_get_contents($this->api_url_users. '/getuser/'. 'id_user/1');
		$data = array(
			'users' => json_decode($response,TRUE)
		);
		$this->load->view('geral/header.php');
		$this->load->view('users/add_friend',$data);
		$this->load->view('geral/footer.php');
	}

	function validate_addFriend()
	{
        $this->form_validation->set_rules('inputIdUser','IdUser','required');
        $this->form_validation->set_rules('inputFriend','Friend','required');

        if($this->form_validation->run()===true)
        {
			$post_data = array(
                'User_id' => $this->input->post('inputIdUser'),
				'friend_id' => $this->input->post('inputFriend'),
			);
		
			$this->addFriend_form($post_data);
		}
		else
		{
			$this->addFriend();
		}
	}

	function addFriend_form($post_data)
    {
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_users . '/addFriend/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($con, CURLOPT_POST, TRUE); // para indiciar que vamos mandar um post
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		curl_close($con);

		$result = json_decode($response,TRUE);
		// NEEDS TO BE DONE IN A VIEW
		echo '<br>';
		echo "Friend was  added :D ";
		echo '<br>';
		echo"
		<form action='http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Client/index.php/users/addfriend'>
		<input type=submit value='Add more friends' />
		</form>";
		
	}

	function validateSpecificUserSearch()
	{
		$this->form_validation->set_rules('inputIdSpecificUser','id', 'required');

		if ($this->form_validation->run() === TRUE) {
			$post_data = array (
				'id' => $this->input->post('inputIdSpecificUser')
			);

			$this->getSpecificUser($post_data);

		}

		else
		{
			$this->getUser();
		}
	}

	function getSpecificUser($post_data)
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_users. '/getuser/'. 'id_user/1');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, TRUE);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 200: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n" . $response;
			}
		}

		curl_close($con);

		$data = array(
			'user' => json_decode($response, true)
		);

		$this->load->view('geral/header');
		$this->load->view('users/getuser', $data);
		$this->load->view('geral/footer');
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

		$this->load->view('geral/header');
		$this->load->view('users/add_user_success');
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

	// TODO: ALL EDIT METHODS NEED WORK
	function editUser($post_data)
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_users .'/edituser/');
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

		$this->load->view('geral/header');
		$this->load->view('users/edit_user_success');
		$this->load->view('geral/footer');
	}

	function editUserForm()
	{
		$this->load->view('users/edit_user_form');
	}

	function validateUserEdition()
	{
		$this->form_validation->set_rules('inputName', 'Name', 'required');
		$this->form_validation->set_rules('inputProfile','Profile','required');
		$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('inputPassword', 'Password', 'required');
		$this->form_validation->set_rules('inputPasswordRetype', 'Password Retype','required');
		$this->form_validation->set_rules('inputStatus','Status','required');

		if ($this->form_validation->run() === TRUE) {
			$post_data = array (
				'id_user' => $this->input->post('inputIdUser'),
				'name' => $this->input->post('inputName'),
				'id_profile' => $this->input->post('inputProfile'),
				'email' => $this->input->post('inputEmail'),
				'password' => $this->input->post('inputPassword'),
				'status' => $this->input->post('inputStatus'),
			);

			$this->editUser($post_data);
		}
		else
		{
			$this->editUserForm();
		}

	}

}
