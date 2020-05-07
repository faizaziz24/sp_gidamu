<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Patient extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('patient_model');
        $this->isLoggedIn();   
    }
    
    public function index()
    {
        redirect('patient-list');
    }
    
    function patientListing()
    {
        if($this->isPerawat() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['patientRecords'] = $this->patient_model->patientListing();
            
            $this->global['pageTitle'] = 'Gidamu : Daftar Pasien';
            
            $this->loadViews("patients/patient-list", $this->global, $data, NULL);
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

            $data['codes'] = $this->patient_model->getPatientCodes();

            $this->global['pageTitle'] = 'Gidamu : Tambah Pasien Baru';

            $this->loadViews("patients/add-new-patient", $this->global, $data, NULL);
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
            
            $this->form_validation->set_rules('pcode','User Code','required|max_length[8]');
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
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

                $result = $this->patient_model->saveNewPatient($patientInfo);
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Pasien berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pasien gagal dibuat');
                }
                
                redirect('patient-list');
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
            $is_check = $this->patient_model->checkPatientInfo($patientCode);

            if($patientCode == null || $is_check == 0)
            {
                redirect('patient-list');
            }
            
            $data['patientInfo'] = $this->patient_model->getPatientInfo($patientCode);
            
            $this->global['pageTitle'] = 'Gidamu : Ubah Pasien';
            
            $this->loadViews("patients/edit-old-patient", $this->global, $data, NULL);
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

                $result = $this->patient_model->editPatient($patientInfo, $patientCode);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Pasien berhasil diperbarui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pasien gagal diperbarui');
                }
                
                redirect('patient-list');
            }
        }
    }

    function deletePatient()
    {
        if($this->isPerawat() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $patientCode = $this->input->post('patientCode');

            $result = $this->patient_model->checkDiagnosisInfobyPatientCode($patientCode);

            if ($result > 0) 
            { 
                echo(json_encode(array('status'=>FALSE)));                 
            }else { 
                $this->patient_model->deletePatient($patientCode);

                echo(json_encode(array('status'=>TRUE))); 
            }

        }
    }
}

?>