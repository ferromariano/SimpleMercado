

<?php

// The 2nd Loop
while( have_posts() ) {
  the_post();
  echo '<li>' . get_the_title(  ) . '</li>';
}


 ?>





<ul class="bxslider">
  <li><img src="http://bxslider.com/images/730_200/tree_root.jpg" title="Funky roots" /></li>
  <li><img src="http://bxslider.com/images/730_200/hill_road.jpg" title="The long and winding road" /></li>
  <li><img src="http://bxslider.com/images/730_200/trees.jpg" title="Happy trees" /></li>
</ul>
<script type="text/javascript">
  jQuery(document).ready(function (e){
    jQuery(".bxslider").bxSlider({ mode: 'fade', captions: true });
  });
</script>