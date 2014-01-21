<?php

/**
* 
*/
class smCarroCheckOut extends smCarro {

  function __construct() {
    parent::__construct();
    add_action( 'init', array($this, 'init_wp'), 12 );
  }

  function init_wp() {
    if( ! $request = $this->request_validacion() ) return;

    $this->actionCheckOut();


  }
  /**
   * Valida si el formulario del carrito 
   *
   * @return bool
   **/
  function request_validacion() {
  }

  /**
   * el proceso de guardado de los datos
   *
   * @return void
   **/
  function actionCheckOut() {

  }
  function response_page_after($r='') {
//    add_filter('simpleMercado_carro_page_response',   array( $this, '' ) , 10, 2);    

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
   * Cierra el carrito, 
   *
   * @return bool
   **/
  public function setClose($ID) {  }

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
    if( is_admin() ) return null;    
    if( self::$instance == null ) self::$instance = new self();
    return self::$instance;
  } 

}