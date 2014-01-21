<?php 

class smCarro
{
  public $key=null;  
  function __construct() {
    $this->key = '_SimpleMercado_'.md5( serialize(smConfig::$data) ).'_carro';
    add_action( 'init', array($this, 'init_wp'), 11 );
  }

  public function init_wp() {
    if(!session_id()) { session_start(); }
    smCarroInteractions::init();
  } 

  /**
   * devuelve listado de productos en el carrito
   *
   * @return array  { post: class, name: string, desc: string, count: string, unidad: string }
   **/
  public function getProductos() {
    $data = $this->getData('productos');

    $r = array();
    foreach ($data as $k => $v) {
      if( ! isset( $v['post'] ) ) continue; 
      $producto = smProducto::initByID( $v['post']['ID'] );

      $r[] = array(
          'post'      => $producto,
          'name'      => $producto->getPost()->post_title,
          'desc'      => '',
          'count'     => $v['count'],
          'unidad'    => $producto->get('precio', '1'),
          'total'     => ( $v['count'] * $producto->get('precio', '1') ),
        );
    }
    return $r;
  }

  /**
   * devuelve sub total
   *
   * @return integer
   **/
  public function getSubTotal() { $subtotal = 0; return apply_filters( 'simpleMercado_shortcode_carrito_getSubTotal', $subtotal ); }

  /**
   * devuelve total de la compra
   *
   * @return integer
   **/
  public function getTotal()    { $total = 0;    return apply_filters( 'simpleMercado_shortcode_carrito_getTotal',    $total ); }

  /**
   * alberga el contenido del las variables de session, del carrito
   *
   * @var array()
   **/
  private var $data = null;

  /**
   * carga las variables de seccion del carrito $en data
   *
   * @return void
   **/
  private function loadData() { 
    if( !isset( $_SESSION[$this->key] ) || !is_array($_SESSION[$this->key]) ) $_SESSION[$this->key]=array(); 
    if( $this->data == null ) $this->data=$_SESSION[$this->key]; 
  }

  /**
   * guarda las variables del carrito en seccion
   *
   * @return void
   **/
  private function saveData() { $_SESSION[$this->key] = $this->data; }

  /**
   * devuelve las variables de carrito, todas o por bloke segun el paramentro $part
   *
   * @param string bloke de informacion a devolver, si no se especifica o es null, devuelve todos los blokes 
   * @return array 
   **/
  public function getData( $part=null ) { $this->loadData(); 
                                          if( $part == null )
                                            return $this->data;
                                          if( !isset( $_SESSION[$this->key][$part] ) || !is_array( $this->data[$part] )  ) $this->data[$part] = array();
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
  static private var $instance=null;
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
    return self::$instance
  } 
}