<!-- This file is used for single POST views not PAGE views -->

<?php
get_header();
while (have_posts()) {
the_post();
pageBanner();
?>

<div class="container container--narrow page-section">
  <!-- the metabox -->
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> <span class="metabox__main"><?php the_title(); ?></span></p>
  </div>
  <!-- gets the content of the blog post from wp-admin-->
  <div class="generic-content">
    <?php the_content(); ?>
  </div>
<!-- to display the related programs ie science of cats is related to the biology program -->
  <?php
$relatedProgams = get_field ('related_programs');
// now we dont want to run any code unless it has a related program so we use an if statement
if ($relatedProgams){
  // we want an unordered list of programs displayed
  echo '<hr class="section-break">';
  echo '<h2 class="headline headline--medium">Related Program(s) </h2>';
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
