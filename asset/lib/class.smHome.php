<?php 

/**
* 
*/
class smHome
{
  function __construct() {
    var_dump( 'asdsadsadasd' );
    if(is_home())
      var_dump( 'asdsadsadasd 1' );
    if( smConfig::get('home/mode') != 'none' )
      var_dump( 'asdsadsadasd 2 ' );

    if(is_home() && smConfig::get('home/mode') != 'none' ) {
    var_dump( 'asdsadsadasd' );
      add_filter('the_content', array( $this, 'filters_actionProductoAdd' ) , 9, 1);
    }
  }
  /**
   * remplaza el contenido de la home si asi esta especificado en smConfig[home/mode]
   *
   * @return str
   **/
  public function filter_the_content($c) { return '[smHome]'; }
  /* STATIC */
  /**
   * almacena la instancia de la clase
   *
   * @var class smCarro
   **/
  static private $instance=null;
  /**
   * devuelve instancia de smHome
   *
   * @return class smCarro
   **/
  static public function getInstance() { return self::$instance; }  
  /**
   * instancia y devuelve, instancia de smHome
   *
   * @return class smHome
   **/
  static public function init() {
    if( is_admin() ) return null;
    if( self::getInstance() == null ) self::$instance = new self();
    return self::$instance;
  } 
}