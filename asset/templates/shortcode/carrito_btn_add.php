<div class="simple_mercado_btn_add">
  <div id="id_<?php echo $attr['code']; ?>">
    <?php echo apply_filters( 'simpleMercado_boton_add_carrito_before', ( isset($attr['contenido_before']) ? $attr['contenido_before'] : '' ) ); ?>        
    <form target="_sm_iframe_<?php echo $attr['code']; ?>" method="post" action="<?php echo add_query_arg( array( '_sm_action' => 'add_carro', '_sm_code' => $attr['code'], '_sm_producto_id' => $attr['producto_id'] ), get_permalink( $attr['producto_id'] ) ); ?>">
      <?php wp_nonce_field( $attr['code'], $attr['code'].'_nonce' ); 
      echo apply_filters( 'simpleMercado_boton_add_carrito_form_prepend', '' );
      if( smConfig::get('producto/custom/cantidad') ): 
        echo tag( 'input', 
                  array(  'type'  => 'number', 
                          'name'  => '_sm_attr[count]', 
                          'min'   => 1, 
                          'value' => 1 ));
      endif;
      echo tag('input', apply_filters( 'simpleMercado_boton_add_carrito_attr', array( 'type' => 'submit', 'value' => smConfig::get('txt_boton') )) );
      echo apply_filters( 'simpleMercado_boton_add_carrito_form_append', '' ); ?>        
    </form>
    <?php echo apply_filters( 'simpleMercado_boton_add_carrito_after', ( isset($attr['contenido_after']) ? $attr['contenido_after'] : '' ) ); ?>        

    <iframe name="_sm_iframe_<?php echo $attr['code']; ?>" width="400" height="600"></iframe>
  </div>
</div>