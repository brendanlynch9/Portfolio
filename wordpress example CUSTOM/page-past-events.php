<?php
get_header();
pageBanner(array(
  'title'=>'Past Events',
  'subtitle'=>'A recap of our past events.'
));
?>

<div class="container container--narrow page-section">
  <!-- start the loop for the blogs -->
<?php
// A custom query to load any events from before todays date.
// create a variable for past events
$today= date('Ymd');
$pastEvents= new WP_Query(array(
  //  the below tells the custom query which page number of results it should be on.
  'paged'=>get_query_var('paged', 1),
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
'compare'=> '<',
  'value'=> $today,
  'type'=> 'numeric'
)
)

));
// look inside our object past events to see if there are any posts and call the post
while ($pastEvents->have_posts ()) {
  $pastEvents->the_post();
  get_template_part('template-parts/content', 'event');


 }
// instead of a simple paginate links because we are using a custom array above for past events... we have to tell WP
// how many past event pagination links it needs.
echo paginate_links(array(
'total'=>$pastEvents->max_num_pages

));
 ?>
</div>
<!-- dont forget the the footer -->
<?php get_footer();

 ?>
