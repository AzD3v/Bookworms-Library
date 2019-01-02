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

class Book_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function addBook($book, $genders)
    {
        $ret = $this->db->insert('book', $book);
        if (!$ret)
            return -1;

        $book_id = $this->db->insert_id();
        $genders_arr = explode(',', $genders);
        foreach ($genders_arr as $g) {
            if ($g != '') {
                $ret = $this->db->insert('book_has_gender',
                    array('book_id' => $book_id,
                    'gender_id' => $g));

                if (!$ret)
                    return -2;
            }
        }

        return $book_id;
    }

    function getMovies($id = 0)
    {
        $this->db->select("m.id, m.photo, m.title, m.year, m.description,
            m.imdb_id, m.user_id, u.name,
            group_concat(distinct g.name) as genders,
            ifnull(round(avg(r.rating), 1), '') as rating", FALSE);
        $this->db->from('movie as m');
        $this->db->join('users as u', 'u.id=m.user_id');
        $this->db->join('rating as r', 'r.movie_id=m.id', 'LEFT');
        $this->db->join('movie_has_gender as mh', 'm.id=mh.movie_id', 'LEFT');
        $this->db->join('gender as g', 'g.id=mh.gender_id', 'LEFT');

        if ($id != 0)
            $this->db->where('m.id', $id);

        $this->db->group_by('m.id, m.photo, m.title, m.year, m.description, m.imdb_id, m.user_id, u.name ');
        $query = $this->db->get();
        // echo $this->db->last_query(); exit();

        $movies = array();
        foreach ($query->result() as $t)
            $movies[] = (array) $t;

        return $movies;
    }

}