<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Symptom extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('symptom_model');
        $this->isLoggedIn();   
    }
    
    public function index()
    {
        redirect('symptom-list');
    }
    
    function symptomListing()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['symptomRecords'] = $this->symptom_model->symptomListing();
            
            $this->global['pageTitle'] = 'Gidamu : Daftar Gejala';
            
            $this->loadViews("symptoms/symptom-list", $this->global, $data, NULL);
        }
    }

    function addNewSymptom()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            $data['sroles'] = $this->symptom_model->getSymptomRoles();
            $data['droles'] = $this->symptom_model->getDiseaseRoles();

            $data['codes']  = $this->symptom_model->getSymptomCodes();

            $this->global['pageTitle'] = 'Gidamu : Tambah Penyakit Baru';

            $this->loadViews("symptoms/add-new-symptom", $this->global, $data, NULL);
        }
    }
    
    function saveNewSymptom()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('scode','Symptom Code','required|max_length[8]');
            $this->form_validation->set_rules('sname','Symptom Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('squest','Question Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('syes','Symptom Yes','required|max_length[8]');
            $this->form_validation->set_rules('sno','Symptom No','required|max_length[8]');
            $this->form_validation->set_rules('sstart','Start','trim|required|max_length[1]');
            $this->form_validation->set_rules('send','End','trim|required|max_length[1]');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNewSymptom();
            }
            else
            {
                $scode     = $this->input->post('scode');
                $sname     = $this->input->post('sname');
                $squest    = $this->input->post('squest');
                $syes      = $this->input->post('syes');
                $sno       = $this->input->post('sno');
                $sstart    = $this->input->post('sstart');
                $send      = $this->input->post('send');
                
                $symptomInfo = array('symptom_code'     => $scode,
                                     'symptom_name'     => $sname,
                                     'symptom_question' => $squest,
                                     'if_yes'           => $syes,
                                     'if_no'            => $sno,
                                     'start'            => $sstart,
                                     'end'              => $send);

                $result = $this->symptom_model->saveNewSymptom($symptomInfo);
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Gejala berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Gejala gagal dibuat');
                }
                
                redirect('symptom-list');
            }
        }
        
    }

    function editOldSymptom($symptomCode = NULL)
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->symptom_model->checkSymptomInfo($symptomCode);

            if($symptomCode == null || $is_check == 0)
            {
                redirect('symptom-list');
            }
            
            $data['symptomInfo'] = $this->symptom_model->getSymptomInfo($symptomCode);

            $data['sroles'] = $this->symptom_model->getSymptomRoles();
            $data['droles'] = $this->symptom_model->getDiseaseRoles();
            
            $this->global['pageTitle'] = 'Gidamu : Ubah Penyakit';
            
            $this->loadViews("symptoms/edit-old-symptom", $this->global, $data, NULL);
        }
    }
    
    function symptomUpdate()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $symptomCode = $this->input->post('scode');
            
            $this->form_validation->set_rules('scode','Symptom Code','required|max_length[8]');
            $this->form_validation->set_rules('sname','Symptom Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('squest','Question Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('syes','Symptom Yes','required|max_length[8]');
            $this->form_validation->set_rules('sno','Symptom No','required|max_length[8]');
            $this->form_validation->set_rules('sstart','Start','trim|required|max_length[1]');
            $this->form_validation->set_rules('send','End','trim|required|max_length[1]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldSymptom($symptomCode);
            }
            else
            {
                $scode     = $this->input->post('scode');
                $sname     = $this->input->post('sname');
                $squest    = $this->input->post('squest');
                $syes      = $this->input->post('syes');
                $sno       = $this->input->post('sno');
                $sstart    = $this->input->post('sstart');
                $send      = $this->input->post('send');
                
                $symptomInfo = array('symptom_code'     => $scode,
                                     'symptom_name'     => $sname,
                                     'symptom_question' => $squest,
                                     'if_yes'           => $syes,
                                     'if_no'            => $sno,
                                     'start'            => $sstart,
                                     'end'              => $send);

                $result = $this->symptom_model->editSymptom($symptomInfo, $symptomCode);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Gejala berhasil diperbarui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Gejala gagal diperbarui');
                }
                
                redirect('symptom-list');
            }
        }
    }



    function deleteSymptom()
    {
        if($this->isPakar() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $symptomCode = $this->input->post('symptomCode');

            $result = $this->symptom_model->checkSymptomInfobySymptomCode($symptomCode);

            $result2 = $this->symptom_model->checkRuleInfobySymptomCode($symptomCode);

            if ($result > 0 || $result2 > 0) 
            { 
                echo(json_encode(array('status'=>FALSE)));                 
            }else { 

                $this->symptom_model->deleteSymptom($symptomCode);

                echo(json_encode(array('status'=>TRUE))); 
            }
        }
    }
}

?>