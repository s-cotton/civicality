<?php

use \Fuel\Core;

class Controller_Civicality extends Controller_Template {

	public $_use_template = true;

	public function before($data = null){
		parent::before();

		$this->auto_render = false;

		$session = Session::instance();
		/*$auth = Auth::instance();

		if($auth->check()){
			$the_user_data = $auth->get_profile_fields();
			$session->set('user_data',$the_user_data);
		} else {
			$session->delete('user_data');
		}*/

		Asset::add_path('/public/assets/');

		$this->template->title = '';
		$this->template->set('css',array(
		//	'base'      => Asset::css('base.css'),
		//	'jquery-ui' => Asset::css('jquery-ui-1.8.20.custom.css'),
		//	Asset::css('jquery.tablesorter/style.css'),
		//	'default'   => Asset::css('default.css')
		),false);

		$this->template->set('script',array(
		//	'jquery'     => Asset::js('jquery-1.7.2.min.js'),
		//	'jquery-ui'  => Asset::js('jquery-ui-1.8.20.custom.min.js'),
		//	'modernizer' => Asset::js('modernizr-2.5.3.min.js'),
		//	'phpjs'      => Asset::js('php.default.min.js'),
		//	'modal'      => Asset::js('jquery.simplemodal.1.4.min.js'),
		//	'metadata' => Asset::js('jquery.metadata.js'),
		//	'tablesort' => Asset::js('jquery.tablesorter.min.js'),
		//	'default'    => Asset::js('default.js')

		),false);
		
	}

	public function after($response){
		//parent::after($response);

		if($this->_use_template == true){

			/*$auth = Auth::instance();

			if($auth->check()){
				$the_user_data = $auth->get_profile_fields();
				$this->template->set('welcome_text','Welcome, '.$the_user_data['name']);
			} else {
				$this->template->set('welcome_text','Not Logged In');
			}*/

			//$this->template->set('logo_image',Asset::img('logo.png'),false);
			$this->template->year = date('Y');
			//$this->template->set('menu_content',$this->get_menu_content(),false);

			$this->response->body = $this->template;	
		}
		return $this->response;
	}

	public function require_login(){
		//$auth = Auth::instance();
		//if(!$auth->check()) Response::redirect('/');
		return false;
	}

	public function get_menu_items(){
		/*
		$auth = Auth::instance();

		$data = array(
			'items' => array(
				'home' => array(
					'title' => 'Home',
					'link' => '/'
				),
				'about' => array(
					'title' => 'About',
					'link' => '/page/about'
				)
			)
		);

		if($auth->check() !== false){
			$data['items']['reports'] = array(
				'title' => 'Reports',
				'link' => '/reports/home'
			);
			$data['items']['logout'] = array(
				'title' => 'Logout',
				'link' => '/auth/logout'
			);
		}
		// Process State and such here
		return $data;
		*/
		return array();
	}

	public function get_menu_content(){
		//return View::forge('templates/menu',self::get_menu_items(),true);
	}

	public function generate_title($page_title){
		if(stristr($page_title, 'Civicality') !== false) return $page_title;
		return $page_title.' - Civicality';
	}


	public function action_404(){
		
	}
}