<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_controller extends CI_Controller {
	var $template = FALSE;
	const cart_session_key = "CartId";
	const admin = "admin";
	const logon = "logon";
	const user = "user";
	function __construct()
    {
        // �I�s���غc���
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
    }
	
	protected function get_genre()
	{
		$this->load->model("genre_model");							
		return $this->genre_model->get_list();	
	}
	
	//��XN�W���P�q
	protected function get_top_selling_albums($p_count)
	{
		$this->load->model("albums_model");									
		return $this->albums_model->get_top_selling_albums($p_count);
	}
	
	//���o�ثeshopping cart �����h�֪F��
	protected function cart_summary()
	{
		$cart_count = 0;
		//echo self::cart_session_key;
		//����٨S���F����shopping cart���h\
		
		if($this->session->userdata(self::cart_session_key)
						<> FALSE)
		{
			$this->load->model("shopping_cart_model","shopcart");
			$cart_count = $this->shopcart->cart_summary(
				$this->session->userdata(self::cart_session_key));
			if($cart_count == FALSE)
			{
				$cart_count = 0;
			}		
		}
		
		return $cart_count;
	}	
		
	//�ˬd�O�_�w�g�n�J�L
	protected function is_logon()
	{		
		$is_logon = FALSE;		
		if($this->session->userdata("logon") <> FALSE)
		{
			$is_logon = TRUE;
		}
		return $is_logon;
	}
	
	//�ˬd�O�_��Administrator
	protected function is_admin()
	{
		$is_admin = FALSE;
		if($this->session->userdata(self::admin)<>FALSE)
		{
			$is_admin = TRUE;
		}
		return $is_admin;
	}
	
	protected function get_who()
	{
		$user = "";		
		if($this->session->userdata(self::user)<>FALSE)
		{
			$user = $this->session->userdata(self::user);
		}
		return $user;		
	}
	
	protected function set_session_value($p_admin,$p_logon,$p_user)
	{
		//�p�G�n�J�L�N�O���U�� 1���logon ���\
		$this->session->set_userdata(self::logon,$p_logon);
		$this->session->set_userdata(self::admin,$p_admin);
		$this->session->set_userdata(self::user,$p_user);
	}
	
	protected function get_view_collect($p_title="PHP Codeigniter Music Store"
					,$p_albums=5,$p_include="home/index")
	{
		
		$this->template = array("genre" => $this->get_genre()
				,"albums" => $this->get_top_selling_albums($p_albums)
				,"cart_count" => $this->cart_summary()
				,"title" => $p_title
				,"include" => $p_include
				);		
	}
	
	protected function get_cart_id()
	{
		if($this->session->userdata(self::cart_session_key) == FALSE)
		{
			$this->session->set_userdata(self::cart_session_key,uniqid());			
		}
		return $this->session->userdata(self::cart_session_key);
	}
	
	//�o�ɭn��cart_session_key �M��
	protected function checkout()
	{
		$this->session->set_userdata(self::cart_session_key,FALSE);
	}
}

/* End of file MY_controller.php */
/* Location: ./application/controllers/MY_controller.php */
