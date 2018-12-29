<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property string api_url_book
 */

class Book extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    var $api_url_book;

    /**
     * Book constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->api_url_book='http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/api/book/';
        // Helpers
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    public function index()
    {
        $this->load->view('books/welcome');
    }

    // Get movie method
    function getBook($id=0)
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_book. '/getbook/'. ($id!=0 ? 'id/'.$id : ''));
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
        $this->load->view('books/getbook', $data);
        $this->load->view('geral/footer');

    }
