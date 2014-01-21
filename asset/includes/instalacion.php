<?php

function smInstalacion() {

  $post = array( 'post_content' => '[smCarrito]', 'post_name' => 'Carrito', 'post_title' => 'Carrito', 'post_status' => 'publish', 'post_type' => 'page', 'ping_status' => 'closed', 'comment_status' => 'closed' );  
  $page_carrito_id = wp_insert_post( $post );

  add_option( '_smConfig', serialize( array( 'estado' => 0, 'paginas/carrito' => $page_carrito_id ) ), '', 'yes' );

}