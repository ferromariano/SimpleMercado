<?php

/**
* 
*/
class smAdmin
{
  function __construct() {
    if( smConfig::get('estado') != 1 ) {
      add_action( 'admin_menu', array( &$this, 'addMenuInit' ) );
      add_action( 'admin_notices', array( &$this, 'alertConfig' ));
    } else {
      add_action( 'admin_menu', array( &$this, 'addMenu' ) );
    }
  }
  public function alertConfig() {
    global $hook_suffix;
      if ( $hook_suffix == 'plugins.php' ) {
      smCore::load('admin/slot_alerta_habilitado', 
                    smConfig::get('dir_templates'), 
                    $ext = '.php'
                    );    
        }    
  }
  public function addMenuInit() {
    add_menu_page( 'Aver', // $page_title, 
                   'SimpleMercado', // $menu_title, 
                   'manage_options', // capability
                   'simpleMercado/rapido', // $menu_slug
                   array(&$this, 'actionRapido'), // $function
                   '', //  $icon_url
                   61 //  $position
                   );
  }

  public function addMenu() {
    add_menu_page( 'Aver', // $page_title, 
                   'SimpleMercado', // $menu_title, 
                   'manage_options', // capability
                   'simpleMercado/index', // $menu_slug
                   array( $this, 'actionConfiguracion' ), // $function
                   '', //  $icon_url
                   61 //  $position
                   );    

    add_submenu_page('simpleMercado/index', 'Home',     'Home',     'manage_options', 'simpleMercado/home',     array(&$this, 'actionHome'));
    add_submenu_page('simpleMercado/index', 'Producto', 'Producto', 'manage_options', 'simpleMercado/producto', array(&$this, 'actionProducto'));
    add_submenu_page('simpleMercado/index', 'Carrito',  'Carrito',   'manage_options', 'simpleMercado/pedido',   array(&$this, 'actionPedido'));


    add_submenu_page('simpleMercado/index', 'Envios', 'Envios', 'manage_options', 'simpleMercado/envios', array(&$this, 'actionEnvios'));
    add_submenu_page('simpleMercado/index', 'Rapido y al paso', 'Rapido y al paso', 'manage_options', 'simpleMercado/rapido', array(&$this, 'actionRapido'));
    add_submenu_page('simpleMercado/index', 'Programador', 'Programador', 'manage_options', 'simpleMercado/programador', array(&$this, 'actionProgramador'));

  }

  public function actionProgramador() {
    smCore::load('admin/helper', smConfig::get('dir_templates'), $ext = '.php');    
  }

  public function actionProducto() {
    $attr = array();
    self::$data = smConfig::gets(array(
      'producto/boton'           => 'antes',
      'producto/galeria'         => 'despues',
      'producto/relacionados'    => '0',
      'producto/custom/cantidad' => '0',
      ));
    if( isset( $_POST['smAdminProducto_nonce'] ) && wp_verify_nonce( $_POST['smAdminProducto_nonce'], 'smAdminProducto' ) ) {
      if($this->actionProductoValidate()) {
        $this->actionProductoSave();
      } else { add_settings_error( 'actionPedidoSave', 'settings_updated', 'Fallo en validacion NONCE', 'error' ); }
    }

    smCore::load('admin/producto', smConfig::get('dir_templates'), $ext = '.php', $attr);    
  }
  public function actionProductoValidate() { return true; }
  public function actionProductoSave() {
    $data = $_POST['sm_rapido'];
    $t = array();
    foreach(self::$data as $k => $v) {
      if(isset( $data[$k] )) {
        self::$data[$k] = $data[$k];
      }
    }    
    smConfig::sets( self::$data );
    smConfig::save();
    add_settings_error( 'actionProductoSave', 'settings_updated', __( 'Successfully saved'), 'updated' );
  }





  public function actionConfiguracion() { 
    $attr = array();
    smCore::load('admin/index', smConfig::get('dir_templates'), $ext = '.php', $attr);
  }

  public function actionHome() { 
    $attr = array();
    self::$data = smConfig::gets(array(
      'home/mode'    => 'slider',
      'home/cat'     => 0,
      'paginas/home' => 0,
      ));
    if( isset( $_POST['smAdminHome_nonce'] ) && wp_verify_nonce( $_POST['smAdminHome_nonce'], 'smAdminHome' ) ) {
      if($this->actionHomeValidate()) {
        $this->actionHomeSave();
      } else { add_settings_error( 'actionPedidoSave', 'settings_updated', 'Fallo en validacion NONCE', 'error' ); }
    }

    smCore::load('admin/home', smConfig::get('dir_templates'), $ext = '.php', $attr);
  }
  public function actionHomeValidate() { return true; }
  public function actionHomeSave() { 
    $data = $_POST['sm_rapido'];
    $t = array();
    foreach(self::$data as $k => $v) {
      if(isset( $data[$k] )) {
        self::$data[$k] = $data[$k];
      }
    }
    switch( self::$data['home/mode'] ) {
      case 'slider':
        self::$data['home/cat'] = $data['home/cat_slide'];
      break;
      case 'listado':
        self::$data['home/cat'] = $data['home/cat_list'];
      break;
    }
    
    smConfig::sets( self::$data );
    smConfig::save();
    add_settings_error( 'actionHomeSave', 'settings_updated', __( 'Successfully saved'), 'updated' );
  }



  public function actionEnvios() { ?>Envios <?php
  }

  public function actionRapido() { 
    $attr = array();
    self::$data = smConfig::gets(array(
      'alerta_email' => get_bloginfo('admin_email'),
      'moneda_NOM'   => 'ARS',
      'moneda_SIM'   => '$',
      'txt_boton'    => '- Agregar al carrito -',
      'mode'         => 'carrito',
      'paginas_auto' => '1',
      'home/mode'    => 'slider',
      'paginas/carrito' => null,
      'paginas/blog' => null,
      'paginas/home' => null,
    ));

    if( isset( $_POST['smAdminRaipo_nonce'] ) && wp_verify_nonce( $_POST['smAdminRaipo_nonce'], 'smAdminRaipo' ) ) {
      if($this->actionRapidoValidate()) {
        $this->actionRapidoSave();
      } else { add_settings_error( 'actionPedidoSave', 'settings_updated', 'Fallo en validacion NONCE', 'error' ); }
    }
    
    smCore::load('admin/rapido', smConfig::get('dir_templates'), $ext = '.php', $attr);
  }

  public function actionRapidoValidate() { return true; }

  public function actionRapidoSave() {
    $data = $_POST['sm_rapido'];
    $t = array();
    foreach(self::$data as $k => $v) {
      if(isset( $data[$k] )) {
        self::$data[$k] = $data[$k];
      }
    }

    if( smAdmin::get('paginas_auto', false) == 1) {
      if( !isset( self::$data['paginas/carrito'] ) ) {
        $post = array( 'post_content' => '[smCarrito]', 'post_name' => 'Carrito', 'post_title' => 'Carrito', 'post_status' => 'publish', 'post_type' => 'page', 'ping_status' => 'closed', 'comment_status' => 'closed' );  
        self::$data['paginas/carrito'] = wp_insert_post( $post );
      }
      if( !isset( self::$data['paginas/blog'] ) ) {
        $post = array( 'post_content' => '', 'post_name' => 'Blog', 'post_title' => 'Blog', 'post_status' => 'publish', 'post_type' => 'page', 'ping_status' => 'closed', 'comment_status' => 'closed' );  
        self::$data['paginas/blog'] = wp_insert_post( $post );
      }
      if( !isset( self::$data['paginas/home'] ) ) {
        $post = array( 'post_content' => '', 'post_name' => 'Home', 'post_title' => 'Home', 'post_status' => 'publish', 'post_type' => 'page', 'ping_status' => 'closed', 'comment_status' => 'closed' );  
        self::$data['paginas/home'] = wp_insert_post( $post );
      }

      update_option( 'show_on_front',  'page', '', 'yes' );
      update_option( 'page_for_posts', self::$data['paginas/blog'], '', 'yes' );
      update_option( 'page_on_front',  self::$data['paginas/home'], '', 'yes' );

    }

//      update_option( 'page_for_posts', , '', 'yes' );
//      update_option( 'page_on_front',  , '', 'yes' );

    self::$data['estado']=1;

    smConfig::sets( self::$data );
    smConfig::save();
    add_settings_error( 'actionRapidoSave', 'settings_updated', __( 'Successfully saved'), 'updated' );
  }

  public function actionPedido() {
    $attr = array();
    self::$data = smConfig::gets(array(
      'mode'            => 'carrito',
      'paginas/carrito' => null,
      'moneda_NOM'      => 'ARS',
      'moneda_SIM'      => '$',
      'carrito/user/datos' => 0,
      'carrito/user/nombre' => 0,
      'carrito/user/apellido' => 0,
      'carrito/user/direccion' => 0,
      'carrito/user/email' => 0,
      'carrito/user/telefono' => 0,
      'carrito/user/telefono/celular' => 0,
      'carrito/user/aclaracion' => 0,
    ));

    if( isset( $_POST['actionPedido_nonce'] ) && wp_verify_nonce( $_POST['actionPedido_nonce'], 'actionPedido' ) ) {
      if($this->actionPedidoValidate()) {
        $this->actionPedidoSave();
      } else { add_settings_error( 'actionPedidoSave', 'settings_updated', 'Fallo en validacion NONCE', 'error' ); }
    }

    smCore::load('admin/pedido', smConfig::get('dir_templates'), $ext = '.php', $attr);    
  }
  public function actionPedidoValidate() { return true; }
  public function actionPedidoSave() {
    $data = $_POST['sm_rapido'];
    foreach(self::$data as $k => $v) {
      if(isset( $data[$k] )) {
        self::$data[$k] = $data[$k];
      }
    }

    smConfig::sets( self::$data );
    smConfig::save();
    add_settings_error( 'actionPedidoSave', 'settings_updated', __( 'Successfully saved'), 'updated' );    
  }

  /* STATIC */
  static $instance;
  public static function init() { self::$instance = new self(); }
  static public $data = array();
  static public function set($k, $v)      { self::$data[$k] = $v; }
  static public function get($k, $d=null) { return ( isset(self::$data[$k]) ? self::$data[$k] : $d ); } 

}