<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class BaseController extends CI_Controller {
	protected $roleCode = '';
	protected $userCode = '';
	protected $userName = '';
	protected $roleName = '';	
	protected $lastLogin = '';
	protected $global = array ();
	
	public function response($data = NULL) {
		$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
		exit ();
	}

	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( 'login' );
		} else {			
			$this->roleCode = $this->session->userdata ( 'roleCode' );
			$this->userCode = $this->session->userdata ( 'userCode' );
			$this->userName = $this->session->userdata ( 'userName' );
			$this->roleName = $this->session->userdata ( 'roleName' );			
			$this->lastLogin = $this->session->userdata ( 'lastLogin' );
			
			$this->global ['userCode'] = $this->userCode;
			$this->global ['userName'] = $this->userName;
			$this->global ['roleCode'] = $this->roleCode;
			$this->global ['roleName'] = $this->roleName;
			$this->global ['lastLogin'] = $this->lastLogin;
		}
	}
	
	function isAdmin() {
		if ($this->roleCode != ROLE_ADMIN) {
			return true;
		} else {
			return false;
		}
	}

	function isPakar() {
		if ($this->roleCode != ROLE_PAKAR) {
			return true;
		} else {
			return false;
		}
	}

	function isPerawat() {
		if ($this->roleCode != ROLE_PERAWAT) {
			return true;
		} else {
			return false;
		}
	}
	
	function loadThis() {
		$this->global ['pageTitle'] = 'Gidamu : Akses ditolak';
		
		$this->load->view ( 'includes/header', $this->global );
		$this->load->view ( 'access' );
		$this->load->view ( 'includes/footer' );
	}
	
	function logout() {
		$this->session->sess_destroy ();
		
		redirect ( 'login' );
	}

    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }

    function loadPrints($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('includes/header-print', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer-print', $footerInfo);
    }
}