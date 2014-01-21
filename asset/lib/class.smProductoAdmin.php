<?php 

class smProductoAdmin extends smProducto
{
  
  function __construct($post) {
    parent::__construct($post);
  }
  
  public function addMetaBox() {
    add_meta_box( 'smProductoAdmin_Config_Basica',   'Configuracion del Producto',          array( $this, 'boxConfiguracionBasica' ),   'sm_producto', 'normal', 'high' );
//    add_meta_box( 'smProductoAdmin_Config_Avanzada', 'Configuracion del Producto Avanzada', array( $this, 'boxConfiguracionAvanzada' ), 'sm_producto', 'normal', 'high' );
//    add_meta_box( 'smProductoAdmin_Galeria',         'Galeria',                             array( $this, 'boxGaleria' ),               'sm_producto', 'normal', 'high' );
  }

  public function boxConfiguracionBasica( $post )   { wp_nonce_field( 'boxConfiguracionBasica', 'boxConfiguracionBasica_nonce' );     echo "@HACER: CLASS.Template\Config :D"; 
    ?><input name="_sm_producto[precio]" value="<?php echo $this->get('precio'); ?>" /><?php
  }

  public function boxConfiguracionAvanzada( $post ) { wp_nonce_field( 'boxConfiguracionAvanzada', 'boxConfiguracionAvanzada_nonce' ); echo "@HACER: CLASS.Template\ConfigAvanzada :D";  }

  public function boxGaleria( $post )               { wp_nonce_field( 'boxGaleria', 'boxGaleria_nonce' );                             echo "@HACER: CLASS.Template\Galeria :D"; }

  public function savePost($post_id) { 
    if ( ! isset( $_POST['post_type'] ) ) return $post_id;
    if ( 'sm_producto' != $_POST['post_type'] ) return $post_id;
    if ( ! isset( $_POST['boxConfiguracionBasica_nonce'] ) ) return $post_id;
    $nonce = $_POST['boxConfiguracionBasica_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'boxConfiguracionBasica' ) ) return $post_id;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
    $this->set('precio', sanitize_text_field( $_POST['_sm_producto']['precio'] ) );
    $this->saveData();
  }

  /* STATIC's */


}