<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        $this->isLoggedIn();
    }
    
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        $this->form_validation->set_message('valid_email', 'Silahkan memasukkan email yang valid');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginMe($email, $password);
            
            if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result->user_code);

                $sessionArray = array('roleCode'=>$result->role_code,
                                      'userCode'=>$result->user_code,
                                      'roleName'=>$result->role_name,
                                      'userName'=>$result->user_name,
                                      'lastLogin'=> $lastLogin->created_dtm,
                                      'isLoggedIn' => TRUE
                                    );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['roleCode'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                    
                $loginInfo = array("user_code"=>$result->user_code, "session_data" => json_encode($sessionArray), "machine_ip"=>$_SERVER['REMOTE_ADDR'], "browser_type"=>getBrowserAgent(), "platform"=>$this->agent->platform());

                $this->login_model->lastLogin($loginInfo);
                
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email atau password tidak sesuai');
                
                $this->index();
            }
        }
    }

}

?>