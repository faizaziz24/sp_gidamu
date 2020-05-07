<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        $data['userRecords'] = $this->dashboard_model->userRecords();
        $data['patientRecords'] = $this->dashboard_model->patientRecords();
        $data['symptomRecords'] = $this->dashboard_model->symptomRecords();
        $data['diseaseRecords'] = $this->dashboard_model->diseaseRecords();
        $data['ruleRecords'] = $this->dashboard_model->ruleRecords();
        $data['diagnosisRecords'] = $this->dashboard_model->diagnosisRecords();

        $this->global['pageTitle'] = 'Gidamu : Dashboard';
        
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }
        
}

?>