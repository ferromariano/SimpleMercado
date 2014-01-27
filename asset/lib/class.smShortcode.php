<?php

class smShortcode
{
  
  function __construct() {
    add_shortcode( 'smHome', array( $this, 'smHome' ) );
    add_shortcode( 'smSlider',     array( $this, 'slider' ) );
    add_shortcode( 'smListado',     array( $this, 'listado' ) );
    // un producto comun y corriente
    add_shortcode( 'smAddBtn', array( $this, 'producto' ) );
    add_shortcode( 'smCantidad', array( $this, 'productoCantidad' ) );
    // un procuto que no tiene necesariamente un pagina sino un producto producido para un evento unico.
    add_shortcode( 'producto_virtual', array( $this, 'producto' ) );

    add_shortcode( 'smGaleria', array( $this, 'galeria' ) );
    add_shortcode( 'smCarrito', array( $this, 'carrito' ) );

  }

  function smHome($attr) {
    $r = '';
    switch ( smConfig::get('home/mode', null) ) {
      case 'slider':  $r = $this->slider(  array( 'cat' => smConfig::get('home/cat', '-1') ) );  break;
      case 'listado': $r = $this->listado( array( 'cat' => smConfig::get('home/cat', '-1') ) ); break;
      default: break;
    }
    return $r;
  }
  function slider($attr)     {
    if( ! isset($attr['cat']) || $attr['cat'] <= 0 ) return '';

    wp_enqueue_script('bxslider');
    wp_enqueue_style('bxslider');

//    $posts = ;
    if( !is_archive() || ! is_category() || !is_tax() ) {
      global $wp_query; 
      $wp_query = new WP_Query( array(
        'post_type'      => 'sm_producto',
        'posts_per_page' => '-1',
        'no_found_rows'  => true,
        'post_status'    => 'publish',
        'tax_query'      => array(
          array(
            'taxonomy' => 'sm_categoria',
            'terms'    => $attr['cat'],
            'field'    => 'id',
          ),
        ),
      ) );
    }
//    $wp_query = $wp_query_;

    ob_start(); 
      smCore::load('shortcode/slider', smConfig::get('dir_templates'), $ext = '.php', $attr);
      wp_reset_query();

      echo get_the_title();

    return ob_get_clean();
  }
  function listado($attr)     {
    ob_start(); echo "Listado | CAT: ".$attr['cat']; return ob_get_clean();
  }

  function producto($attr) {
    $attr['code'] = 'prod_'.$attr['producto_id'].'_'.rand(99, 999999);
    ob_start();
      smCore::load('shortcode/carrito_btn_add', smConfig::get('dir_templates'), $ext = '.php', $attr);
    return ob_get_clean();
  }
  function productoCantidad($attr) {
    $attr['code'] = 'prod_'.$attr['producto_id'].'_'.rand(99, 999999);
    ob_start();
      smCore::load('shortcode/carrito_cantidad', smConfig::get('dir_templates'), $ext = '.php', $attr);
    return ob_get_clean();
  }


  function galeria($attr) {
    ob_start(); echo "galeria | ID: ".$attr['producto_id']; return ob_get_clean();
  }

  function carrito($attr) {

    ob_start();
    apply_filters( 'simpleMercado_carro_page_response', '' );
    $r = ob_get_clean();
    if( $r != '' ) return $r;    
    
    $smCarroCheckOut = smCarroCheckOut::init();

    $attr['carro/productos']        = $smCarroCheckOut->getProductos();
    $attr['carro/subtotal']         = $smCarroCheckOut->getSubTotal();
    $attr['carro/total']            = $smCarroCheckOut->getTotal();
    $attr['form/code']              = rand(1, 99);
    $attr['form/contenido_prepend'] = '';
    $attr['form/contenido_append']  = '';

    ob_start();      
      smCore::load( 'shortcode/carrito', 
                    smConfig::get('dir_templates'), 
                    $ext = '.php', 
                    apply_filters( 'simpleMercado_shortcode_carrito_attr', $attr ) 
                  );
    return ob_get_clean();
  }

  /* STATIC */  
  static public $instance = null;
  static public function init() {
    if(self::$instance==null) return self::$instance = new self();
    return self::$instance;
  }
}