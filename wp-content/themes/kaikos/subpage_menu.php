<?php
$parent_title = get_the_title($post->post_parent);
 if($post->post_parent)
  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
  else
  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
  if ($children) {
	?>
<ul>
<li><a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo $parent_title;?></a></li>
  <?php echo $children; ?>
  <?php } ?>

</ul>