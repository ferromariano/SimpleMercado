<?php 

class smCarro
{
  function __construct() {
    add_action( 'init', array($this, 'init_wp'), 15 );
  }

  public function init_wp() {
    if(!session_id()) { session_start(); }
    smCarroInteractions::init();
  } 

  /**
   * alberga el contenido del las variables de session, del carrito
   *
   * @var array()
   **/
  private $data = null;

  /**
   * carga las variables de seccion del carrito $en data
   *
   * @return void
   **/
  private function loadData() { 
    if( !isset( $_SESSION[ smCarro::getKey() ] ) || !is_array($_SESSION[ smCarro::getKey() ]) ) 
      $_SESSION[ smCarro::getKey() ]=array(); 
    if( $this->data == null ) $this->data=$_SESSION[ smCarro::getKey() ]; 
  }

  /**
   * guarda las variables del carrito en seccion
   *
   * @return void
   **/
  private function saveData() { $_SESSION[ smCarro::getKey() ] = $this->data; }

  /**
   * devuelve las variables de carrito, todas o por bloke segun el paramentro $part
   *
   * @param string bloke de informacion a devolver, si no se especifica o es null, devuelve todos los blokes 
   * @return array 
   **/
  public function getData( $part=null ) { $this->loadData(); 
                                          if( $part == null ) return $this->data;
                                          if( !isset( $_SESSION[ smCarro::getKey() ][$part] ) || !is_array( $this->data[$part] )  ) $this->data[$part] = array();
                                          return $this->data[$part]; }
  /**
   * guarda las variables del carrito, todas o por bloke segun el paramentro $part
   *
   * @param string bloke de informacion a guardar, si no se especifica o es null, guarda todos los blokes 
   * @param array variables 
   * @param bool guarda informacion o no
   * @return array 
   **/
  public function setData( $part, $v, $save=true) { $this->loadData(); 
                                                    if( $part == null ) $this->data = $v; 
                                                    else                $this->data[$part] = $v; 
                                                    if($save) $this->saveData(); 
                                                }
  /* STATIC */
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
  static public function getInstance() { return self::$instance; }  
  /**
   * instancia y devuelve, instancia de smCarro
   *
   * @return class smCarro
   **/
  static public function init() {
    if( is_admin() ) return null;
    if( self::getInstance() == null ) self::$instance = new self();
    return self::$instance;
  } 

  static public function getKey()      { return '_SimpleMercado_'.md5( serialize(smConfig::$data) ).'_carro'; }  



}