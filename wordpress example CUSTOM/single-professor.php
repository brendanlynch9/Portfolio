<!-- This file is used for single POST views not PAGE views -->

<?php
get_header();
while (have_posts()) {
the_post();
// <!-- page banner setup ....its on functions.php -->
pageBanner();
?>


<!-- div for content of the post and metabox to navigate with and author date etc. -->
<div class="container container--narrow page-section">

<!-- div for image and content on the screen 1/3rd and 2/3rds of the screen respectively -->
  <div class="generic-content">
<div class="row group">
  <div class="one-third">
    <!-- gets the image thumbnail from wp-admin -->
    <?php the_post_thumbnail('professorPortrait'); ?>
  </div>

<div class="two-third">
    <!-- gets the content of the blog post from wp-admin-->
  <?php the_content(); ?>
</div>

</div>
  </div>
<!-- to display the related programs ie science of cats is related to the biology program -->
  <?php
$relatedProgams = get_field ('related_programs');
// now we dont want to run any code unless it has a related program so we use an if statement
if ($relatedProgams){
  // we want an unordered list of programs displayed
  echo '<hr class="section-break">';
  echo '<h2 class="headline headline--medium">Subject(s) Taught </h2>';
  echo '<ul class="link-list min-list">';
  // for each item in the array related programs a variable $program is created and we echo a link to it with its title displayed
  foreach ($relatedProgams as $program) { ?>
  <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?> </a></li>
  <?php }
  echo '</ul>';
}

   ?>
</div>

<?php }
get_footer();
 ?>
