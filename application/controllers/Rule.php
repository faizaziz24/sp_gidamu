<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Rule extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rule_model');
        $this->isLoggedIn();   
    }
    
    public function index()
    {
        redirect('rule-list');
    }
    
    function ruleListing()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['ruleRecords'] = $this->rule_model->ruleListing();

            $this->global['pageTitle'] = 'Gidamu : Daftar Aturan';
            
            $this->loadViews("rules/rule-list", $this->global, $data, NULL);
        }
    }

    function addNewRule()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            $data['sroles'] = $this->rule_model->getSymptomRoles();
            $data['droles'] = $this->rule_model->getDiseaseRoles();

            $data['coder']  = $this->rule_model->getRuleCodes();

            $this->global['pageTitle'] = 'Gidamu : Tambah Aturan Baru';

            $this->loadViews("rules/add-new-rule", $this->global, $data, NULL);
        }
    }
    
    function saveNewRule()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('rcode','Rule Code','required|max_length[8]');
            $this->form_validation->set_rules('drole','Disease','required');
            $this->form_validation->set_rules('srole','Symptom','required');
            $this->form_validation->set_rules('range_value','CF Value','numeric');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNewRule();
            }
            else
            {
                $rcode    = $this->input->post('rcode');
                $drole    = $this->input->post('drole');
                $srole    = $this->input->post('srole');
                $cfvalue  = $this->input->post('range_value');

                $ruleInfo = array('rule_code'       => $rcode,
                                  'disease_code'    => $drole,
                                  'symptom_code'    => $srole, 
                                  'cf_value'        => $cfvalue);

                $result = $this->rule_model->saveNewRule($ruleInfo);
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Aturan berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Aturan gagal dibuat');
                }
                
                redirect('rule-list');
            }
        }
        
    }

    function viewOldRule($diseaseCode = NULL)
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->rule_model->checkDiseaseInfo($diseaseCode);

            if($diseaseCode == null || $is_check == 0)
            {
                redirect('rule-list');
            }
            
            $data['diseaseInfo'] = $this->rule_model->getDiseaseInfo($diseaseCode);

            $data['sroles'] = $this->rule_model->getSymptomRoles();
            $data['droles'] = $this->rule_model->getDiseaseRoles();
            
            $data['coder']  = $this->rule_model->getRuleCodes();

            $this->global['pageTitle'] = 'Gidamu : Daftar Gejala-gejala dari Penyakit';
            
            $this->loadViews("rules/view-old-rule", $this->global, $data, NULL);
        }
    }

    function editOldRule($ruleCode = NULL)
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->rule_model->checkRuleInfo($ruleCode);

            if($ruleCode == null || $is_check == 0)
            {
                redirect('rule-list');
            }
            
            $data['ruleInfo'] = $this->rule_model->getRuleInfo($ruleCode);

            $data['droles'] = $this->rule_model->getDiseaseRoles();
            $data['sroles'] = $this->rule_model->getSymptomRoles();

            $this->global['pageTitle'] = 'Gidamu : Ubah Aturan';
            
            $this->loadViews("rules/edit-old-rule", $this->global, $data, NULL);
        }
    }

    function checkSymptomExists()
    {
        $drole = $this->input->post("drole");
        $srole = $this->input->post("srole");

        $result = $this->rule_model->checkSymptomExists($drole, $srole);

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    function ruleUpdate()
    {
        if($this->isPakar() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $ruleCode = $this->input->post('rcode');
            
            $this->form_validation->set_rules('rcode','Rule Code','required|max_length[8]');
            $this->form_validation->set_rules('drole','Disease','required');
            $this->form_validation->set_rules('srole','Symptom','required');
            $this->form_validation->set_rules('range_value','CF Value','numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldRule($ruleCode);
            }
            else
            {
                $drole    = $this->input->post('drole');
                $srole    = $this->input->post('srole');
                $cfvalue  = $this->input->post('range_value');

                $ruleInfo = array('disease_code'    => $drole,
                                  'symptom_code'    => $srole, 
                                  'cf_value'        => $cfvalue);

                $result = $this->rule_model->editRule($ruleInfo, $ruleCode);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Aturan berhasil diperbarui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Aturan gagal diperbarui');
                }
                
                redirect('rule-list');
            }
        }
    }

    function deleteRule()
    {
        if($this->isPakar() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $ruleCode = $this->input->post('ruleCode');
            
            $result = $this->rule_model->deleteRule($ruleCode);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
}

?>
