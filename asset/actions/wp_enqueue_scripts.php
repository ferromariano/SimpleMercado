<?php

$dir_uri = plugins_url( 'asset/js/', smConfig::get('dir_base').'/simple_mercadopago.php' );


wp_register_script( 'main.admin', $dir_uri . 'main.admin.js', array('jquery'), '1.0' );

wp_register_script( 'main',       $dir_uri . 'main.js',                                     array('jquery'), '1.0' );

// LIBS
wp_register_script( 'bxslider',   $dir_uri . 'libs/jquery.bxslider/jquery.bxslider.min.js', array('jquery'), '4.1.1', true );
wp_register_style(  'bxslider',   $dir_uri . 'libs/jquery.bxslider/jquery.bxslider.css', array(), '4.1.1', 'all' );

wp_register_script( 'mousewheel', $dir_uri . 'libs/jquery.mousewheel-3.0.6.pack.js',        array('jquery'), '3.0.6' );
wp_register_script( 'fancybox',   $dir_uri . 'libs/fancybox/jquery.fancybox.pack.js',       array('jquery', 'mousewheel'), '2.1.5' );
wp_register_style(  'fancybox',   $dir_uri . 'libs/fancybox/jquery.fancybox.css',           array(), '2.1.5' );
