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
        //$this->load->model('api/user_validate_model');

    }
    // To access:
    // http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user/getuser
    
    function getUser_get()
    {
        $id = $this->get('id');

        $id_user = $this->get('id_user');

        if ($id == NULL)
        {

             $id_profile = $this->user_model->validate_user($id_user);

             if($id_profile == 1)
             {
                 $users = $this->user_model->getUsers();
             }
             else
             {
                $message = [
                    'id' => -1,
                    'message' => 'The user must be an Admin to add an user'
                ];
                    $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
                    return;
             }
        } 
        else
        {
            
            $id_profile = $this->user_model->validate_user($id_user);
            
            if($id_profile == 1 || $id == $id_user)
            {
                $users = $this->user_model->getUser($id);
            }
            {
                $message = [
                    'id' => -2,
                    'message' =>
                    'The user must be an Admin to add an user, or the User who requested
                    must be the same user'
                ];
                    $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
                    return;
            }
        }

    }

    // To access:
    // http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user/adduser

    function addUser_post()
    {   
        $id_user = $this->post('id_user');

        $user = array(

            
            'id_profile' => $this->post('id_profile'),
            'name' => $this->post('name'), 
            'email' => $this->post('email'),
            'password' => $this->post('password'),
            'birthdate' => $this->post('birthdate'),
            'status' => $this->post('status'),
                    
        );

        if ($user['id_profile'] == '' || $user['name'] == '' ||
            $user['email'] == '' || $user['password'] == '' || $user['birthdate'] == '' ||
            $user['status'] =='' || $id_user == '')
        {
            $message = [
                'id' => -2,
                'message' => 'The required fields were not introduced'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return;
        }

        $id_profile = $this->user_model->validate_user($id_user);

        if($id_profile == 1)
        {
            $ret = $this->user_model->addUser($user);

            if($ret == 0)
            {
                 $message = [
                'id' => 0,
                'message' => 'User Registered'
            ];
                $this->set_response($message, REST_CONTROLLER::HTTP_CREATED); // Create 201 (being the HTTP code)
            }
            else
            {
                 $message = [
                'id' => -3,
                'message' => 'Error Registering User'
            ];
                $this->set_response($message, REST_CONTROLLER::HTTP_CREATED); // Create 201 (being the HTTP code)
            }
        }

        else
        {
            $message = [
                'id' => -1,
                'message' => 'The user must be an Admin to add an user'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return; 
        }


    }

}