<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Error_404 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
            redirect('page-not-found');
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Gidamu : 404 - Halaman tidak ditemukan';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>
