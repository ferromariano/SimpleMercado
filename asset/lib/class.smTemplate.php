<?php

class smTemplate
{
  
  function __construct() {
//    add_filter( 'archive_template', array( $this, 'archive' ) );
//    add_filter( 'taxonomy_template', array( $this, 'taxonomy' ) );
  }

  public function archive( $template ) { 
    return smConfig::get('dir_templates').'temple'. DIRECTORY_SEPARATOR.'category.php';
  }

  public function taxonomy( $template ) {
    return smConfig::get('dir_templates').'temple'. DIRECTORY_SEPARATOR.'category.php';
  }
  /* STATIC */  
  static public $instance = null;
  static public function init() { // init tambien es una funcion de WP XD
    self::$instance = new self();
  }

 
}