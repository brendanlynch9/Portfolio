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
    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i>All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
  </div>
  <!-- gets the content of the blog post from wp-admin-->
  <div class="generic-content">
    <?php the_content(); ?>
  </div>

  <?php

  $relatedProfessors= new WP_Query(array(
    // if you set it to a negative number it will show all events
  'posts_per_page'=> -1,
  'post_type' =>'professor',
  // the below tells us how to order the display on the front page. Whether post_date or alphabetical (title) or meta_value etc.
  'orderby'=>'title',
  // ascending or decending order
  'order'=>'ASC',
  // but what if the event has passed? how do we filter off our list events that have passed?
  // only show us posts with a date of greater than or equal to todays date.
  'meta_query'=>array(
  // if the array of related programs contains or are like the current ID number of the current post
  array (
    'key'=> 'related_programs',
    'compare' => 'LIKE',
    'value'=>'"'. get_the_ID(). '"'
  )
  )

  ));
  // write an if statement to see IF there is a relationship or related program
  if ($relatedProfessors->have_posts()) {
  // some HTML and styling
  echo '<hr class="section-break">';
  echo '<h2 class="headline headline--medium"> ' . get_the_title () . ' Professors </h2>';

    // now do a loop that starts with the custom query and points to the normal functions.
    // the below puts a picture with their name for each professor on the page that when clicked goes to their page
echo '<ul class="professor-cards">';
    while ($relatedProfessors->have_posts()){
      $relatedProfessors->the_post();?>
      <li class="professor-card__list-item">
        <a class="professor-card" href="<?php the_permalink(); ?>">
<img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
<span class="professor-card__name"><?php the_title(); ?></span>
         </a>
      </li>
    <?php }
    echo '</ul>';
  }

// Whenever you run multiple custom queries on a single page you need to reset post data between the two queries.
wp_reset_postdata();

  $today= date('Ymd');
  $homepageEvents= new WP_Query(array(
    // if you set it to a negative number it will show all events
  'posts_per_page'=> 2,
  'post_type' =>'event',
  // the below tells us how to order the display on the front page. Whether post_date or alphabetical (title) or meta_value etc.
  'orderby'=>'meta_value_num',
  // if you use a meta value orderby you must assign a meta key
  'meta_key'=>'event_date',
  // ascending or decending order
  'order'=>'ASC',
  // but what if the event has passed? how do we filter off our list events that have passed?
  // only show us posts with a date of greater than or equal to todays date.
  'meta_query'=>array(
  array(
  'key'=> 'event_date',
  'compare'=> '>=',
    'value'=> $today,
    'type'=> 'numeric'
  ),
  // if the array of related programs contains or are like the current ID number of the current post
  array (
    'key'=> 'related_programs',
    'compare' => 'LIKE',
    'value'=>'"'. get_the_ID(). '"'
  )
  )

  ));
// write an if statement to see IF there is a relationship or related program
if ($homepageEvents->have_posts()) {
  // some HTML and styling
  echo '<hr class="section-break">';
  echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title () . ' Events </h2>';

    // now do a loop that starts with the custom query and points to the normal functions.
    while ($homepageEvents->have_posts()){
      $homepageEvents->the_post();
      get_template_part('template-parts/content', 'event');
     }
}
  ?>
</div>

<?php }
get_footer();
 ?>
