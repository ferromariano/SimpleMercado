<div class="wrap">
  
  <div id="icon-options-general" class="icon32"></div>
  <h2>Carrito</h2>
  <p></p>
  <?php settings_errors(); ?>
  <form method="post">
    <?php wp_nonce_field( 'actionPedido', 'actionPedido_nonce' ); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="blogname">Compra o pedido</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[mode]" value="carrito" <?php checked( smAdmin::get('mode', 'carrito'), 'carrito', true); ?>/> <span>Carrito</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[mode]" value="pedido" <?php checked( smAdmin::get('mode', ''), 'pedido', true); ?>/> <span>Pedido</span></label>
          </fieldset>
          <span class="description">En ves de vender, el carrito se tranforma en un pedido</span></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="blogname">Pagina de carrito</label></th>
        <td>
          <?php wp_dropdown_pages(array( 'name'     => 'sm_rapido[paginas/carrito]', 
                                         'selected' => smAdmin::get('paginas/carrito', 0) )); ?><br />
          <span class="description">Selecciona la pagina dodne esta el carrito</span></td>
      </tr>        
      <tr valign="top">
        <th scope="row"><label for="blogname">Moneda</label></th>
        <td><input name="sm_rapido[moneda_NOM]" type="text" value="<?php echo smAdmin::get('moneda_NOM', 'ARS'); ?>" class="regular-text" />
            <br /><span class="description">¿ Con que moneda vas a vender ? ej: ARS, USD, EUR, GBP, AUD</span></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="blogname">Simbolo de moneda</label></th>
        <td><input name="sm_rapido[moneda_SIM]" type="text" value="<?php echo smAdmin::get('moneda_SIM', '$'); ?>" class="regular-text" />
            <br /><span class="description">¿ Que simbolo es el de la moneda ? ej: $, £, €</span></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="blogname">Pedir datos al comprados</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[carrito/user/datos]" value="1" <?php checked( smAdmin::get('carrito/user/datos', '1'), '1', true); ?>/> <span>Si</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[carrito/user/datos]" value="0" <?php checked( smAdmin::get('carrito/user/datos', ''),  '0', true); ?>/> <span>No</span></label>
          </fieldset>
          <span class="description">En ves de vender, el carrito se tranforma en un pedido</span></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="blogname">Datos que se piden al comprador</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/nombre]" value="1" <?php           checked( smAdmin::get('carrito/user/nombre',          '0'), '1', true); ?>/> <span>Nombre  </span></label><br />
            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/apellido]" value="1" <?php         checked( smAdmin::get('carrito/user/apellido',        '0'), '1', true); ?>/> <span>Apellido  </span></label><br />
            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/direccion]" value="1" <?php        checked( smAdmin::get('carrito/user/direccion',       '0'), '1', true); ?>/> <span>Direccion  </span></label><br />

            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/email]" value="1" <?php            checked( smAdmin::get('carrito/user/email',           '0'), '1', true); ?>/> <span>Email  </span></label><br />
            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/telefono]" value="1" <?php         checked( smAdmin::get('carrito/user/telefono',        '0'), '1', true); ?>/> <span>Telefono  </span></label><br />
            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/telefono/celular]" value="1" <?php checked( smAdmin::get('carrito/user/telefeno/celuar', '0'), '1', true); ?>/> <span>Telefono Celular  </span></label><br />

            <label title='g:i a'><input type="checkbox" name="sm_rapido[carrito/user/aclaracion]" value="1" <?php       checked( smAdmin::get('carrito/user/alcaracion',      '0'), '1', true); ?>/> <span>Aclaracion  </span></label><br />

          </fieldset>
          <span class="description">En ves de vender, el carrito se tranforma en un pedido</span></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="blogname"></label></th>
        <td>
          <span class="description"></span></td>
      </tr>        

    </table>
    <p>
      <input class="button-primary" type="submit" name="Example" value="<?php _e( 'Save' ); ?>" /> 
    </p>

  </form>  
  <pre><?php var_dump( smAdmin::$data ); ?></pre>

</div> <!-- .wrap -->