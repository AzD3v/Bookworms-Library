<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 18-12-2018
 * Time: 15:37
 */

if (!defined('BASEPATH')) die();

/*
 * Common_model
 *
 */

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function validate_user($id_user)
    {
        $this->db->select("u.profile");
        $this->db->from('User as u');
        $this->db->where('u.id = '.$id_user.'');

        $query = $this->db->get();

        
        $user = $query->get->result();

        var_dump($user);
      
    }


}