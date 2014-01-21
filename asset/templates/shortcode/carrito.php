<form class="comment-form">
  <?php wp_nonce_field( $attr['form/code'], $attr['form/code'].'_nonce' ); 
       echo apply_filters( 'simpleMercado_carrito_form_prepend', ( isset( $attr['form/contenido_prepend'] ) ? $attr['form/contenido_prepend'] : '' ) ); ?>
  <div class="row table_productos">
    <h2>Tu pedido</h2>
    <table>
      <thead>
          <tr><th>Producto</th><th>Cantidad</th><th>Unidad</th><th>Total</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ( $attr['carro/productos'] as $v ): ?>
        <tr>
          <td class="row_name"><h3><?php echo $v['name'] ?></h3><br /><?php echo $v['desc'] ?></td>
          <td class="row_count"><input type="number" value="<?php echo $v['count']; ?>" /></td>
          <td class="row_per_unidad"><?php echo smConfig::get('moneda_SIM').' '.$v['unidad']; ?> </td>
          <td class="row_total"><?php      echo smConfig::get('moneda_SIM'); ?> <span><?php echo $v['total']; ?></span> </td>
          <td class="row_action_eliminar"><a href="#">Eliminar</a></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>

  <div class="row table_total">
    <table>
      <tbody>
        <tr class="row_subtotal"><th>Sub total:</th><td><?php echo smConfig::get('moneda_SIM'); ?> <span><?php echo $attr['carro/subtotal'] ?></span></td></tr>
        <tr class="row_total"><th>Total:</th><td><?php        echo smConfig::get('moneda_SIM'); ?> <span><?php echo $attr['carro/total'] ?></td></tr>
      </tbody>
    </table>
  </div>

  <h2>Tus datos</h2>
  <div class="row"><?php
    if( smConfig::get('carrito/user/nombre', 0) ):           ?><div class="row"><label>Nombre:</label>     <?php echo tag('input', array('type'=>'text',  'name' => '', 'placeholder' => 'Tu Nombre') );    ?></div><?php endif;
    if( smConfig::get('carrito/user/apellido', 0) ):         ?><div class="row"><label>Apellido:</label>   <?php echo tag('input', array('type'=>'text',  'name' => '', 'placeholder' => 'Tu Apellido') );  ?></div><?php endif;
    if( smConfig::get('carrito/user/email', 0) ):            ?><div class="row"><label>Email:</label>      <?php echo tag('input', array('type'=>'email', 'name' => '', 'placeholder' => 'Tu Email') );     ?></div><?php endif;
    if( smConfig::get('carrito/user/direccion', 0) ):        ?><div class="row"><label>Direccion:</label>  <?php echo tag('input', array('type'=>'text',  'name' => '', 'placeholder' => 'Tu Direccion') ); ?></div><?php endif;
    if( smConfig::get('carrito/user/telefono', 0) ):         ?><div class="row"><label>Telefono:</label>   <?php echo tag('input', array('type'=>'tel',   'name' => '', 'placeholder' => 'Tu Telefono') );  ?></div><?php endif;
    if( smConfig::get('carrito/user/telefono/celular', 0) ): ?><div class="row"><label>Celular:</label>    <?php echo tag('input', array('type'=>'tel',   'name' => '', 'placeholder' => 'Tu Celular') );   ?></div><?php endif;
    if( smConfig::get('carrito/user/aclaracion', 0) ):       ?><div class="row"><label>Aclaracion:</label> <?php echo tag('textarea', array( 'name' => '', 'placeholder' => 'Aclaraciones') ) ?></textarea></div><?php endif; ?>
  </div>

  <?php if( smConfig::get('mode') == 'carrito' ): ?>
    <h2>Medio de pago</h2>
    <div class="row">
    </div>
  <?php else: ?>
    <div class="row submit">
      <input type="submit" value="Pedir" />
    </div>
  <?php endif; ?>
  <?php echo apply_filters( 'simpleMercado_carrito_form_append', ( isset($attr['form/contenido_append']) ? $attr['form/contenido_append'] : '' ) ); ?>
</form>