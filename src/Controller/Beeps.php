<?php

namespace ServerAPI\Controllers;

Class Beeps {

  private $list = array(
		1 => 'Apple iPhone 6S',  
		2 => 'Samsung Galaxy S6',  
		3 => 'Apple iPhone 6S Plus',  			
		4 => 'LG G4',  			
		5 => 'Samsung Galaxy S6 edge',  
		6 => 'OnePlus 2');
		

  public function __constructor__(){
    //echo 'Eccomi';
  }
	
  public function get(){
		//echo 'Metodo GET di BEEPS';
    
    $data['created'] = 'Oggi';
    $data['autore'] = 'Lorenzo';
    $data['list'] = $this->list;
    return $data;
	}

  public function index(){
		$this->get();
	}

}