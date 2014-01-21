<?php 

class smCore {

	function __construct() {
    smConfig::init();
    $this->dirs();
    if(!$this->checkDeps()) return;

    function __autoload($n) { smLog::set('__autoload', 'CLASS: '.$n); smCore::load( 'class.' . $n, smConfig::get('dir_lib') ); }

    $this->libs();

    smConfig::set('debug', WP_DEBUG );
    smConfig::set('debug', false );

    register_activation_hook( smConfig::get('dir_includes').'instalacion.php', 'smInstalacion' );
	}

  public function libs() {
    self::loadIncludes( 'autoload' );
    self::loadIncludes( 'helpers' );
    if(!is_admin()) {
      smCarro::init();
    }
  }

  public function dirs() {
    smConfig::set('dir_base',      realpath(dirname(__FILE__).'/../..') );
    smConfig::set('dir_css',       smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR);
    smConfig::set('dir_js',        smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR);
    smConfig::set('dir_includes',  smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR);
    smConfig::set('dir_lib',       smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
    smConfig::set('dir_templates', smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
    smConfig::set('dir_actions',   smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR);
    smConfig::set('dir_filters',   smConfig::get('dir_base') . DIRECTORY_SEPARATOR . 'asset' . DIRECTORY_SEPARATOR . 'filters' . DIRECTORY_SEPARATOR);
  }

	static public function load($n, $dir=null, $ext = '.php', $attr = array(), $r = false) {
    $file = $n .'.php';
    $f = apply_filters('sm_core/load/file/'.$n, $file );
    if( $file == $f ) 
      $f = ( $dir == null ? smConfig::get('dir_lib') : $dir ) . $f;
		
    if( is_file( $f ) ) { smLog::set('smCore::load', 'Se cargo ' . $f ); 
      if( $r ) return include $f;
                 else include $f;
    }
    else { smLog::set('smCore::load', 'No se encontro '.$f); if(smConfig::get('debug', WP_DEBUG ))  trigger_error( $n.' no fue encontrado en '.$f ); }
	}

  static public function loadIncludes($n) {
    smCore::load( $n, smConfig::get('dir_includes') );
  }

  private function checkDeps() {
    if( smConfig::get('estado') == 1 ) return true;

    smCore::load( 'class.smAdmin', smConfig::get('dir_lib') );
    smAdmin::init();
    return false;
  }

}

class smConfig {
	static public $data = array();
	static public function set($k, $v)      { self::$data[$k] = $v; }
  static public function get($k, $d=null) { return ( isset(self::$data[$k]) ? apply_filters( 'sm_config/get/'.$k , self::$data[$k] )  : 
                                                                              apply_filters( 'sm_config/get/'.$k , $d ) ); } 

  static public function sets($vs) { $r=array(); foreach($vs as $k => $d) { self::set($k, $d); } } 
  static public function gets($vs) { $r=array(); foreach($vs as $k => $d) { $r[$k] = self::get($k, $d); } return $r; } 

  static public function init() { 
//    update_option( '_smConfig', serialize( ( array() ) ), '', 'yes' );
    self::$data = unserialize( get_option( '_smConfig', serialize( array() ) ) );
  } 
  static public function save( $d=null ) { 
    update_option( '_smConfig', serialize( ( isset($d) ? $d : self::$data ) ), '', 'yes' );
  } 

}


class smLog {
  static public $data = array();
  static public function set($n, $m='')      { self::$data[] = array( 'n' => $n, 'm' => $m, 'time' => time() ); }
  static public function printer() {
    ?>
    <style type="text/css">
    #smLog { background-color: #FFF;
color: #000;
border: 1px solid;
padding: 11px; width: 100%;
z-index: 99999999999999999999;
position: relative; }
  #smLog tr {  }
  #smLog th { line-height: 240%;   }
 #smLog tr:nth-child(2n+1) {
background-color: #ddd;
}
    </style>
    <?php
    echo '<table id="smLog">';
    foreach(self::$data as $d) {
      echo '<tr>';
      echo '<th>'.$d['n'].'</th>';
      echo '<td>';
      if( is_string($d['m']) ) echo $d['m'];
      else var_dump($d['m']);
      echo '</td>';
      echo '<td>'.$d['time'].'</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
}


















