<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Symptom_model extends CI_Model
{    

    function symptomListing()
    {
        $this->db->select('s.symptom_code, s.symptom_name, s.symptom_question, s.if_yes, s.if_no, s.start, s.end');
        $this->db->from('tbl_symptoms as s');
        $this->db->where('s.symptom_code !=', 'SC00000');
        $this->db->order_by('s.symptom_code'); 
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getSymptomCodes(){
        $code  = 'SC';
        $query = 'SELECT max(symptom_code) AS auto_code FROM tbl_symptoms';
        $data  = $this->db->query($query)->row_array();

        $max_scode  = $data['auto_code'];
        $max_scode2 = (int)substr($max_scode, 2,5);
        $count_scode= $max_scode2+1;
        $auto_code  = $code.sprintf('%05s',$count_scode);

        return $auto_code;
    }

    function getDiseaseRoles()
    {
        $this->db->select('d.disease_code, d.disease_name');
        $this->db->from('tbl_diseases AS d');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSymptomRoles()
    {
        $this->db->select('s.symptom_code, s.symptom_name');
        $this->db->from('tbl_symptoms AS s');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function saveNewSymptom($symptomInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_symptoms', $symptomInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function checkSymptomInfo($symptomCode)
    {
        $this->db->select('s.symptom_code');
        $this->db->from('tbl_symptoms as s');
        $this->db->where('s.symptom_code !=', 1);
        $this->db->where('s.symptom_code', $symptomCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function getSymptomInfo($symptomCode)
    {
        $this->db->select('s.symptom_code, s.symptom_name, s.symptom_question, s.if_yes, s.if_no, s.start, s.end');
        $this->db->from('tbl_symptoms as s');
        $this->db->where('s.symptom_code !=', 1);
        $this->db->where('s.symptom_code', $symptomCode);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function editSymptom($symptomInfo, $symptomCode)
    {
        $this->db->where('symptom_code', $symptomCode);
        $this->db->update('tbl_symptoms', $symptomInfo);
        
        return TRUE;
    }

    function checkSymptomInfobySymptomCode($symptomCode)
    {
        $this->db->select('*');
        $this->db->from('tbl_symptoms as s');
        $this->db->where('s.if_yes', $symptomCode);
        $this->db->or_where('s.if_no', $symptomCode);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function checkRuleInfobySymptomCode($symptomCode)
    {
        $this->db->select('*');
        $this->db->from('tbl_rules as r');
        $this->db->where('r.symptom_code', $symptomCode);
        $query = $this->db->get();

        return $query->num_rows();
    }

    function deleteSymptom($symptomCode)
    {
        $this->db->where('symptom_code', $symptomCode);
        $this->db->delete('tbl_symptoms');
        
        return $this->db->affected_rows();
    }
}