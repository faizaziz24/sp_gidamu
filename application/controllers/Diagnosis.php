<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Diagnosis extends BaseController
{
    public $tmp_code;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('diagnosis_model');
        $this->isLoggedIn();   
    }
    
    public function index()
    {
        redirect('diagnosis-list');
    }
    
    function diagnosisListing()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['diagnosisRecords'] = $this->diagnosis_model->diagnosisListing();

            $this->global['pageTitle'] = 'Gidamu : Daftar Pasien';
            
            $this->loadViews("diagnosis/diagnosis-list", $this->global, $data, NULL);
        }
    }

    function medicalRecordListing($patientCode = NULL)
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->diagnosis_model->checkPatientInfo($patientCode);

            if($patientCode == null || $is_check == 0)
            {
                redirect('diagnosis-list');
            }
            
            $data['patientInfo'] = $this->diagnosis_model->getPatientRecordInfo($patientCode);

            $this->global['pageTitle'] = 'Gidamu : Daftar Rekam Medis';
            
            $this->loadViews("diagnosis/medical-records-list", $this->global, $data, NULL);
        }
    }

    function addNewDiagnosis()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['proles'] = $this->diagnosis_model->getPatientRoles();

            $this->global['pageTitle'] = 'Gidamu : Tambah Diagnosis Baru';

            $this->loadViews("diagnosis/add-new-diagnosis", $this->global, $data, NULL);
        }
    }

    function SaveNewTmpDiagnosis()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('prole','Patient','trim|required|max_length[8]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewDiagnosis();
            }
            else
            {
                $prole   = $this->input->post('prole');
                
                $is_check = $this->diagnosis_model->checkTmpDiagnosisInfo($this->userCode);

                if($is_check == 1)
                {
                    $tmpDiagnosisInfo = array('patient_code' => $prole);

                    $result = $this->diagnosis_model->editTmpDiagnosis($tmpDiagnosisInfo, $this->userCode);

                    $this->diagnosis_model->deleteTmpSymptoms($this->userCode);

                }else{
                    $tmpDiagnosisInfo = array('user_code'    => $this->userCode,
                                              'patient_code' => $prole);

                    $result = $this->diagnosis_model->saveNewTmpDiagnosis($tmpDiagnosisInfo);
                }
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Data diagnosis berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Data diagnosis gagal dibuat');
                }
                redirect('show-symptom-list');
            }
        }
    }

    function showSymptomList()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['sroles'] = $this->diagnosis_model->getSymptomRoles($this->tmp_code);

            $this->global['pageTitle'] = 'Gidamu : Daftar Pertanyaaan';

            $this->loadViews("diagnosis/show-symptom-list", $this->global, $data, NULL);

        }
    }

    function addSymptomSession(){
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $answer   = $this->input->post('answer');

            $this->tmp_code = $this->input->post('scode');

            if ($answer == 'Y' )
            {                  
                $cfvalue = $this->input->post('range_value');
  
                $syes = $this->diagnosis_model->checkSymptomRolesYes($this->tmp_code);

                $symptomCode    = $syes->if_yes;
                $symptomStart   = $syes->start;
                $symptomEnd     = $syes->end;

                if ($symptomStart == 'Y' && $symptomEnd == 'T')
                {
                    $this->saveTmpDiagnosis($cfvalue, $symptomCode);

                }elseif ($symptomStart == 'T' && $symptomEnd == 'T') 
                {
                    $this->saveTmpDiagnosis($cfvalue, $symptomCode);

                }elseif ($symptomStart == 'T' && $symptomEnd == 'Y') 
                {

                    $tmpSymptomInfo = array('user_code'     => $this->userCode,
                                            'symptom_code'  => $this->tmp_code,
                                            'cf_value'      => $cfvalue);

                    $this->diagnosis_model->saveNewTmpSymptom($tmpSymptomInfo);

                    $this->saveNewDiagnosis($symptomCode);
                }else
                {
                    $this->deleteTmpDiagnosisYes();
                }
            }else
            {
                $sno = $this->diagnosis_model->checkSymptomRolesNo($this->tmp_code);

                $symptomCode    = $sno->if_no;
                $symptomStart   = $sno->start;
                $symptomEnd     = $sno->end;

                if ($symptomStart == 'Y' && $symptomEnd =='T') {
                    
                    $data['sroles'] = $this->diagnosis_model->getSymptomRoles($symptomCode);

                    $this->global['pageTitle'] = 'Gidamu : Daftar Pertanyaaan';

                    $this->loadViews("diagnosis/show-symptom-list", $this->global, $data, NULL);

                }elseif($symptomStart == 'T' && $symptomEnd =='T')
                {
                    $this->deleteTmpDiagnosisNo($symptomCode);
                }else{
                    $this->deleteTmpDiagnosisNo($symptomCode);
                }
            }    
        }
    }

    public function saveTmpDiagnosis($cfvalue, $symptomCode){

        $tmpSymptomInfo = array('user_code'     => $this->userCode,
                                'symptom_code'  => $this->tmp_code,
                                'cf_value'      => $cfvalue);

        $this->diagnosis_model->saveNewTmpSymptom($tmpSymptomInfo);
        
        $data['sroles'] = $this->diagnosis_model->getSymptomRoles($symptomCode);

        $this->global['pageTitle'] = 'Gidamu : Daftar Pertanyaaan';

        $this->loadViews("diagnosis/show-symptom-list", $this->global, $data, NULL);
    }

    public function saveNewDiagnosis($symptomCode){
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $diseaseCode = $symptomCode;

            $is_check = $this->diagnosis_model->checkDiseaseInfo($diseaseCode);

            if($diseaseCode == null || $is_check == 0)
            {
                $this->diagnosis_model->deleteTmpSymptoms($this->userCode);
                $this->diagnosis_model->deleteTmpDiagnosis($this->userCode);

                $this->session->set_flashdata('error', 'Penyakit tidak dapat terdeteksi. Silahkan dicoba kembali.');

                redirect('diagnosis-list');
            }

            $dgcode     = $this->diagnosis_model->getDiagnosisCodes();

            $tmp_pcode = $this->diagnosis_model->getTmpDiagnosisInfo($this->userCode);            
            $tmp_scode  = $this->diagnosis_model->getTmpSymptomInfo($this->userCode);

            foreach ($tmp_scode as $tscode) {
                $tscodes[] = $tscode->symptom_code;
            }

            $check_rule = $this->diagnosis_model->checkRuleInfo($tscodes);

            $dcode      = $check_rule->disease_code;

            $check_symptom = $this->diagnosis_model->checkSymptomInfo($dcode);

            $cf_total = 0;

            foreach ($tmp_scode as $tscode)
            {
                foreach ($check_symptom as $checkscode) 
                {
                    if ($tscode->symptom_code == $checkscode->symptom_code) 
                    {
                        $cf_total = $cf_total + (($tscode->cf_value*$checkscode->cf_value)*(1-$cf_total));
                    }
                }
            }

            $cf_percent = $cf_total * 100; 
            
            $diagnosis_info = array('diagnosis_code'    => $dgcode,
                                    'created_by'        => $this->userCode, 
                                    'patient_code'      => $tmp_pcode,
                                    'disease_code'      => $dcode,
                                    'cf_total'          => $cf_percent);

            $result = $this->diagnosis_model->saveNewDiagnosis($diagnosis_info);
            
            if($result >= 0)
            {
                $this->diagnosis_model->deleteTmpSymptoms($this->userCode);
                $this->diagnosis_model->deleteTmpDiagnosis($this->userCode);

                $this->session->set_flashdata('success', 'Diagnosis berhasil dibuat');
            }
            else
            {
                $this->session->set_flashdata('error', 'Diagnosis gagal dibuat');
            }

            $dgcode = $this->diagnosis_model->checkLastDiagnosisInfo($this->userCode);

            $data['diagnosisInfo'] = $this->diagnosis_model->getDiagnosisInfo($dgcode->diagnosis_code);
            $data['diseaseInfo'] = $this->diagnosis_model->getDiseaseInfo($dgcode->diagnosis_code);
            
            $this->global['pageTitle'] = 'Gidamu : Hasil Rekam Medis Pasien';
            
            $this->loadViews("diagnosis/view-old-diagnosis", $this->global, $data, NULL);
        }
    }

    public function deleteTmpDiagnosisYes(){

        $this->diagnosis_model->deleteTmpSymptoms($this->userCode);
        $this->diagnosis_model->deleteTmpDiagnosis($this->userCode);

        $this->session->set_flashdata('error', 'Penyakit tidak dapat terdeteksi. Silahkan dicoba kembali.');

        redirect('diagnosis-list');
    }

    public function deleteTmpDiagnosisNo($symptomCode){

        if ($symptomCode == 'SC00000' || $symptomCode == 'DC0000') 
        {
            $this->diagnosis_model->deleteTmpSymptoms($this->userCode);
            $this->diagnosis_model->deleteTmpDiagnosis($this->userCode);

            $this->session->set_flashdata('error', 'Aturan tidak sesuai. Silahkan dicoba kembali.');

            redirect('diagnosis-list');
        }else
        {
            $data['sroles'] = $this->diagnosis_model->getSymptomRoles($symptomCode);

            $this->global['pageTitle'] = 'Gidamu : Daftar Pertanyaaan';

            $this->loadViews("diagnosis/show-symptom-list", $this->global, $data, NULL);
        }
    }

    function addNewPatient()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            $data['codes'] = $this->diagnosis_model->getPatientCodes();

            $this->global['pageTitle'] = 'Gidamu : Tambah Pasien Baru';

            $this->loadViews("diagnosis/add-new-patient", $this->global, $data, NULL);
        }
    }

    function saveNewPatient()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('pcode','Patient Code','required|max_length[8]');
            $this->form_validation->set_rules('fname','Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('gender','Gender','trim|required|max_length[1]');
            $this->form_validation->set_rules('datepicker','Born Date','required');
            $this->form_validation->set_rules('address','Address','required|max_length[255]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewPatient();
            }
            else
            {
                $pcode    = $this->input->post('pcode');
                $name     = ucwords(strtolower($this->input->post('fname')));
                $gender   = $this->input->post('gender');
                $born_date= $this->input->post('datepicker');
                $address= $this->input->post('address');
                
                $patientInfo = array('patient_code'     => $pcode,
                                     'patient_name'     => $name, 
                                     'patient_gender'   => $gender,
                                     'patient_born_date'=> $born_date,
                                     'patient_address'  => $address);

                $result = $this->diagnosis_model->saveNewPatient($patientInfo);
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Pasien berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pasien gagal dibuat');
                }                
                redirect('add-new-diagnosis');
            }
        }        
    }

    function editOldPatient($patientCode = NULL)
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->diagnosis_model->checkPatientInfo($patientCode);

            if($patientCode == null || $is_check == 0)
            {
                redirect('patient-list');
            }
            
            $data['patientInfo'] = $this->diagnosis_model->getPatientInfo($patientCode);
            
            $this->global['pageTitle'] = 'Gidamu : Ubah Pasien';
            
            $this->loadViews("diagnosis/edit-old-patient", $this->global, $data, NULL);
        }
    }
    
    function patientUpdate()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $patientCode = $this->input->post('pcode');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('gender','Gender','trim|required|max_length[1]');
            $this->form_validation->set_rules('datepicker','Born Date','required');
            $this->form_validation->set_rules('address','Address','required|max_length[255]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldPatient($patientCode);
            }
            else
            {
                $pcode    = $this->input->post('pcode');
                $name     = ucwords(strtolower($this->input->post('fname')));
                $gender   = $this->input->post('gender');
                $born_date= $this->input->post('datepicker');
                $address= $this->input->post('address');
                
                $patientInfo = array('patient_code'     => $pcode,
                                     'patient_name'     => $name, 
                                     'patient_gender'   => $gender,
                                     'patient_born_date'=> $born_date,
                                     'patient_address'  => $address);

                $result = $this->diagnosis_model->editPatient($patientInfo, $patientCode);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Pasien berhasil diperbarui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pasien gagal diperbarui');
                }
                
                redirect('diagnosis-list');
            }
        }
    }

    function viewOldDiagnosis($diagnosisCode = NULL)
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->diagnosis_model->checkDiagnosisInfo($diagnosisCode);

            if($diagnosisCode == null || $is_check == 0)
            {
                redirect('diagnosis-list');
            }
            
            $data['diagnosisInfo'] = $this->diagnosis_model->getDiagnosisInfo($diagnosisCode);
            $data['diseaseInfo'] = $this->diagnosis_model->getDiseaseInfo($diagnosisCode);

            $this->global['pageTitle'] = 'Gidamu : Hasil Rekam Medis Pasien';
            
            $this->loadViews("diagnosis/view-old-diagnosis", $this->global, $data, NULL);
        }
    }

    function printOldDiagnosis($diagnosisCode = NULL)
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->diagnosis_model->checkDiagnosisInfo($diagnosisCode);

            if($diagnosisCode == null || $is_check == 0)
            {
                redirect('diagnosis-list');
            }
            
            $data['diagnosisInfo'] = $this->diagnosis_model->getDiagnosisInfo($diagnosisCode);
            $data['diseaseInfo'] = $this->diagnosis_model->getDiseaseInfo($diagnosisCode);

            $this->global['pageTitle'] = 'Gidamu : Hasil Rekam Medis Pasien';
            
            $this->loadPrints("diagnosis/print-old-diagnosis", $this->global, $data, NULL);
        }
    }

    function deleteDiagnosis()
    {
        if($this->isPerawat() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $diagnosisCode = $this->input->post('diagnosisCode');
            
            $result = $this->diagnosis_model->deleteDiagnosis($diagnosisCode);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
}

?>