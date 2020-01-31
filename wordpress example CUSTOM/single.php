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
    <p><a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home</a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(' , '); ?></span></p>
  </div>
  <!-- gets the content of the blog post from wp-admin-->
  <div class="generic-content">
    <?php the_content(); ?>
  </div>
</div>

<?php }
get_footer();
 ?>
