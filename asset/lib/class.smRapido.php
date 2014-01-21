<?php

/**
* 
*/
class smRapido
{
  
  function __construct() {
   add_action( 'admin_menu', array( &$this, 'addMenu' ) );
  }
}