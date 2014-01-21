<?php

class smAction {
	
	static public $actions = array();

	function __construct() {}

	public function add($name) {
		add_action( $name, array( $this, $name ) );
	}

  public function __call($n, $a) {
    smCore::load( $n, smConfig::get('dir_actions'), '.php', $a );
  }

  public function autoLoad( $path = null ) {
    if( $path == null ) $path = smConfig::get('dir_actions');
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
  static public function initFix() { // init tambien es una funcion de WP XD
    self::$instance = new self();
    self::$instance->autoLoad();
  }
}
