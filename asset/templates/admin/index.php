<div class="wrap">
  
  <div id="icon-options-general" class="icon32"></div>
  <h2>Rapido y al paso, es esta configuracion</h2>
  <?php settings_errors(); ?>
  <form method="post">
    <?php wp_nonce_field( 'smAdminIndex', 'smAdminIndex_nonce' ); ?>

  </form>  
  <pre><?php var_dump( smAdmin::$data ); ?></pre>

</div> <!-- .wrap -->