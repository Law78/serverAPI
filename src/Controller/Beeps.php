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
		

  public function __construct($params){
    echo 'Costruttore!';
    if(isset($params['id'])){
      $this->id = $params['id'];
    }
  }
	
  public function get(){
		echo 'Metodo GET di BEEPS';
    if(isset($this->id)){
      foreach($this->list as $key => $value){
        //echo $key. ' - ' . $value;
        if($key == $this->id){
          $oggetto = $this->list[$key];
        }
      }
    } else {
      $oggetto = $this->list;
    }

    $data['created'] = 'Oggi';
    $data['autore'] = 'Lorenzo';
    $data['list'] = $oggetto; //$this->list;
    //var_dump($data);
    //die;
    return $data;
	}

  public function index(){
    echo 'Metodo INDEX di BEEPS';
		return $this->get();
	}

}