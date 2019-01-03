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

    function addUser($user)
    {
        $ret = $this->db->insert('User', $user);
        if (!$ret)
            return -1;

        $user_id = $this->db->insert_id();
        

        return $user_id;
    }

    function getUsers()
    {
        $this->db->select("u.name, u.email");
        $this->db->from('User as u');
        
        $this->db->group_by('u.name');
        
        $query = $this->db->get();

        $users = array();
        foreach ($query->result() as $t)
            $users[] = (array) $t;

        return $users;
    }

    function getUser($id)
    {   
        $this->db->select("u.name, u.email");
        $this->db->from('User as u');

        $this->db->where('u.id', $id);
        
        $this->db->group_by('u.name');
        
        $query = $this->db->get();

        $users = array();
        foreach ($query->result() as $t)
            $users[] = (array) $t;

        return $users;
    }

    function validate_user($id_user)
    {
        $this->db->select("u.id_profile");
        $this->db->from('User as u');
        $this->db->where('u.id = '.$id_user.'');

        $query = $this->db->get();

        $user = array();
        foreach($query->result() as $t)
            $user[] = (array) $t;

        $id_user = $user[0];
       
        return $id_user;
      
    }

}