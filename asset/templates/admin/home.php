<div class="wrap">
  
  <div id="icon-options-general" class="icon32"></div>
  <h2>Configurando la Home</h2>
  <p></p>
  <?php settings_errors(); ?>
  <form method="post">
    <?php wp_nonce_field( 'smAdminHome', 'smAdminHome_nonce' ); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="blogname">Pagina Home</label></th>
        <td>
          <?php wp_dropdown_pages(array(
            'sort_order'   => 'ASC',
            'sort_column'  => 'post_title',            
            'depth'            => 0,
            'child_of'         => 0,
            'selected'         => smAdmin::get('paginas/home', '0'),
            'echo'             => 1,
            'name'             => 'sm_rapido[paginas/home]'
          )); ?>
          <span class="description">Que pagina se usara para la home</span></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="blogname">Vista Home</label></th>
        <td>
          <fieldset>
            <label title='g:i a'><input type="radio" name="sm_rapido[home/mode]" value="slider"  <?php checked( smAdmin::get('home/mode', 'slider'), 'slider', true);  ?>/> <span>Carrucel de productos</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[home/mode]" value="listado" <?php checked( smAdmin::get('home/mode', ''),       'listado', true); ?>/> <span>Listado de productos</span></label><br />
            <label title='g:i a'><input type="radio" name="sm_rapido[home/mode]" value="none"    <?php checked( smAdmin::get('home/mode', ''),       'none', true);    ?>/> <span>Nada</span></label>
          </fieldset>
          <span class="description">¿ Que queres ver en la home ?</span></td>
      </tr>        
    </table>

    <div id="selectCarrucel">
      <h3>Carrucel</h3>
      <p>Para que sea mas facil poner productos en la home, usa la categoria que queres que se muestre</p>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="blogname">Categoria</label></th>
          <td><?php $select = wp_dropdown_categories(array(
                                'show_option_all'    => '',
                                'show_option_none'   => 'Seleccionar categoria',
                                'orderby'            => 'name', 
                                'order'              => 'DESC',
                                'show_count'         => 1,
                                'hide_empty'         => 0, 
                                'child_of'           => 0,
                                'exclude'            => '',
                                'echo'               => 1,
                                'depth'              => 0,
                                'tab_index'          => 0,
                                'name'               => 'sm_rapido[home/cat_slide]',
                                'id'                 => '',
                                'class'              => 'postform',
                                'selected'           => smAdmin::get('home/cat', 0),
                                'hierarchical'       => 0, 
                                'taxonomy'           => 'sm_categoria',
                                'hide_if_empty'      => false,
                                'walker'             => ''
                              )); ?></td>
        </tr>        
      </table>
    </div>

    <div id="selectListado">
      <h3>Listado</h3>
      <p>Para que sea mas facil poner productos en la home, usa la categoria que queres que se muestre</p>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="blogname">Categoria</label></th>
          <td><?php $select = wp_dropdown_categories(array(
                                'show_option_all'    => '',
                                'show_option_none'   => 'Seleccionar categoria',
                                'orderby'            => 'name', 
                                'order'              => 'DESC',
                                'show_count'         => 1,
                                'hide_empty'         => 0, 
                                'child_of'           => 0,
                                'exclude'            => '',
                                'echo'               => 1,
                                'depth'              => 0,
                                'tab_index'          => 0,
                                'name'               => 'sm_rapido[home/cat_list]',
                                'id'                 => '',
                                'class'              => 'postform',
                                'selected'           => smAdmin::get('home/cat', 0),
                                'hierarchical'       => 0, 
                                'taxonomy'           => 'sm_categoria',
                                'hide_if_empty'      => false,
                                'walker'             => ''
                              )); ?></td>
        </tr>        
      </table>
    </div>

    <p>
      <input class="button-primary" type="submit" name="Example" value="<?php _e( 'Save' ); ?>" /> 
    </p>

  </form>  
  <pre><?php var_dump( smAdmin::$data ); ?></pre>

</div> <!-- .wrap -->