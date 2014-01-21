<?php 

// smLog::printer();

//    update_option( '_smConfig', serialize( ( array() ) ), '', 'yes' );

if( !smConfig::get('estado') ) { ?>
<div id="smInstalacion">
  <h1>Hola <?php echo wp_get_current_user()->display_name ; ?>, empecemos la configuracion de tu SimpleMertado</h1>
  <a href="#">Configurar &raquo;</a>
</div>
<?php }
/** /
  $cats = array();

  for ($i=0; $i < 20; $i++) {
    $t = wp_insert_term('categoria '.$i.'-'.rand(1, 99999), 'sm_categoria');
    if( isset($t['term_id']) ) $cats[ $t['term_id'] ] = '';
  }


  // añadir post
  for ($i=0; $i < 100; $i++) { 
    $cat = array_rand( $cats, rand(1, 4) );

    $post = array('post_title'=> 'producto '.$i,
                  'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in risus ut magna elementum pretium. Aenean dictum aliquam lobortis. Sed dui orci, consectetur quis fringilla eu, tristique vel enim. Nunc sagittis tincidunt lorem eu sodales. Proin at lectus semper metus dignissim feugiat. Sed eu nibh vel metus molestie posuere. Etiam eget metus at ligula imperdiet tristique.',
                  'post_author'=>1,
                  'post_status'=>'publish',
                  'post_type'=>'sm_producto',
                  'tax_input' => array( 'sm_categoria' => $cat ),

                  'comment_status'=>'closed',
                  'ping_status'=>'closed',
                  );
    $portada_id = wp_insert_post( $post );

    $file = wp_upload_bits( 'img_'.rand(0,9999999).'.jpg', null, @file_get_contents('http://lorempixel.com/640/480/technics/') );


    $wp_filetype = wp_check_filetype(basename($file['file']), null );
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
       'guid' => $wp_upload_dir['url'] . '/' . basename( $file['file'] ), 
       'post_mime_type' => $wp_filetype['type'],
       'post_title' => preg_replace('/\.[^.]+$/', '', basename($file['file'])),
       'post_content' => '',
       'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file['file'], $portada_id );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file['file'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    set_post_thumbnail( $portada_id, $attach_id );

//    http://lorempixel.com/640/480/technics/
  }


  /**/
