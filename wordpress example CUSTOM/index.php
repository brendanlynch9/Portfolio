<?php
get_header();
pageBanner(array(
  'title'=>'Welcome to our blog!',
  'subtitle'=>'Keep up with our latest news'
));
?>

<div class="container container--narrow page-section">
  <!-- start the loop for the blogs -->
<?php
while (have_posts ()) {
  the_post();?>
  <!-- this is the post title typed into wp-admin it is clickable -->
  <div class="post-item">
    <h2 class="headline headline--medium headline--post-title"><a  href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
<!-- little box that displays the information about the author -->
<div class="metabox">
  <!-- //"posted by brendan on 6.8.2017 in the section News" ...becomes dynamic with these php wp functions-->
  <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(' , '); ?></p>
</div>
<!-- the actual content of the post -->
    <div class="generic-content">
      <!-- you dont want to display the entire post so just an excerpt will do -->
      <?php the_excerpt(); ?>
      <!-- the blue button to continue reading ...&raquo creates arrows for the continue button -->
      <p><a class="btn btn--blue" href= "<?php the_permalink(); ?>">continue reading &raquo;</a></p>
    </div>
  </div>
<!-- close out the php  and add pagination-->
<?php }
echo paginate_links();
 ?>
</div>
<!-- dont forget the the footer -->
<?php get_footer();

 ?>
