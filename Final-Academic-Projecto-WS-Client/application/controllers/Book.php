<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property string api_url_books
 */

class Book extends CI_Controller
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

	var $api_url_books;

	/**
	 * Book constructor.
	 */

	public function __construct()
	{
		parent::__construct();

		$this->api_url_books = 'http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/book';
		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}

	// ****  START OF  METHODS ****

	function getBooks()
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books . '/getbooks/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($con);
		

		$data = array (
			'books' => json_decode($response, true)
		);
		$this->load->view('geral/header');
		$this->load->view('book/getbooks', $data);
		$this->load->view('geral/footer');

	}

	function getBookInfo()
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books . '/getbook/');
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
		$this->load->view('book/getbooks', $data);
		$this->load->view('geral/footer');
	}

	function setOwned()
	{
		$response = file_get_contents($this->api_url_books. '/getBooks/'. 'id_user/1');
		$data = array(
			'books' => json_decode($response,TRUE)
		);
		$this->load->view('geral/header.php');
		$this->load->view('book/owned_book',$data);
		$this->load->view('geral/footer.php');
	}

	function validate_setOwned()
	{
        $this->form_validation->set_rules('inputIdUser','IdUser','required');
        $this->form_validation->set_rules('inputBook','Book','required');

        if($this->form_validation->run()===true)
        {
			$post_data = array(
                'id_user' => $this->input->post('inputIdUser'),
				'id_book' => $this->input->post('inputBook'),
			);
			$this->setOwned_form($post_data);
		}
		else
		{
			$this->setOwned();
		}
	}

	function setOwned_form($post_data)
    {
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books . '/setOwned/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($con, CURLOPT_POST, TRUE); // para indiciar que vamos mandar um post
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		
		if (!curl_errno($con))
		{
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE))
			{
				case 201: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n" . $response;
			}
	
			$data = array(
				'message' => $response
			);
			$this->load->view('book/owned_book_success',$data);		
		}
	}

	function setWhished()
	{
		$response = file_get_contents($this->api_url_books. '/getBooks/'. 'id_user/1');
		$data = array(
			'books' => json_decode($response,TRUE)
		);
		$this->load->view('geral/header.php');
		$this->load->view('book/whish_book',$data);
		$this->load->view('geral/footer.php');
	}

	function validate_setWhished()
	{
        $this->form_validation->set_rules('inputIdUser','IdUser','required');
        $this->form_validation->set_rules('inputBook','Book','required');

        if($this->form_validation->run()===true)
        {
			$post_data = array(
                'id_user' => $this->input->post('inputIdUser'),
				'id_book' => $this->input->post('inputBook'),
			);
			$this->setWished_form($post_data);
		}
		else
		{
			$this->setWhished();
		}
	}

	function setWhised_form($post_data)
    {
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books . '/setWhished/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($con, CURLOPT_POST, TRUE); // para indiciar que vamos mandar um post
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		
		if (!curl_errno($con))
		{
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE))
			{
				case 201: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n" . $response;
			}
	
			$data = array(
				'message' => $response
			);
			$this->load->view('book/whish_book_success',$data);		
		}
	}
	// ****  Rate Book ****
	function rateBook()
    {
		$response = file_get_contents($this->api_url_books. '/getBooks/');
		$data = array(
			'books' => json_decode($response,TRUE)
		);
		$this->load->view('geral/header.php');
		$this->load->view('book/rateBookForm',$data);
		$this->load->view('geral/footer.php');
	}
	
	function validate_rateBook()
	{
        $this->form_validation->set_rules('inputIdUser','IdUser','required');
        $this->form_validation->set_rules('inputBook','Book','required');
		$this->form_validation->set_rules('inputRate','Rating','required');
		$this->form_validation->set_rules('inputDate','Date','required');

        if($this->form_validation->run()===true)
        {
			$post_data = array(
                'reader_id' => $this->input->post('inputIdUser'),
				'book_id' => $this->input->post('inputBook'),
				'rating_value' => $this->input->post('inputRate'),
				'rating_date'=>$this->input->post('inputDate')
			);
		
			$this->rateBook_form($post_data);
		}
		else
		{
			$this->rateBook();
		}
	}

	function rateBook_form($post_data)
    {
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books. '/rateBook/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($con, CURLOPT_POST, TRUE); // para indiciar que vamos mandar um post
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		curl_close($con);

		$result = json_decode($response,TRUE);
		echo "Book ".$result['book_id']." was rated ";
	}
	
	// ****  Add Book ****
	function addBook($post_data)
	{

		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books . '/addbook/');
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
		$this->load->view('book/add_book_success', $data);
		$this->load->view('geral/footer');
	}

	function addBookForm()
	{
		$this->load->view('geral/header.php');
		$this->load->view('book/add_book_form');
		$this->load->view('geral/footer.php');
	}

	function validateNewBook()
	{
		$this->form_validation->set_rules('bookName', 'Book Name', 'required');
		$this->form_validation->set_rules('bookAuthor', 'Book Author', 'required');
		$this->form_validation->set_rules('bookGenreId', 'Book Genre ID', 'required|numeric');
		$this->form_validation->set_rules('bookDescription', 'Book Description', 'required');
		$this->form_validation->set_rules('bookIsbn', 'ISBN (International Standard Book Number) of the book',
											'required|alpha_numeric');
		$this->form_validation->set_rules('readerId', 'Reader ID', 'required');

		if ($this->form_validation->run() === TRUE) {

			$post_data = array(
				'name' => $this->input->post('bookName'),
				'author' => $this->input->post('bookAuthor'),
				'isbn' => $this->input->post('bookIsbn'),
				'genre_id' => $this->input->post('bookGenreId'),
				'description' => $this->input->post('bookDescription'),
				'reader_id' => $this->input->post('readerId'),
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
			elseif(empty($_FILES['bookCover']))
			{
				echo "test";
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

	// TODO: ALL EDIT METHODS NEED WORK
	function editBook($post_data)
	{

		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url_books . '/editbook/');
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
		$this->load->view('book/add_book_success', $data);
		$this->load->view('geral/footer');
	}

	function editBookForm()
	{
		$this->load->view('geral/header.php');
		$this->load->view('book/edit_book_form');
		$this->load->view('geral/footer.php');
	}

	function validateBookEdition()
	{
		$this->form_validation->set_rules('bookName', 'Book Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('bookAuthor', 'Book Author', 'required');
		$this->form_validation->set_rules('bookGenreId', 'Book Genre ID', 'required|numeric');
		$this->form_validation->set_rules('bookDescription', 'Book Description', 'required');
		$this->form_validation->set_rules('bookRegister', 'Who is registering this book?', 'required');

		if ($this->form_validation->run() === TRUE) {
			$post_data = array(
				'name' => $this->input->post('bookName'),
				'author' => $this->input->post('bookAuthor'),
				'genre_id' => $this->input->post('bookGenreId'),
				'description' => $this->input->post('bookDescription'),
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

			$this->editBook($post_data);
		}
		else
		{
			$this->editBookForm();
		}

	}

}
