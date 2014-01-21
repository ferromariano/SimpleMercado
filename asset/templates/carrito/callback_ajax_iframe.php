<script>
  $ = parent.jQuery;
  $box = $(parent.document).find('<?php echo $attr['parent_to']; ?>')
  $parent = $box.parent();

  $new_box_i = $(document).find('<?php echo $attr['desde']; ?>').children().children();

  $new_box_id = $new_box_i.attr('id');
  $new_box_i.css({'display':'none'});

  $new_box_i.prependTo( $parent );
  $new_box = $(parent.document).find( '#'+$new_box_id ).slideDown(500);
  $box.slideUp(500, function(e) { $(this).remove() });        
</script>