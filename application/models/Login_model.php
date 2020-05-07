<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

    function loginMe($email, $password)
    {
        $this->db->select('u.user_code, u.user_email, u.user_password, u.user_name, u.user_phone, u.role_code, r.role_name');
        $this->db->from('tbl_users AS u');
        $this->db->join('tbl_roles AS r','r.role_code = u.role_code');
        $this->db->where('u.user_email', $email);
        $this->db->where('u.user_activated', 1);
        $this->db->where('u.user_deleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->user_password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

    function lastLoginInfo($user_code)
    {
        $this->db->select('tll.created_dtm');
        $this->db->where('tll.user_code', $user_code);
        $this->db->order_by('tll.user_code', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as tll');

        return $query->row();
    }
}

?>