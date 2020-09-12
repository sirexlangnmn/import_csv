<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_import extends CI_Model{

    function __construct() {

    }

    function getCompanyName($company_name)
    {
        return $this->db
            ->select('company_code, company_name')
            ->where('company_name', $company_name)
            ->get('company');
    }

    function getJob($company_code, $job_name)
    {
        return $this->db
            ->select('title')
            ->where(array('company_code' => $company_code, 'title' => $job_name))
            ->get('job_post');
    }
}