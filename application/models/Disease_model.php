<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Disease_model extends CI_Model
{    

    function diseaseListing()
    {
        $this->db->select('d.disease_code, d.disease_name, d.disease_explain, d.healing, d.preventing');
        $this->db->from('tbl_diseases as d');
        $this->db->where('d.disease_code !=', 'DC0000');
        $this->db->order_by('d.disease_code'); 
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getDiseaseCodes(){
        $code  = 'DC';
        $query = 'SELECT max(disease_code) AS auto_code FROM tbl_diseases';
        $data  = $this->db->query($query)->row_array();

        $max_dcode  = $data['auto_code'];
        $max_dcode2 = (int)substr($max_dcode, 2,4);
        $count_dcode= $max_dcode2+1;
        $auto_code  = $code.sprintf('%04s',$count_dcode);

        return $auto_code;
    }
    
    function saveNewDisease($diseaseInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_diseases', $diseaseInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function checkDiseaseInfo($diseaseCode)
    {
        $this->db->select('d.disease_code');
        $this->db->from('tbl_diseases as d');
        $this->db->where('d.disease_code !=', 'DC0000');
        $this->db->where('d.disease_code', $diseaseCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function getDiseaseInfo($diseaseCode)
    {
        $this->db->select('d.disease_code, d.disease_name, d.disease_explain, d.healing, d.preventing');
        $this->db->from('tbl_diseases as d');
        $this->db->where('d.disease_code !=', 'DC0000');
        $this->db->where('d.disease_code', $diseaseCode);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function editDisease($diseaseInfo, $diseaseCode)
    {
        $this->db->where('disease_code', $diseaseCode);
        $this->db->update('tbl_diseases', $diseaseInfo);
        
        return TRUE;
    }

    function checkSymptomInfobyDiseaseCode($diseaseCode)
    {
        $this->db->select('*');
        $this->db->from('tbl_symptoms as s');
        $this->db->where('s.if_yes', $diseaseCode);
        $this->db->or_where('s.if_no', $diseaseCode);
        $query = $this->db->get();

        return $query->num_rows();
    }
    
    function checkRuleInfobyDiseaseCode($diseaseCode)
    {
        $this->db->select('*');
        $this->db->from('tbl_rules as r');
        $this->db->where('r.disease_code', $diseaseCode);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function deleteDisease($diseaseCode)
    {
        $this->db->where('disease_code', $diseaseCode);
        $this->db->delete('tbl_diseases');
        
        return $this->db->affected_rows();
    }
}