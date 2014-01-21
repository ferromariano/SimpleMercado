<?php

class smShortcode
{
  
  function __construct() {
    add_shortcode( 'smHome', array( $this, 'smHome' ) );
    add_shortcode( 'smSlider',     array( $this, 'slider' ) );
    add_shortcode( 'smListado',     array( $this, 'listado' ) );
    // un producto comun y corriente
    add_shortcode( 'smAddBtn', array( $this, 'producto' ) );
    // un procuto que no tiene necesariamente un pagina sino un producto producido para un evento unico.
    add_shortcode( 'producto_virtual', array( $this, 'producto' ) );

    add_shortcode( 'smGaleria', array( $this, 'galeria' ) );
    add_shortcode( 'smCarrito', array( $this, 'carrito' ) );

  }

  function smHome($attr) {
    $r = '';
    switch ( smConfig::get('home/mode', null) ) {
      case 'slider':
        $r = $this->slider(array( 'cat' => smConfig::get('home/cat', '-1') ));
      break;
      case 'listado':
        $r = $this->listado(array( 'cat' => smConfig::get('home/cat', '-1') ));
      break;
      default:
      break;
    }
    return $r;
  }
  function slider($attr)     {
    ob_start();
      echo "Slider | CAT:".$attr['cat'];
    return ob_get_clean();
  }
  function listado($attr)     {
    ob_start();
      echo "Listado | CAT: ".$attr['cat'];
    return ob_get_clean();
  }

  function producto($attr) {
    $attr['code'] = 'prod_'.$attr['producto_id'].'_'.rand(99, 999999);
    ob_start();
    smCore::load('shortcode/carrito_btn_add', smConfig::get('dir_templates'), $ext = '.php', $attr);
    return ob_get_clean();
  }

  function galeria($attr) {
    ob_start();
      echo "galeria | ID: ".$attr['producto_id'];
    return ob_get_clean();
  }

  function carrito($attr) {
    $attr['carro/productos'] = smCarro::getInstance()->getProductos();
    $attr['carro/subtotal']  = smCarro::getInstance()->getSubTotal();
    $attr['carro/total']     = smCarro::getInstance()->getTotal();
    $attr['form/code']              = rand(1, 99);
    $attr['form/contenido_prepend'] = '';
    $attr['form/contenido_append']  = '';



    $attr = apply_filters( 'simpleMercado_shortcode_carrito_attr', $attr );
    ob_start();      
      smCore::load('shortcode/carrito', smConfig::get('dir_templates'), $ext = '.php', $attr);    
    return ob_get_clean();
  }

  /* STATIC */  
  static public $instance = null;
  static public function init() {
    if(self::$instance==null) return self::$instance = new self();
    return self::$instance;
  }
}