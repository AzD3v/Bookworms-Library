<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Book extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('api/user_model');

    }
    // To access:
    // http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/api/movie/getmovie

    function addBook_post()
    {
        $book = array(
            'name' => $this->post('name'),
            'author' => $this->post('author'),
            'isbn' => $this->post('isbn'),
            'cover' => $this->post('cover'),
            'imdb_id' => $this->post('imdb_id'),
            'reader_id' => $this->post('reader_id'),
            'admin_id' => $this->post('admin_id')
            
        );
        $genders = $this->post('gender_id');

        if ($book['name'] == '' || $book['author'] == '' ||
            $book['isbn'] == '' || $book == 'reader_id' || $book =='admin_id')
        {
            $message = [
                'id' => -1,
                'message' => 'It was not given the required fields'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return;
        }

        $ret = $this->book_model->addBook($book, $genders);
        if ($ret < 0)
        {
            $message = [
                'id' => -2,
                'message' => 'it was not possible to register your book',
            ];

            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
        }
        else
        {
            $message = [
                'id' => 0,
                'message' => 'Book Registered'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_CREATED); // Create 201 (being the HTTP code)
        }

    }

   
}