<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosis_model extends CI_Model
{    
    function diagnosisListing()
    {
        $this->db->select('p.patient_code, p.patient_name, p.patient_gender, p.patient_born_date, p.patient_address');
        $this->db->from('tbl_patients as p');
        $this->db->order_by('p.patient_code'); 
        $query = $this->db->get();
        
        return $query->result();  
    }

    function getPatientRecordInfo($patientCode)
    {
        $this->db->select('dg.diagnosis_code, p.patient_name, d.disease_name, dg.cf_total, u.user_name, dg.created_dtm');
        $this->db->from('tbl_diagnosis as dg');
        $this->db->join('tbl_patients as p', 'p.patient_code = dg.patient_code');
        $this->db->join('tbl_diseases as d', 'd.disease_code = dg.disease_code');
        $this->db->join('tbl_users as u', 'u.user_code = dg.created_by');
        $this->db->where('p.patient_code', $patientCode);
        $this->db->order_by('dg.diagnosis_code', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }

    function checkPatientInfo($patientCode)
    {
        $this->db->select('p.patient_code');
        $this->db->from('tbl_patients as p');
        $this->db->where('p.patient_code', $patientCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function getPatientInfo($patientCode)
    {
        $this->db->select('p.patient_code, p.patient_name, p.patient_gender, p.patient_born_date, p.patient_address');
        $this->db->from('tbl_patients as p');
        $this->db->where('p.patient_code', $patientCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getdiagnosisCodes(){
        $code  = 'DG';
        $query = 'SELECT max(diagnosis_code) AS auto_code FROM tbl_diagnosis';
        $data  = $this->db->query($query)->row_array();

        $max_dgcode  = $data['auto_code'];
        $max_dgcode2 = (int)substr($max_dgcode, 2,6);
        $count_dgcode= $max_dgcode2+1;
        $auto_code  = $code.sprintf('%06s',$count_dgcode);

        return $auto_code;
    }

    function getPatientCodes(){
        $code  = 'PC';
        $query = 'SELECT max(patient_code) AS auto_code FROM tbl_patients';
        $data  = $this->db->query($query)->row_array();

        $max_pcode  = $data['auto_code'];
        $max_pcode2 = (int)substr($max_pcode, 2,5);
        $count_pcode= $max_pcode2+1;
        $auto_code  = $code.sprintf('%05s',$count_pcode);

        return $auto_code;
    }

    function getPatientRoles()
    {
        $this->db->select('p.patient_code, p.patient_name');
        $this->db->from('tbl_patients AS p');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSymptomRoles($symptomCode = '')
    {
        $this->db->select('s.symptom_code, s.symptom_name, s.symptom_question');
        $this->db->from('tbl_symptoms AS s');
        $this->db->where('s.symptom_code !=', 'SC00000');
        if(!empty($symptomCode)) {
            $this->db->where('s.symptom_code', $symptomCode);
        }else{
            $this->db->where('s.start', 'Y');
            $this->db->where('s.end', 'T');
        }
        $query = $this->db->get();
        
        return $query->result();
    }

    function checkSymptomRolesYes($code)
    {
        $this->db->select('s.symptom_code, s.symptom_name, s.symptom_question, s.if_yes, s.start, s.end');
        $this->db->from('tbl_symptoms AS s');
        $this->db->where('s.symptom_code !=', 'SC00000');
        $this->db->where('s.symptom_code', $code);
        return $this->db->get()->row();
    }

    function checkSymptomRolesNo($code)
    {
        $this->db->select('s.symptom_code, s.symptom_name, s.symptom_question, s.if_no, s.start, s.end');
        $this->db->from('tbl_symptoms AS s');
        $this->db->where('s.symptom_code !=', 'SC00000');
        $this->db->where('s.symptom_code', $code);
        return $this->db->get()->row();

    }

    function checkTmpSymptomInfo($userCode)
    {
        $this->db->select('ts.*');
        $this->db->from('tbl_tmp_symptoms AS ts');
        $this->db->where('ts.user_code', $userCode);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function saveNewTmpDiagnosis($tmpDiagnosisInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_tmp_diagnosis', $tmpDiagnosisInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function editTmpDiagnosis($tmpDiagnosisInfo, $userCode)
    {
        $this->db->where('user_code', $userCode);
        $this->db->update('tbl_tmp_diagnosis', $tmpDiagnosisInfo);
        
        return TRUE;
    }

    function saveNewTmpSymptom($tmpSymptomInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_tmp_symptoms', $tmpSymptomInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getTmpDiseaseInfo($userCode)
    {
        $this->db->select('td.*');
        $this->db->from('tbl_tmp_diseases AS td');
        $this->db->where('td.user_code', $userCode);

        return $this->db->get()->row('disease_code');
    }

    function getTmpSymptomInfo($userCode)
    {
        $this->db->select('ts.*');
        $this->db->from('tbl_tmp_symptoms AS ts');
        $this->db->where('ts.user_code', $userCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getTmpDiagnosisInfo($userCode)
    {
        $this->db->select('tdg.*');
        $this->db->from('tbl_tmp_diagnosis AS tdg');
        $this->db->where('tdg.user_code', $userCode);

        return $this->db->get()->row('patient_code');
    }

    function saveNewPatient($patientInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_patients', $patientInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function saveNewDiagnosis($diagnosisInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_diagnosis', $diagnosisInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

     function checkTmpDiagnosisInfo($userCode)
    {
        $this->db->select('tdg.*');
        $this->db->from('tbl_tmp_diagnosis as tdg');
        $this->db->where('tdg.user_code', $userCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    function checkDiagnosisInfo($diagnosisCode)
    {
        $this->db->select('dg.*');
        $this->db->from('tbl_diagnosis as dg');
        $this->db->where('dg.diagnosis_code', $diagnosisCode);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function checkLastDiagnosisInfo($userCode)
    {
        $this->db->select('dg.*');
        $this->db->from('tbl_diagnosis as dg');
        $this->db->where('dg.created_by', $userCode);
        $this->db->order_by('dg.diagnosis_code', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row();
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

    function checkRuleInfo($tscodes)
    {
        $this->db->distinct();
        $this->db->select('r.disease_code, count(r.symptom_code) AS count_symptom');
        $this->db->from('tbl_rules as r');
        $this->db->where_in('r.symptom_code', $tscodes);
        $this->db->group_by('r.disease_code');
        $this->db->order_by('count_symptom', 'DESC');
        return $this->db->get()->row();
    }

    function checkSymptomInfo($dcode)
    {
        $this->db->select('r.disease_code, r.symptom_code, r.cf_value');
        $this->db->from('tbl_rules as r');
        $this->db->where('r.disease_code', $dcode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getDiagnosisInfo($diagnosisCode)
    {
        $this->db->select('dg.diagnosis_code, dg.cf_total, dg.created_by, u.user_name, u.user_phone, dg.created_dtm, p.patient_code, p.patient_name, p.patient_gender, p.patient_born_date, p.patient_address, d.disease_code, d.disease_name, d.disease_explain, d.healing, d.preventing');
        $this->db->from('tbl_diagnosis as dg');
        $this->db->join('tbl_patients as p', 'p.patient_code = dg.patient_code');
        $this->db->join('tbl_diseases as d', 'd.disease_code = dg.disease_code');
        $this->db->join('tbl_users as u', 'u.user_code = dg.created_by');
        $this->db->where('dg.diagnosis_code', $diagnosisCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getDiseaseInfo($diagnosisCode)
    {
        $this->db->select('dg.diagnosis_code, dg.disease_code, d.disease_name, r.symptom_code, s.symptom_name');
        $this->db->from('tbl_diagnosis as dg');
        $this->db->join('tbl_diseases as d', 'd.disease_code = dg.disease_code');
        $this->db->join('tbl_rules as r', 'r.disease_code = d.disease_code');
        $this->db->join('tbl_symptoms as s', 's.symptom_code = r.symptom_code');
        $this->db->where('dg.diagnosis_code', $diagnosisCode);
        $query = $this->db->get();
        
        return $query->result();
    }

    function editPatient($patientInfo, $patientCode)
    {
        $this->db->where('patient_code', $patientCode);
        $this->db->update('tbl_patients', $patientInfo);
        
        return TRUE;
    }

    function deleteTmpDiagnosis($userCode)
    {
        $this->db->where('user_code', $userCode);
        $this->db->delete('tbl_tmp_diagnosis');
        
        return $this->db->affected_rows();
    }

    function deleteTmpSymptoms($userCode)
    {
        $this->db->where('user_code', $userCode);
        $this->db->delete('tbl_tmp_symptoms');
        
        return $this->db->affected_rows();
    }

    function deleteDiagnosis($diagnosisCode)
    {
        $this->db->where('diagnosis_code', $diagnosisCode);
        $this->db->delete('tbl_diagnosis');
        
        return $this->db->affected_rows();
    }
}