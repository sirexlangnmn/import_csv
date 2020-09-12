<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_global extends CI_Model
{
    function generateID($prefix)
    {
        $m = date('my');
        if ($prefix == 'EMP') {
            $last_id = $this->db->order_by('id', 'DESC')->limit(1)->get('employer_account');
        } elseif ($prefix == 'CMP') {
            $last_id = $this->db->order_by('id', 'DESC')->limit(1)->get('company');
        } elseif ($prefix == 'JOB') {
            $last_id = $this->db->order_by('id', 'DESC')->limit(1)->get('job_post');
        }

        if ($last_id->num_rows() == 0) {
            return $prefix . $m . '00001';
        } else {
            $last_id = $last_id->row()->id + 1;
            if (strlen($last_id) == 1) {
                return $last_id = $prefix . $m . '0000' . $last_id;
            } elseif (strlen($last_id) == 2) {
                return $last_id = $prefix . $m . '000' . $last_id;
            } elseif (strlen($last_id) == 3) {
                return $last_id = $prefix . $m . '00' . $last_id;
            } elseif (strlen($last_id) == 4) {
                return $last_id = $prefix . $m . '0' . $last_id;
            } else {
                return $last_id = $prefix . $m . $last_id;
            }
        }
    }


}