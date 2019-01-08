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
class Movie extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('api/movie_model');

    }

    function getMovie_get()
    {
        $id = $this->get('id');

        if ($id === NULL) {
            $movies = $this->movie_model->getMovies();
        } else {
            $movies = $this->movie_model->getMovies($id);
        }
        // Set the response and exit
        $this->response($movies, REST_Controller::HTTP_OK); // OK (200)
    }

    // To access:
    // http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/api/movie/getmovie

    function addMovie_post()
    {
        $movie = array(
            'title' => $this->post('title'),
            'year' => $this->post('year'),
            'description' => $this->post('description'),
            'imdb_id' => $this->post('imdb_id'),
            'user_id' => $this->post('user_id'),
            'userfile' => $this->post('userfile')
        );
        $genders = $this->post('gender_id');

        if ($movie['title'] == '' || $movie['year'] == '' ||
            $movie['user_id'] == '' || $genders == '')
        {
            $message = [
                'id' => -1,
                'message' => 'Não foram fornecidos os campos obrigatórios'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return;
        }

        $ret = $this->movie_model->addMovie($movie, $genders);
        if ($ret < 0)
        {
            $message = [
                'id' => -2,
                'message' => 'Não foi possível registar o filme na base de dados'
            ];

            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
        }
        else
        {
            $message = [
                'id' => 0,
                'message' => 'Filme criado'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_CREATED); // Create 201 (being the HTTP code)
        }

    }

    // To access:
    // http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/api/movie/addmovie

    function delMovie_delete()
    {
        $id = $this->get('id');

        // Validate the id
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $movie = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];
        // $movies = $this->movie_model->getMovies($id)
        $this->response($movie, REST_Controller::HTTP_OK); // OK (200)X
    }

    // To access:
    // http://localhost/Universidade/Web-Services/Academic-Project-1/index.php/api/movie/delmovie

}