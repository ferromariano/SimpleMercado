<?php

class smFilter {
  
  static public $filters = array();

  function __construct() {}

  public function add($name) {
    add_filter( $name, array( $this, $name ) );
  }

  public function __call($n, $a) {
    return smCore::load( $n, smConfig::get('dir_filters'), '.php', $a, true );
  }

  public function autoLoad( $path = null ) {
    if( $path == null ) $path = smConfig::get('dir_filters');
    $dir = opendir( $path );
    while ($current = readdir($dir)) {

      if( $current == "." || $current == ".." || is_dir($path.$current) ) continue;
      if( !is_readable($path.$current) ) continue;
      if( substr($current, -3) != 'php' ) continue;
      $this->add( substr( basename($current), 0, -4) );
    }        
  }
  
  /* STATIC */  
  static public $instance = null;
  static public function init() {
    self::$instance = new self();
    self::$instance->autoLoad();
  }
}
