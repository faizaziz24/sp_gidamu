<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class User extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }

    public function index()
    {
        redirect('user-list');
    }
    
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['userRecords'] = $this->user_model->userListing();
            
            $this->global['pageTitle'] = 'Gidamu : Daftar Pengguna';
            
            $this->loadViews("users/user-list", $this->global, $data, NULL);
        }
    }

    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['roles'] = $this->user_model->getUserRoles();
            $data['codes'] = $this->user_model->getUserCodes();
            
            $this->global['pageTitle'] = 'Gidamu : Tambah Pengguna Baru';

            $this->loadViews("users/add-new-user", $this->global, $data, NULL);
        }
    }

    function saveNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('ucode','User Code','required|max_length[8]');
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|max_length[8]');
            $this->form_validation->set_rules('phone','Phone Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewUser();
            }
            else
            {
                $ucode    = $this->input->post('ucode');
                $role_code= $this->input->post('role');
                $name     = ucwords(strtolower($this->input->post('fname')));
                $email    = strtolower($this->security->xss_clean($this->input->post('email')));
                $phone    = strtolower($this->security->xss_clean($this->input->post('phone')));
                $password = strtolower($this->security->xss_clean($this->input->post('password')));
                
                $userInfo = array('role_code'=>$role_code,
                                  'user_code'=>$ucode, 
                                  'user_name'=> $name, 
                                  'user_phone'=>$phone,
                                  'user_email'=>$email, 
                                  'user_password'=>getHashedPassword($password));

                $result = $this->user_model->saveNewUser($userInfo);
                
                if($result >= 0)
                {
                    $this->session->set_flashdata('success', 'Pengguna berhasil dibuat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pengguna gagal dibuat');
                }
                
                redirect('user-list');
            }
        }
    }

    function editOldUser($userCode = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $is_check = $this->user_model->checkUserInfo($userCode);

            if($userCode == null || $is_check == 0)
            {
                redirect('user-list');
            }else{
                $data['roles'] = $this->user_model->getUserRoles();
                $data['userInfo'] = $this->user_model->getUserInfo($userCode);
                
                $this->global['pageTitle'] = 'Gidamu : Ubah Pengguna';
                
                $this->loadViews("users/edit-old-user", $this->global, $data, NULL);
            }
        }
    }
    
    function userUpdate()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userCode = $this->input->post('ucode');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','max_length[20]');
            $this->form_validation->set_rules('phone','Phone Number','required|min_length[10]');
            $this->form_validation->set_rules('role','Role','trim|required|max_length[8]');
            $this->form_validation->set_rules('status','Status','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldUser($userCode);
            }
            else
            {
                $role_code= $this->input->post('role');
                $status   = $this->input->post('status');
                $name     = ucwords(strtolower($this->input->post('fname')));
                $email    = strtolower($this->security->xss_clean($this->input->post('email')));
                $phone    = strtolower($this->security->xss_clean($this->input->post('phone')));
                $password = strtolower($this->security->xss_clean($this->input->post('password')));
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('role_code'     => $role_code,
                                      'user_name'     => $name, 
                                      'user_phone'    => $phone,
                                      'user_email'    => $email,
                                      'user_activated'=> $status 
                                  );
                }
                else
                {
                    $userInfo = array('role_code'     => $role_code,
                                      'user_name'     => $name, 
                                      'user_phone'    => $phone,
                                      'user_email'    => $email,
                                      'user_activated'=> $status,
                                      'user_password' => getHashedPassword($password));
                }
                
                $result = $this->user_model->editUser($userInfo, $userCode);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pengguna gagal diperbarui');
                }
                
                redirect('user-list');
            }
        }
    }

    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userCode = $this->input->post('userCode');
            $userInfo = array('user_activated'=>0, 'user_deleted'=>1);
            
            $result = $this->user_model->deleteUser($userCode, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    function loginHistoy($userCode = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userCode = ($userCode == NULL ? 0 : $userCode);

            $data['userRecords'] = $this->user_model->loginHistory($userCode);
            
            $this->global['pageTitle'] = 'CodeInsect : Riwayat Login Pengguna';
            
            $this->loadViews("users/login-history", $this->global, $data, NULL);
        }        
    }

    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('phone','Phone Number','required|numeric|min_length[10]');

        $this->form_validation->set_message('numeric', 'Silahkan memasukkan angka saja');
        $this->form_validation->set_message('required', 'Bagian ini harus diisi');
        $this->form_validation->set_message('min_length', 'Silahkan memasukkan nomor lebih dari 10 angka');
        $this->form_validation->set_message('max_length', 'Silahkan memasukkan nomor tidak lebih dari 128 karakter');

        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $user_name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $user_phone = $this->security->xss_clean($this->input->post('phone'));
            
            $userInfo = array('user_name'=>$user_name,'user_phone'=>$user_phone);
            
            $result = $this->user_model->editUser($userInfo, $this->userCode);
            
            if($result == true)
            {
                $this->session->set_userdata('user_name', $user_name);
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profil gagal diperbarui');
            }

            redirect('profile/'.$active);
        }
    }
    
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Password Lama','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','password Baru','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Konfirmasi Password Baru','required|matches[newPassword]|max_length[20]');

        $this->form_validation->set_message('matches', 'Silahkan memasukkan password yang sama');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $old_password = $this->input->post('oldPassword');
            $new_password = $this->input->post('newPassword');
            
            $result = $this->user_model->matchOldPassword($this->userCode, $old_password);
            
            if(empty($result))
            {
                $this->session->set_flashdata('nomatch', 'Password lama tidak sesuai');
                redirect('profile/'.$active);
            }
            else
            {
                $usersData = array('user_password'=>getHashedPassword($new_password));
                
                $result = $this->user_model->changePassword($this->userCode, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password berhasil diperbarui'); }
                else { $this->session->set_flashdata('error', 'Password gagal diperbarui'); }
                
                redirect('profile/'.$active);
            }
        }
    }

    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->userCode);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "details" ? 'Gidamu : Profil Saya' : 'Gidamu : Ubah Password';
        $this->loadViews("profile", $this->global, $data, NULL);
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Gidamu : 404 - Halaman tidak ditemukan';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
?>