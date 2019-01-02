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

	function getBook()
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_book . '/getbook/');
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

		$data = array (
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

		$this->load->view('geral/header');
		$this->load->view('bookworms/add_book_success', $data);
		$this->load->view('geral/footer');
	}

	function addBookForm()
	{
		$this->load->view('geral/header.php');
		$this->load->view('bookworms/add_book_form');
		$this->load->view('geral/footer.php');
	}

	function validateNewBook()
	{
		$this->form_validation->set_rules('bookName', 'Book Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('bookAuthor', 'Book Author', 'required');
		$this->form_validation->set_rules('bookGenreId', 'Book Genre ID', 'required|numeric');
		$this->form_validation->set_rules('bookDescription', 'Book Description', 'required');
		$this->form_validation->set_rules('bookIsbn', 'ISBN (International Standard Book Number) of the book',
											'required|alpha_numeric');
		$this->form_validation->set_rules('bookRegister', 'Who is registering this book?', 'required');

		if ($this->form_validation->run() === TRUE) {
			$post_data = array(
				'name' => $this->input->post('bookName'),
				'author' => $this->input->post('bookAuthor'),
				'genre_id' => $this->input->post('bookGenreId'),
				'description' => $this->input->post('bookDescription'),
				'isbn' => $this->input->post('bookIsbn'),
				'register' => $this->input->post('bookRegister')
			);

			if (isset($_FILES) && $_FILES['bookCover']['error'] == 0) {
				$config['upload_path'] = 'upload/';
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('bookCover')) {
					$data = array(
						'message' => $this->upload->display_errors()
					);
					$this->load->view('geral/header');
					echo $data['message'];
					$this->load->view('geral/footer');
				} else {
					$upload_data = $this->upload->data();
					$post_data['bookCover'] = base64_encode(file_get_contents($upload_data['full_path'])
					);
				}
			}
			else
			{
				echo "Error while uploading cover!";
				exit();
			}

			$this->addBook($post_data);
		}
		else
		{
			$this->addBookForm();
		}

	}



}
