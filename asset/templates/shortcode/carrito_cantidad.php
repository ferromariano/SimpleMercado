<div class="simple_mercado_cantidad">
  <div id="id_<?php echo $attr['code']; ?>">
    <?php 
      echo tag( 'form',
                array(
                  'target'  => '_sm_iframe_'.$attr['code'],
                  'method'  => 'post',
                  'action'   => add_query_arg( array( '_sm_action' => 'change_count',
                                                      '_sm_code'   => $attr['code'],
                                                      '_sm_producto_id' => $attr['producto_id'] ),
                                               get_permalink( $attr['producto_id'] ) ),
                  )
              );
      wp_nonce_field( $attr['code'], $attr['code'].'_nonce' );
      echo tag( 'input',
                array(  'type'  => 'number',
                        'name'  => '_sm_attr[count]',
                        'min'   => 1,
                        'value' => 1 )); ?>
    </form>
    <iframe name="_sm_iframe_<?php echo $attr['code']; ?>" width="400" height="600"></iframe>
  </div>
</div>