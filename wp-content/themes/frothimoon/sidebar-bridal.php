<!-- NON HOME PAGE SIDEBAR -->
<div class="main-aside">

<?php
$terms = get_terms('bridal_category');

foreach ($terms as $term) {
  $wpq = array ('taxonomy'=>'bridal_category','term'=>$term->slug);
  $myquery = new WP_Query ($wpq);
  $article_count = $myquery->post_count;
echo "<ul>";
echo "<li>";
  echo "<h3 class=\"term-heading\" id=\"".$term->slug."\">";

  echo $term->name;
  echo "</h3>";
echo "<ul>";

  if ($article_count) {
    
    while ($myquery->have_posts()) : $myquery->the_post();
      echo "<li><a href=\"".get_permalink()."\">".$post->post_title."</a></li>";
    endwhile;
echo "</ul>";
echo "</li>";
    echo "</ul>";
  }
}
?>

</div>
<!-- END NON HOME PAGE SIDEBAR -->