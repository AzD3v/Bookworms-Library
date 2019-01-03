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
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('api/user_model');
        $this->load->model('api/user_validate_model');

    }
    // To access:
    // http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user/getuser
    
    function getUser_get()
    {
        $id = $this->get('id');

        $id_user = $this->get('id_user');

        if($id_user == NULL)
        {
            $message = [
                'id' => -5,
                'message' => 'it was not given user_id'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $user = $this->user_validate_movel->validate_user($id_user);           
        }

        

        if ($id == NULL) {
            $users = $this->user_model->getUsers();
        } else {
            $users = $this->user_model->getUser($id);
        }
        // Set the response and exit
        $this->response($users, REST_Controller::HTTP_OK); // OK (200)
    }

    // To access:
    // http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user/adduser

    function addUser_post()
    {
        $user = array(

            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'password' => $this->post('password'),
            'profile_id' => $this->post('profile_id'),
            'birthdate' => $this->post('birthdate'),
            'status' => $this->post('status'),
                    
        );
        
        if ($user['name'] == '' || $user['email'] == '' ||
            $user['password'] == '' || $user['profile_id'] == '' || $user['birthdate'] ==''
            || $user['status'] == '')
        {
            $message = [
                'id' => -1,
                'message' => 'It was not given the required fields'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return;
        }

        $ret = $this->user_model->addUser($user);

        if ($ret < 0)
        {
            $message = [
                'id' => -2,
                'message' => 'it was not possible to register the user',
            ];

            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
        }
        else
        {
            $message = [
                'id' => 0,
                'message' => 'User Registered'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_CREATED); // Create 201 (being the HTTP code)
        }

    }

}