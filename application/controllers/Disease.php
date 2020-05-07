<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Disease extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('disease_model');
        $this->isLoggedIn();   
    }
    
    public function index()
    {
        redirect('disease-list');
    }
    
    function diseaseListing()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['diseaseRecords'] = $this->disease_model->diseaseListing();
            
            $this->global['pageTitle'] = 'Gidamu : Daftar Penyakit';
            
            $this->loadViews("diseases/disease-list", $this->global, $data, NULL);
        }
    }

    function addNewDisease()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            $data['codes'] = $this->disease_model->getDiseaseCodes();

            $this->global['pageTitle'] = 'Gidamu : Tambah Penyakit Baru';

            $this->loadViews("diseases/add-new-disease", $this->global, $data, NULL);
        }
    }
    
    function saveNewDisease()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('dcode','Disease Code','required|max_length[8]');
            $this->form_validation->set_rules('dname','Disease Name','trim|required');
            $this->form_validation->set_rules('explain','Disease Explain','trim|required');
            $this->form_validation->set_rules('healing','Healing','trim|required');
            $this->form_validation->set_rules('preventing','Preventing','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewDisease();
            }
            else
            {
                $dcode     = $this->input->post('dcode');
                $dname     = ucwords(strtolower($this->input->post('dname')));
                $explain   = $this->input->post('explain');
                $healing   = $this->input->post('healing');
                $preventing= $this->input->post('preventing');
                
                $diseaseInfo = array('disease_code'     => $dcode,
                                     'disease_name'     => $dname, 
                                     'disease_explain'  => $explain,
                                     'healing'          => $healing,
                                     'preventing'       => $preventing);

                $result = $this->disease_model->saveNewDisease($diseaseInfo);
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Penyakit berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Penyakit gagal dibuat');
                }
                
                redirect('disease-list');
            }
        }
        
    }

    function editOldDisease($diseaseCode = NULL)
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->disease_model->checkDiseaseInfo($diseaseCode);

            if($diseaseCode == null || $is_check == 0)
            {
                redirect('disease-list');
            }
            
            $data['diseaseInfo'] = $this->disease_model->getDiseaseInfo($diseaseCode);
            
            $this->global['pageTitle'] = 'Gidamu : Ubah Penyakit';
            
            $this->loadViews("diseases/edit-old-disease", $this->global, $data, NULL);
        }
    }
    
    function diseaseUpdate()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $diseaseCode = $this->input->post('dcode');
            
            $this->form_validation->set_rules('dname','Disease Name','required|min_length[5]');
            $this->form_validation->set_rules('explain','Disease Explain','required|min_length[5]');
            $this->form_validation->set_rules('healing','Healing','required|min_length[5]');
            $this->form_validation->set_rules('preventing','Preventing','required|min_length[5]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldDisease($diseaseCode);
            }
            else
            {
                $dcode     = $this->input->post('dcode');
                $dname     = ucwords(strtolower($this->input->post('dname')));
                $explain   = $this->input->post('explain');
                $healing   = $this->input->post('healing');
                $preventing= $this->input->post('preventing');
                
                $diseaseInfo = array('disease_code'     => $dcode,
                                     'disease_name'     => $dname, 
                                     'disease_explain'  => $explain,
                                     'healing'          => $healing,
                                     'preventing'       => $preventing);

                $result = $this->disease_model->editDisease($diseaseInfo, $diseaseCode);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Penyakit berhasil diperbarui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Penyakit gagal diperbarui');
                }
                
                redirect('disease-list');
            }
        }
    }

    function deleteDisease()
    {
        if($this->isPakar() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $diseaseCode = $this->input->post('diseaseCode');

            $result = $this->disease_model->checkSymptomInfobyDiseaseCode($diseaseCode);

            $result2 = $this->disease_model->checkRuleInfobyDiseaseCode($diseaseCode);

            if ($result > 0 || $result2 > 0) 
            { 
                echo(json_encode(array('status'=>FALSE)));                 
            }else { 

                $this->disease_model->deleteDisease($diseaseCode);

                echo(json_encode(array('status'=>TRUE))); 
            }
        }
    }
}

?>