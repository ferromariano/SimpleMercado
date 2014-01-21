<?php
  if( smConfig::get('estado') == 1 ):
    $args = array(
      'label'              => 'Carrito',
      'public'             => false,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => false,
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title', 'editor', 'custom-fields' )
    );


    register_post_type( 'sm_carro', $args );

     $args = array(
      'label'              => 'Productos',
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' )
    );

    register_post_type( 'sm_producto', $args ); 
    
    $args = array(
      'hierarchical'      => true,
      'label'             => 'Categoria producto',
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'categoria' ),
    );

    register_taxonomy( 'sm_categoria', array( 'sm_producto' ), $args );
  endif;
  if(is_admin()) { 
    smAdmin::init(); 
  } 







