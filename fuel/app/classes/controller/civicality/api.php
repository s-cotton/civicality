<?php

Use Fuel\Core;

class Controller_Civicality_Api extends Controller_Civicality{
	public static $default_type = 'json';
	public static $available_types = array( 'json', 'xml', 'txt', 'zip');

	public function action_index(){
		$this->state();
		$this->template->set('content','('.$this->request->uri.') State:<pre>'.print_r($this->_state,true).'</pre> ('.$this->request->route->path.') Route: <pre>'.print_r($this->request->route->segments,true).'</pre>',false);
	}

	public function get_index(){

	}

	public function put_index(){
		throw new HttpNotFoundException;
	}

	public function action_types(){
		$this->template->set('content','This is the types page');
	}
}
?>