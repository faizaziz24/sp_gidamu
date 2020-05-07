<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rule_model extends CI_Model
{    

    function ruleListing()
    {
        $this->db->select('d.*, COUNT(s.symptom_code) AS item_symptom, r.cf_value');
        $this->db->from('tbl_diseases as d');
        $this->db->join('tbl_rules as r', 'r.disease_code = d.disease_code');
        $this->db->join('tbl_symptoms as s', 's.symptom_code = r.symptom_code');
        $this->db->group_by('r.disease_code');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getRuleCodes(){
        $code  = 'RL';
        $query = 'SELECT max(rule_code) AS auto_code FROM tbl_rules';
        $data  = $this->db->query($query)->row_array();

        $max_rcode  = $data['auto_code'];
        $max_rcode2 = (int)substr($max_rcode, 2,6);
        $count_rcode= $max_rcode2+1;
        $auto_code  = $code.sprintf('%06s',$count_rcode);

        return $auto_code;
    }

    function getDiseaseRoles()
    {
        $this->db->select('d.disease_code, d.disease_name');
        $this->db->from('tbl_diseases AS d');
        $this->db->where('d.disease_code !=', 'DC0000');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSymptomRoles()
    {
        $this->db->select('s.symptom_code, s.symptom_name');
        $this->db->from('tbl_symptoms AS s');
        $this->db->where('s.symptom_code !=', 'SC00000');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function saveNewRule($ruleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_rules', $ruleInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function checkDiseaseInfo($diseaseCode)
    {
        $this->db->select('d.*');
        $this->db->from('tbl_diseases as d');
        $this->db->where('d.disease_code', $diseaseCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function checkRuleInfo($ruleCode)
    {
        $this->db->select('r.*');
        $this->db->from('tbl_rules as r');
        $this->db->where('r.rule_code', $ruleCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function getDiseaseInfo($diseaseCode)
    {
        $this->db->select('d.disease_code, d.disease_name, r.*, s.symptom_code, s.symptom_name');
        $this->db->from('tbl_diseases as d');
        $this->db->join('tbl_rules as r', 'r.disease_code = d.disease_code');
        $this->db->join('tbl_symptoms as s', 's.symptom_code = r.symptom_code');
        $this->db->where('d.disease_code', 0);
        $this->db->where('d.disease_code', $diseaseCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getRuleInfo($ruleCode)
    {
        $this->db->select('d.disease_code, d.disease_name, r.*, s.symptom_code, s.symptom_name');
        $this->db->from('tbl_diseases as d');
        $this->db->join('tbl_rules as r', 'r.disease_code = d.disease_code');
        $this->db->join('tbl_symptoms as s', 's.symptom_code = r.symptom_code');
        $this->db->where('r.rule_code', $ruleCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function checkSymptomExists($drole, $srole)
    {
        $this->db->select("r.disease_code, r.symptom_code");
        $this->db->from("tbl_rules AS r");
        $this->db->where("r.disease_code", $drole);
        $this->db->where("r.symptom_code", $srole);    
        $query = $this->db->get();

        return $query->result();
    }
    
    function editRule($ruleInfo, $ruleCode)
    {
        $this->db->where('rule_code', $ruleCode);
        $this->db->update('tbl_rules', $ruleInfo);
        
        return TRUE;
    }
    
    function deleteRule($ruleCode)
    {
        $this->db->where('rule_code', $ruleCode);
        $this->db->delete('tbl_rules');
        
        return $this->db->affected_rows();
    }
}