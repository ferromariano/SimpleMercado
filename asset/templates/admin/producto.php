<div class="wrap">
  
  <div id="icon-options-general" class="icon32"></div>
  <h2>Configurando Producto</h2>
  <p></p>
  <?php settings_errors(); ?>
  <form method="post">
    <?php wp_nonce_field( 'smAdminProducto', 'smAdminProducto_nonce' ); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="blogname">Boton de agregar al carrito</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/boton]" value="antes"  <?php checked( smAdmin::get('producto/boton', 'antes'), 'antes', true);  ?>/> <span>Antes</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/boton]" value="despues" <?php checked( smAdmin::get('producto/boton', ''),       'despues', true); ?>/> <span>Despues</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/boton]" value="none"    <?php checked( smAdmin::get('producto/boton', ''),       'none', true);    ?>/> <span>Lo agrego yo. EJ: <pre>[smAddBtn producto_id="1"]</pre></span></label>
          </fieldset>
          <span class="description">¿ Donde queres que este el boton, conrespecto al contenido ?</span></td>
      </tr>        
      <tr valign="top">
        <th scope="row"><label for="blogname">Elegir cantidad</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/custom/cantidad]" value="1"  <?php checked( smAdmin::get('producto/custom/cantidad', '1'), '1', true); ?>/> <span>Si</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/custom/cantidad]" value="0" <?php checked( smAdmin::get('producto/custom/cantidad', ''), '0', true); ?>/> <span>No</span></label><br />
          </fieldset>
          <span class="description">El usuario tiene la posivilidad de elegir que cantidad desea cargar al carrito</span></td>
      </tr>        
      <tr valign="top">
        <th scope="row"><label for="blogname">Galeria</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/galeria]" value="antes"  <?php checked( smAdmin::get('producto/galeria', 'antes'), 'antes', true);  ?>/> <span>Antes</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/galeria]" value="despues" <?php checked( smAdmin::get('producto/galeria', ''),       'despues', true); ?>/> <span>Despues</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/galeria]" value="none"    <?php checked( smAdmin::get('producto/galeria', ''),       'none', true);    ?>/> <span>Lo agrego yo. EJ: <pre>[smGaleria producto_id="1"]</pre></span></label>
          </fieldset>
          <span class="description">¿ Donde queres que este la galeria, conrespecto al contenido ?</span></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="blogname">Producto relacionados</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/relacionados]" value="1"  <?php checked( smAdmin::get('home/relacionados', ''), '1', true); ?>/> <span>Si</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[producto/relacionados]" value="0" <?php checked( smAdmin::get('home/relacionados', '0'), '0', true); ?>/> <span>No</span></label><br />
          </fieldset>
          <span class="description">¿ Queres poder seleccionar productos relacionados ?</span></td>
      </tr>
    </table>
    <p>
      <input class="button-primary" type="submit" name="Example" value="<?php _e( 'Save' ); ?>" /> 
    </p>

  </form>  
  <pre><?php var_dump( smAdmin::$data ); ?></pre>

</div> <!-- .wrap -->