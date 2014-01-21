<?php 

/**
* smProducto
*/
class smProducto
{
  private $post=null;
  private $data=null;

  function __construct($post) {
    $this->setPost($post);
  }
  public function getPost() {
    return $this->post;
  }
  private function setPost($post) {
    if( $post == null ) return;
    $this->post = $post;
    $this->loadData();
  }
  public function loadData() { 
    $t = get_post_meta( $this->post->ID, '_smProducto', true);
    $t = @unserialize($t);
    if ( ! is_array($t) ) { $t = array(); }
    $this->data = $t;
  }
  public function get($k, $d=null) { return isset($this->data[$k]) ? $this->data[$k] : $d;  }
  public function set($k, $v)      { $this->data[$k] = $v; } 
  public function saveData() { 
    update_post_meta( $this->post->ID, '_smProducto', serialize( $this->data ) );
  }

  /* STATIC's */
  static public function init($post=null) {
    if( $post == null ) global $post;
    return new smProductoAdmin($post);    
  }
  static public function initByID($id) {
    $post = get_post( $id );
    return self::init( $post );
  }
}