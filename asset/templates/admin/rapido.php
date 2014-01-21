<div class="wrap">
  
  <div id="icon-options-general" class="icon32"></div>
  <h2>Rapido y al paso, es esta configuracion</h2>
  <?php settings_errors(); ?>
  <form method="post">
    <?php wp_nonce_field( 'smAdminRaipo', 'smAdminRaipo_nonce' ); ?>
    <div id="paso1">
      <h3>¿ Donde y quien ?</h3>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="blogname">Email</label></th>
          <td><input name="sm_rapido[alerta_email]" type="text" value="<?php echo smAdmin::get('alerta_email', get_bloginfo('admin_email')); ?>" class="regular-text" /> <span class="description">A quien le aviso cuando alguien compra, dame su Email</span></td>
        </tr>        
        <tr valign="top">
          <th scope="row"><label for="blogname">Moneda</label></th>
          <td><input name="sm_rapido[moneda_NOM]" type="text" value="<?php echo smAdmin::get('moneda_NOM', 'ARS'); ?>" class="regular-text" /> <span class="description">¿ Con que moneda vas a vender ? ej: ARS, USD, EUR, GBP, AUD</span></td>
        </tr>        
        <tr valign="top">
          <th scope="row"><label for="blogname">Simbolo de moneda</label></th>
          <td><input name="sm_rapido[moneda_SIM]" type="text" value="<?php echo smAdmin::get('moneda_SIM', '$'); ?>" class="regular-text" /> <span class="description">¿ Que simbolo es el de la moneda ? ej: $, £, €</span></td>
        </tr>
      </table>
      <a class="Siguiente" href="#">Siguiente</a>
    </div>
    <div id="paso2">
      <h3>Como me muestro</h3>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="blogname">Texto del boton comprar</label></th>
          <td><input name="sm_rapido[txt_boton]" type="text" value="<?php echo smAdmin::get('txt_boton', 'Agregar al carrito'); ?>" class="regular-text" /> <span class="description">Cada cual, como quiera. ej: "Agregar al carrito"</span></td>
        </tr>        
        <tr valign="top">
          <th scope="row"><label for="blogname">Home</label></th>
          <td>
            <fieldset>
              <label title='g:i a'><input type="radio" name="sm_rapido[home/mode]" value="slider"  <?php checked( smAdmin::get('home/mode', 'slider'), 'slider', true);  ?>/> <span>Carrucel de productos</span></label><br />
              <label title='g:i a'><input type="radio" name="sm_rapido[home/mode]" value="listado" <?php checked( smAdmin::get('home/mode', ''),       'listado', true); ?>/> <span>Listado de productos</span></label>
              <label title='g:i a'><input type="radio" name="sm_rapido[home/mode]" value="none"    <?php checked( smAdmin::get('home/mode', ''),       'none', true);    ?>/> <span>Pedido</span></label>
            </fieldset>
            <span class="description">¿ Que queres ver en la home ?</span></td>
        </tr>        
      </table>
      <a class="Siguiente" href="#">Siguiente</a>
    </div>
    <div id="paso3">
      <h3>¿ Como me funciono ?</h3>
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
      </table>
      <a class="Siguiente" href="#">Siguiente</a>
    </div>
    <div id="paso4">
      <h3>Paginas</h3>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="blogname">Paginas del Mercado</label></th>
          <td>
            <fieldset>
              <label title='g:i a'><input type="radio" name="sm_rapido[paginas_auto]" value="1" <?php checked( smAdmin::get('paginas_auto', '1'), '1', true); ?>/> <span>Crear automaticamente</span></label><br />
              <label title='g:i a'><input type="radio" name="sm_rapido[paginas_auto]" value="2" <?php checked( smAdmin::get('paginas_auto', ''), '2', true); ?>/> <span>No crearlas</span></label>
            </fieldset>
            <span class="description">Cada mercado tiene pagians especificas como el carrito, la pagina de gracias por comprar, consultas</span></td>
        </tr>        
      </table>
      <p>
        <input class="button-primary" type="submit" name="Example" value="<?php _e( 'Save' ); ?>" /> 
      </p>
    </div>
  </form>  
  <pre><?php var_dump( smAdmin::$data ); ?></pre>

  
</div> <!-- .wrap -->