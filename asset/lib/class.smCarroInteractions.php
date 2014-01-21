<?php

 class smCarroInteractions extends smCarro
 {

  function __construct() {
    $this->key = '_SimpleMercado_'.md5( serialize(smConfig::$data) ).'_carro';

    add_filter('simpleMercado_ajax_add_carro_controller', array( $this, 'filters_actionProductoAdd' ) , 10, 2);
    add_filter('simpleMercado_ajax_add_carro_response',   array( $this, 'filters_responseProductoAdd' ) , 10, 2);    

    if( ! ($request = $this->validateInteraction()) ) return;

    $request = apply_filters( 'simpleMercado_ajax_'.$request['action'].'_request', $request );
          $r = apply_filters( 'simpleMercado_ajax_'.$request['action'].'_controller', array( 'error'=>0, 'txt'=>'', 'exit' => 0 ), $request );
          $r = apply_filters( 'simpleMercado_ajax_'.$request['action'].'_response', $r, $request );

    if($r['exit'] == 1) { exit(); }
    return;
  }

  public function filters_actionProductoAdd( $r, $params ) {
    $data = $this->getData('productos');

    if( isset( $data[ $params['producto']->ID ] ) ) {
      $data[ $params['producto']->ID ]['count'] += intval ( isset( $params['attr']['count'] ) ? $params['attr']['count'] : 1 );
    } else {
      $data[ $params['producto']->ID ] = array(
          'post'  => $params['producto']->to_array(),
          'count' => 1,
        );
    }
    $this->setData('productos', $data);
    $r['error'] = 0;
    return $r;
  }

  public function filters_responseProductoAdd( $r, $params ) {
    if( $r['error'] == 0 ): 
      ?><div id="simpleMercado_callback"><?php echo smShortcode::init()->producto(array( 'producto_id' => $params['producto']->ID, 'contenido_before' => '<div class="addCarrito">Agregado al carrito :D</div>' )); ?></div><?php 
    else: 
      ?><div id="simpleMercado_callback"><?php echo smShortcode::init()->producto(array( 'producto_id' => $params['producto']->ID, 'contenido_before' => '<div class="addCarrito">Error: '.$r['txt'].' </div>' )); ?></div><?php 
    endif;
    smCore::load( 'carrito/callback_ajax_iframe', 
                  smConfig::get('dir_templates'), 
                  $ext = '.php', 
                  array(
                    'desde' => '#simpleMercado_callback',
                    'parent_to' => '#id_'.$params['code'],
                  )
                );
/**/
    $r['exit'] = 1;
    return $r;
  }

  public function validateInteraction() {
    if( ! isset($_GET['_sm_action']) )       return false;
    if( ! isset($_GET['_sm_code']) )         return false;
    if( ! isset($_GET['_sm_producto_id']) )  return false;
    $t = substr($_GET['_sm_code'], 5);
    $pos = strpos( $t, '_' );
    if( $pos === false ) return false;
    $producto_id = substr($t, 0, $pos);
    if( $producto_id != $_GET['_sm_producto_id'] )  return false;
    $t_code = substr( $_GET['_sm_code'], ( 6 + $pos ) );
    if( strlen( $t_code ) > 6 ) return false;
    if( strlen( $t_code ) < 2 ) return false;
    if( intval( $t_code ) > 999999 ) return false;
    if( intval( $t_code ) < 99 ) return false;
    $code_nonce = $_GET['_sm_code'];
    if( ! isset( $_POST[ $code_nonce.'_nonce'] ) ) return false;
    if( ! wp_verify_nonce( $_POST[ $code_nonce.'_nonce' ], $code_nonce ) ) return false;

    $post = get_post( $producto_id );
    if ( !$post ) return false;
    if( get_post_type($post) != 'sm_producto' ) return false;
  
    $attr = isset( $_POST['_sm_attr'] ) ? $_POST['_sm_attr'] : array();

    return array( 
      'code'     => $_GET['_sm_code'],
      'action'   => $_GET['_sm_action'],
      'producto' => $post,
      'attr'     => $attr
    );
  }

  static public function init() {
    new self();
  } 

} 