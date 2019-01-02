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
        $ret = $this->db->insert('user', $user);
        if (!$ret)
            return -1;

        $user_id = $this->db->insert_id();
        

        return $user_id;
    }

    function getUsers($id = 0)
    {
        $this->db->select("u.id, u.name, u.email, u.password, u.profile,
            u.birthdate, u.status, u.name");
        $this->db->from('User as u');
        
        if ($id != 0)
            $this->db->where('u.id', $id);

        $this->db->group_by('u.id, u.name, u.email, u.password, u.profile,
        u.birthdate, u.status, u.name');
        
        $query = $this->db->get();
        // echo $this->db->last_query(); exit();

        $users = array();
        foreach ($query->result() as $t)
            $users[] = (array) $t;

        return $users;
    }

}