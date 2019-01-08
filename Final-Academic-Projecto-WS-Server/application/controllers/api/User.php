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

        if($id_user == NULL)
        {
             $message = 
             [
                'id' => -5,
                'message' => 'You must sent the id_user'
             ];
                $this->set_response($message, REST_CONTROLLER::HTTP_ERROR);
                return;
        }
        else
        {

            if ($id == NULL)
            {

                $id_profile = $this->user_model->validate_user($id_user);

                if($id_profile == 1)
                {
                    $users = $this->user_model->getUsers();
                    $this->set_response($users, REST_CONTROLLER::HTTP_OK);
                    return;
                }
                else
                {
                    $message = [
                        'id' => -1,
                        'message' => 'The user must be an Admin to add an user'
                    ];
                        $this->set_response($message, REST_CONTROLLER::HTTP_ERROR);
                        return;
                }
            } 
            else
            {
                
                $id_profile = $this->user_model->validate_user($id_user);
                
                if($id_profile == 1 || $id == $id_user)
                {
                    $users = $this->user_model->getUser($id);
                    $this->set_response($users, REST_CONTROLLER::HTTP_OK);
                    return;
                }
                else
                {
                    $message = [
                        'id' => -2,
                        'message' =>
                        'The user must be an Admin to GET an user, or the User who requested
                        must be the same user'
                    ];
                        $this->set_response($message, REST_CONTROLLER::HTTP_ERROR);
                        return;
                }
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
    // To access:
    // http://localhost/Bookworms-Library/Final-Academic-Projecto-WS-Server/index.php/api/user/changeuserstatus
    
    function changeUserStatus_post()
    {
         $id_user = $this->post('id_user');

         $status = $this->post('status');

         if ($id_user == '' || $status == '')
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
            $ret = $this->user_model->change_user_status($id_user,$status);

            if($ret == 0)
            {
                $message = 
                [
                    'id' => 0,
                    'message' => 'Changed Status with success'
                ];
                
                $this->set_response($message, REST_CONTROLLER::HTTP_OK);
            }
            else
            {
                $message = 
                [
                    'id' => -1,
                    'message' => 'Error changing Status'
                ];
                
                $this->set_response($message, REST_CONTROLLER::HTTP_CREATED);
            }
         }
         else
         {
              $message = 
              [
                'id' => -3,
                'message' => 'Must be an admin to change status'
              ];
                $this->set_response($message, REST_CONTROLLER::HTTP_CREATED);
                return;
         }
    }

    function editUser_post()
    {
        $id_user = $this->post('id_user');
        $id_profiler = $this->post('id_profile');
        $name = $this->post('name');
        $email = $this->post('email');
        $pasword = $this->post('password');

        if ($id_user == '')
        {
            $message = [
                'id' => -1,
                'message' => 'The required fields were not introduced'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_ERROR);
            return;
        }

        $id_profile = $this->user_model->validate_user($id_user);

        if($id_profile == 1)
        {
            $ret = $this->user_model->editUser($id_user, $id_profiler, $name, $email, $password);
            
            if($ret == 0)
            {
            
                $message = 
                [
                    'id' => 0,
                    'message' => 'Edited User with success'
                ];
                
                $this->set_response($message, REST_CONTROLLER::HTTP_OK);
                return;
            }
            else
            {
                 $message = 
                [
                    'id' => -3,
                    'message' => 'Error editting User'
                ];
                
                $this->set_response($message, REST_CONTROLLER::HTTP_ERROR);
            }
        }
        else
        {
           $message = [
                'id' => -2,
                'message' => 'You must be an admin to Edit this user'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_ERROR);
            return; 
        }
        
    }

    function addFriend_post()
    {
        $id_user = $this->post('id_user');

        $id_friend = $this->post('id_friend');

        if ($id_user == '' || $id_user == $id_friend )
        {
            $message = [
                'id' => -2,
                'message' => 'The required fields were not introduced or they were impossible to execute'
            ];
            $this->set_response($message, REST_CONTROLLER::HTTP_NOT_FOUND);
            return;
  
        }

        else
        {
            $ret = $this->user_model->addFriend($id_friend, $id_user);

            if($ret == 0)
            {   
                 $message = [
                'id' => 0,
                'message' => 'User added with sucess to your friends list'
                ];

                $this->set_response($message, REST_CONTROLLER::HTTP_CREATED);
                return;
            }
        }

         

    

        
    }

}
