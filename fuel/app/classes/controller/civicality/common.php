<?php


class Controller_Civicality_Common extends Controller_Civicality {
	public function action_index(){
		$this->template->set('content','test');
	}
	public function action_404(){
		$this->template->set('content','This is a 404');
	}
}

