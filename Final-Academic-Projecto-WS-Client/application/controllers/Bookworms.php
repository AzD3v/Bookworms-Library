<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property string api_url_book
 */

class Bookworms extends CI_Controller
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

	var $api_url_book;

	/**
	 * Bookworms constructor.
	 */

	public function __construct()
	{
		parent::__construct();
		$this->api_url_book = 'http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/api/book/';
		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}

	public function index()
	{
		$this->load->view('bookworms/welcome');
	}

	function getBook($id = 0)
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_book . '/getbook/' . ($id != 0 ? 'id/' . $id : ''));
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
			'books' => json_decode($response, true)
		);
		$this->load->view('geral/header');
		$this->load->view('bookworms/getbook', $data);
		$this->load->view('geral/footer');

	}

	function addBook($post_data)
	{

		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_book . '/addbook/');
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
			'books' => json_decode($response, true)
		);

		exit();
		$this->load->view('geral/header');
		$this->load->view('bookworms/addbook', $data);
		$this->load->view('geral/footer');
	}

	function addMovieForm()
	{
		$this->load->view('geral/header.php');
		$this->load->view('bookworms/add_book_form');
		$this->load->view('geral/footer.php');
	}

	function validateNewMovie()
	{
		/* $this->form_validation->set_rules('movieTitle', 'Title', 'required');
		$this->form_validation->set_rules('movieYear', 'Movie Year', 'required');
		$this->form_validation->set_rules('movieDescription', 'Movie Description');
		$this->form_validation->set_rules('MovieImdbId', 'IMDb ID of the Movie');
		$this->form_validation->set_rules('movieUserId', 'User ID', 'required');
		$this->form_validation->set_rules('movieGenreId', 'Genre ID', 'required');

		if ($this->form_validation->run() === TRUE) {
			$post_data = array(
				'title' => $this->input->post('movieTitle'),
				'year' => $this->input->post('movieYear'),
				'description' => $this->input->post('movieDescription'),
				'imdb_id' => $this->input->post('movieImdbId'),
				'user_id' => $this->input->post('movieUserId'),
				'gender_id' => $this->input->post('movieGenreId')
			);

			if (isset($_FILES) && $_FILES['userfile']['error'] == 0) {
				$config['upload_path'] = 'upload/';
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('userfile')) {
					$data = array(
						'message' => $this->upload->display_errors()
					);
					$this->load->view('geral/header');
					echo $data['message'];
					$this->load->view('geral/footer');
				} else {
					$upload_data = $this->upload->data();
					// print_r($upload_data); exit;
					$post_data['userfile'] = base64_encode(file_get_contents($upload_data['full_path'])
					);
				}
			}
			else
			{
				echo "deu erro a fazer upload";
				exit();
			}

			$this->addMovie($post_data);
		}
		else
		{
			$this->addMovieForm();
		} */

	}

}
