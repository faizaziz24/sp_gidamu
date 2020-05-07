<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{    

    function userRecords(){
        $this->db->select('u.*');
        $this->db->from('tbl_users AS u');  
        $this->db->where('u.user_deleted', 0);
        $this->db->where('u.role_code !=', 'RC001');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function patientRecords(){
        $this->db->select('p.*');
        $this->db->from('tbl_patients AS p');  
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function symptomRecords(){
        $this->db->select('s.*');
        $this->db->from('tbl_symptoms AS s');
        $this->db->where('s.symptom_code !=', 'SC00000');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function diseaseRecords(){
        $this->db->select('d.*');
        $this->db->from('tbl_diseases AS d');
        $this->db->where('d.disease_code !=', 'DC0000');  
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function ruleRecords(){
        $this->db->select('r.*');
        $this->db->from('tbl_rules AS r');  
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function diagnosisRecords(){
        $this->db->select('dg.*');
        $this->db->from('tbl_diagnosis AS dg');  
        $query = $this->db->get();
        
        return $query->num_rows();
    }
}