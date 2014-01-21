<?php


// un producto comun y corriente
add_shortcode( 'producto', array( 'smShortcode', 'producto' ) );

// un procuto que no tiene necesariamente un pagina sino un producto producido para un evento unico.
add_shortcode( 'producto_virtual', array( 'smShortcode', 'producto' ) );