<?php

/**
* Clase que maneja el carrito despues de hacer el CheckOut
*/
class smCarroCheckedOut extends smCarroCheckOut {

  function __construct() { 
    parent::__construct(); }

  /************************************************************** STATIC */
  /**
   * almacena la instancia de la clase
   *
   * @var class smCarro
   **/
  static private $instance=null;
  /**
   * devuelve instancia de smCarro
   *
   * @return class smCarro
   **/
  static public function getInstance() { if( self::$instance == null ) self::init(); return self::$instance; }  
  /**
   * instancia y devuelve, instancia de smCarro
   *
   * @return class smCarro
   **/
  static public function init() {
    if( self::getInstance() == null ) self::$instance = new self();
    return self::$instance;
  } 

}