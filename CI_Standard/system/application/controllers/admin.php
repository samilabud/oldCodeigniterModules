<?php
class admin extends Controller{
	
	function __construct(){
		parent::Controller();
		$this->load->library("simplejqgrid");
		isAdmin();//To redirect if user is not logged
	}
	
	function index(){
	
		$data = array();
		$this->myload->backend('index');
	}

	/*
	*	User Manage
	*
	*/
	function cambiar_clave(){
		$data = array();
		if($this->input->post('c_actual')){
			$this->load->model('Usuario');
			
			$actual = $this->input->post('c_actual');
			$nueva = $this->input->post('c_nueva');

			$userid = $this->session->userdata('user_id');
			$change = $this->Usuario->ChangePassword($userid, $actual, $nueva);
			
			if(!$change){
				$data['msg_box'] = $this->msg_box('La contrase&ntilde;a actual no coincide.', 'error');
			}else{
				$data['msg_box'] = $this->msg_box('La contrase&ntilde;a ha sido cambiada.', 'info');
			}
		}
		$this->myload->backend('change_password', $data);
	}
	function login()
	{
		
		if (isLoggedAdmin())
					redirect('/admin/index');
		$data = array();		
		if ($this->input->post('username'))
		{
			$this->load->model('Usuario');
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			
			if ($this->Usuario->Login($username, $password) !== FALSE)
			{
				$userInfo = $this->Usuario->GetUserInfo($username);

				$userData = array(
                   'user_id'  => $userInfo['id_usuario'],
                   'email'     => $userInfo['email'],
                   'logged_on' => date('Y-m-d H:i:s'),
                   'logged_in' => TRUE
               );

			   $this->session->set_userdata($userData);

				redirect('admin/index');
				exit;
			}
			else
			{
				$data['msg_box'] = $this->msg_box('El nombre de usuario o contrase&ntilde;a es incorrecto.', 'error');
			}
		};

		$this->myload->backend('login',$data);
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect("admin/login");
	}

	function msg_box($str, $msgType)
	{
		return '<div class="msg_box '. $msgType .'">'. $str .'</div>';
	}
	/********************************************* END USERS *********************************************/
}
?>