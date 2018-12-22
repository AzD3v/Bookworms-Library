<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property string api_url_users
 * @property string api_url_task
 */
class Clientrest extends CI_Controller {

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


    var $api_url_task;
    var $api_url_users;

    /**
     * Clientrest constructor.
     */
    function __construct()
    {
        parent::__construct();


        $this->api_url_task='http://controlaltdelete.pt/uac/ws/index.php/api/taskmanager/tasks';
        $this->api_url_users='http://controlaltdelete.pt/uac/ws/index.php/api/taskmanager/users';
		
		// Helpers 
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class"alert alert-danger">', '</div>');
	
	}

    public function index()
    {

        $data = array('name' => 'Paulo Cunha',
            'id'=> 20170017,
            'idade' => 21,
            'cabelo' =>'preto');

        $this->load->view('clientrest/hello', $data);
    }

    function getAllUsers()
    {
        $response = file_get_contents($this->api_url_users);
        $data = array(
            'users' => json_decode($response, true)
        );
        $this->load->view('geral/header.php');
        $this->load->view('clientrest/users', $data);
        $this->load->view('geral/footer.php');
    }

    function getAllUsersCurl()
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_users);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($con);
        curl_close($con);

        $data = array(
            'users' => json_decode($response, true)
        );
		$this->load->view('clientrest/users', $data);

	}

	
    function getUser($id=0)
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_users.'/id/'. $id);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($con);
        if (!curl_errno($con)){
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
                case 200: break;
                default: echo "Unexpected HTTP code: ", $http_code, "\n";
                    exit;
            }
        }

        curl_close($con);

        $data = array(
            'users' => json_decode($response, true)
        );
        $this->load->view('clientrest/users', $data);
    }

    function createUser()
    {
        $post_data = array('name'=>'José Morais',
            'email' => 'jose@gmail.com',
            'fact' => 'É um teste');
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_users);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_POST, TRUE);
        curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $response=curl_exec($con);
        if (!curl_errno($con)){
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
                case 201: break;
                default: echo "Unexpected HTTP code: ", $http_code, "\n";
                    exit;
            }
        }

        curl_close($con);

        $data = array(
            'users' => json_decode($response, true)
        );
        $this->load->view('clientrest/users', $data);
	}



	function createUserForm()
    {
		$this->load->view('geral/header.php');
		$this->load->view('clientrest/create_user_form');
		$this->load->view('geral/footer.php');		
	}
	
	function validate_user_form() 
	{
		$this->form_validation->set_rules('inputNome', 'Nome', 'required');
		$this->form_validation->set_rules('inputEmail', 'inputEmail', 'required');
		$this->form_validation->set_rules('inputFact', 'inputFact', 'required');


		if ($this->form_validation->run() === TRUE) 
		{
			// Aqui vai o código que cria a tarefa e mostra o resultado como na outra função
			$post_data = array(
				'name' => $this->input->post('inputNome'),
				'comments' => $this->input->post('inputEmail'),
				'due_date' => $this->input->post('inputFact'),
			);

			$this->createUserParam($post_data);
		} 
		else
		{
			$this->createUserForm();
		}

	}

    function deleteUser($id=0)
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_users.'/id/'.$id);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($con, CURLOPT_HTTPHEADER, array ('Content-type: application/x-www-form-urlencoded'));
        $response = curl_exec($con);

        if(!curl_errno($con)) {
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE))
            {
                case 200 : break;
                default : echo 'Unexpected HTTP code: ', $http_code, "\n";
                    exit;
            }
        }
        curl_close($con);
        $result = json_decode($response, true);
        echo "Foi eliminado o utilizador:  ".$result['id']." com mensagem - ".$result['message'];
    }

    function getAllTasks()
    {
        $response = file_get_contents($this->api_url_task);
        $data = array(
            'tasks' => json_decode($response, true)
        );
        $this->load->view('clientrest/tasks', $data);
    }

    function getAllTasksCurl()
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_task);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($con);
        curl_close($con);

        $data = array(
            'tasks' => json_decode($response, true)
        );
        $this->load->view('geral/header.php');
        $this->load->view('clientrest/tasks', $data);
        $this->load->view('geral/footer.php');
    }

    function getTask($id=0)
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_task.'/id/'. $id);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($con);
        if (!curl_errno($con)){
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
                case 200: break;
                default: echo "Unexpected HTTP code: ", $http_code, "\n";
                    exit;
            }
        }

        curl_close($con);

        $data = array(
            'tasks' => json_decode($response, true)
        );
        $this->load->view('geral/header.php');
        $this->load->view('clientrest/tasks', $data);
        $this->load->view('geral/footer.php');
    }

    function newTask()
    {
        $this->load->view('geral/header');
        $this->load->view('clientrest/new_task_form2');
        $this->load->view('geral/footer');
	}
	
	function validateNewTask() 
	{
		$post_data = array(
			'name' => $this->input->post('inputName'),
			'comments' => $this->input->post('inputComments'),
			'due_date' => $this->input->post('inputData'),
			'create_user_id' => $this->input->post('inputUser')
		);

		// Agora é só criar a tarefa 
		$this->addTaskForm($post_data);
	}

	function validateNewTaskVal() 
	{
		$this->form_validation->set_rules('inputNome', 'Nome', 'required');
		$this->form_validation->set_rules('inputData', 'Data', 'required');
		$this->form_validation->set_rules('inputUser', 'Utilizador', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('inputComments', 'Comentários', 'required');

		if ($this->form_validation->run() === TRUE) 
		{
			// Aqui vai o código que cria a tarefa e mostra o resultado como na outra função
			$post_data = array(
				'name' => $this->input->post('inputNome'),
				'comments' => $this->input->post('inputData'),
				'due_date' => $this->input->post('inputUser'),
				'create_user_id' => $this->input->post('inputComments')
			);

			$this->addTaskForm($post_data);
		} 
		else
		{
			$this->newTask();
		}

	}

    function createTask()
    {
        $post_data = array('name'=>'Task José',
            'comments' => 'Task José Criada',
            'create_user_id' => 1,
            'create_user' => 'José');

        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_task);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_POST, TRUE);
        curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $response=curl_exec($con);
        if (!curl_errno($con)){
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
                case 201: break;
                default: echo "Unexpected HTTP code: ", $http_code, "\n";
                    exit;
            }
        }

        curl_close($con);

        $data = array(
            'tasks' => json_decode($response, true)
        );
        $this->load->view('geral/header.php');
        $this->load->view('clientrest/tasks', $data);
        $this->load->view('geral/footer.php');
	}
	
	function addTaskForm($post_data)
    {
        $this->load->view('geral/header.php');
        $this->load->view('clientrest/new_task_form', $data);
        $this->load->view('geral/footer.php');
    }

    function editTask($id)
    {
        $post_data = array(
            'start_date'=>'2018-11-27 15:00:00',
            'create_user_id' => 2,
            'id' => $id
        );

        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_task);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_POST, TRUE);
        curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $response = curl_exec($con);
        if (!curl_errno($con)){
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
                case 201: break;
                default: echo "Unexpected HTTP code: ", $http_code, "\n";
                    exit;
            }
        }

        curl_close($con);

        $data = array(
            'tasks' => json_decode($response, true)
        );
        $this->load->view('geral/header.php');
        $this->load->view('clientrest/tasks', $data);
        $this->load->view('geral/footer.php');
    }

    function deleteTask($id=0)
    {
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $this->api_url_task.'/id/'.$id);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($con, CURLOPT_HTTPHEADER, array ('Content-type: application/x-www-form-urlencoded'));
        $response = curl_exec($con);

        if(!curl_errno($con)) {
            switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE))
            {
                case 200 : break;
                default : echo 'Unexpected HTTP code: ', $http_code, "\n";
                    exit;
            }
        }
        curl_close($con);
        $result = json_decode($response, true);
        echo "Foi eliminado a tarefa:  ".$result['id']." com mensagem - ".$result['message'];
    }
}


//http://controlaltdelete.pt/uac/ws/index.php/api/taskmanager/tasks
