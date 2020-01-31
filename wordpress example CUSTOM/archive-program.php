<?php
get_header();
pageBanner(array(
  'title'=>'All Programs',
  'subtitle'=>'There is something for everyone have a look around.'
));
?>

<div class="container container--narrow page-section">
  <!-- start the loop for the blogs -->
  <!-- we are going to make an unordered list of programs we pull in -->
<ul class="link-list min-list">
<?php
while (have_posts ()) {
  the_post();?>
  <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></li>
<?php }
echo paginate_links();
 ?>
</ul>


</div>
<!-- dont forget the the footer -->
<?php get_footer();

 ?>
