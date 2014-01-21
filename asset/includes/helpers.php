<?php


function inAction($n, $p=10, $args = 1) { smConfig::get('actions')->add( $n, $p, $args); }
function inActions( $ns ) { if( is_array( $ns ) ) { foreach( $ns as $n ) { inAction($n); } } }



function tag($name, $attr = array(), $open = false) {
  if (!$name) {
    return '';
  }
  return '<'.$name._tag_options($attr).(($open) ? '>' : ' />');
}

function _tag_options($options = array()) {
  $html = '';
  foreach ($options as $key => $value) {
    $html .= ' '.$key.'="'.escape_once($value).'"';
  }
  return $html;
}

function escape_once($html) {
  return preg_replace('/&amp;([a-z]+|(#\d+)|(#x[\da-f]+));/i', 
                      '&$1;',
                      ( htmlspecialchars( $html, 
                                          ENT_COMPAT ) ) );
}
