<?php
global $post;
//var_dump($post);
switch($post->post_type) {

  case 'post':
  break;
  case 'page':
    if( $post->ID == smConfig::get('paginas/home', null) ) {
      $attr[0] = '[smHome]' . $attr[0];
    }
  break;
  case 'sm_producto':
      if( !is_archive() ) {
        $orden = smConfig::get('producto/galeria', 'antes');
        if( $orden == 'antes' )        $attr[0] = '[smGaleria producto_id="'.$post->ID.'"]' . $attr[0];
        else if( $orden == 'despues' ) $attr[0] = $attr[0] . '[smGaleria producto_id="'.$post->ID.'"]';

      }
      $orden = smConfig::get('producto/boton', 'despues');
      if( $orden == 'antes' )        $attr[0] = '[smAddBtn producto_id="'.$post->ID.'"]' . $attr[0];
      else if( $orden == 'despues' ) $attr[0] = $attr[0] . '[smAddBtn producto_id="'.$post->ID.'"]';

  break;
  case 'sm_carro':
  break;
  default:
    // code
  break;

}

return $attr[0];


