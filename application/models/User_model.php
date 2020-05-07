<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{    
    function userListing()
    {
        $this->db->select('u.user_code, u.user_email, u.user_name, u.user_phone, r.role_name, u.user_activated');
        $this->db->from('tbl_users as u');
        $this->db->join('tbl_roles as r', 'r.role_code = u.role_code','left');
        $this->db->where('u.user_deleted', 0);
        $this->db->where('u.role_code !=', 'RC001');
        $this->db->order_by('u.user_code'); 
        $this->db->order_by('u.user_activated', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getUserRoles()
    {
        $this->db->select('r.role_code, r.role_name');
        $this->db->from('tbl_roles AS r');
        $this->db->where('r.role_code !=', 'RC001');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserCodes(){
        $code  = 'UC';
        $query = 'SELECT max(user_code) AS auto_code FROM tbl_users';
        $data  = $this->db->query($query)->row_array();

        $max_ucode  = $data['auto_code'];
        $max_ucode2 = (int)substr($max_ucode, 2,5);
        $count_ucode= $max_ucode2+1;
        $auto_code  = $code.sprintf('%05s',$count_ucode);

        return $auto_code;
    }    
    
    function saveNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function checkUserInfo($userCode)
    {
        $this->db->select('u.user_code');
        $this->db->from('tbl_users AS u');
        $this->db->where('u.user_deleted', 0);
        $this->db->where('u.role_code !=', 'RC001');
        $this->db->where('u.user_code', $userCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function getUserInfo($userCode)
    {
        $this->db->select('u.user_code, u.user_name, u.user_email, u.user_phone, u.role_code, u.user_activated');
        $this->db->from('tbl_users AS u');
        $this->db->where('u.user_deleted', 0);
        $this->db->where('u.role_code !=', 'RC001');
        $this->db->where('u.user_code', $userCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function loginHistory($userCode)
    {
        $this->db->select('tll.user_code, tll.session_data, tll.machine_ip, tll.browser_type, tll.platform, tll.created_dtm');
        $this->db->from('tbl_last_login as tll');
        $this->db->where('tll.user_code', $userCode);
        $this->db->order_by('tll.created_dtm', 'DESC');
        $this->db->order_by('tll.user_code');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    function editUser($userInfo, $userCode)
    {
        $this->db->where('user_code', $userCode);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    function deleteUser($userCode, $userInfo)
    {
        $this->db->where('user_code', $userCode);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function matchOldPassword($userCode, $oldPassword)
    {
        $this->db->select('user_code, user_password');
        $this->db->where('user_code', $userCode);     
        $this->db->where('user_activated', 1);        
        $this->db->where('user_deleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->user_password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    function changePassword($userCode, $userInfo)
    {
        $this->db->where('user_code', $userCode);    
        $this->db->where('user_activated', 1); 
        $this->db->where('user_deleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

    function getUserInfoWithRole($userCode)
    {
        $this->db->select('u.user_code, u.user_email, u.user_name, u.user_phone, u.role_code, r.role_name');
        $this->db->from('tbl_users as u');
        $this->db->join('tbl_roles as r', 'r.role_code = u.role_code');
        $this->db->where('u.user_code', $userCode);
        $this->db->where('u.user_activated', 1);
        $this->db->where('u.user_deleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
}