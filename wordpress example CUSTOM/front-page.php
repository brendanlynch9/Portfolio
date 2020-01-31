<!--To call the header  -->

<?php get_header();?>
<div class="page-banner">
<div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Welcome!!!</h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="<?php echo get_post_type_archive_link('program'); ?>" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
      <!-- // to begin a custom query you begin by creating a variable. in this instance we want to create a variable that
      // will permit us to change the display to the last two blog posts. first you have to create a variable
      // insert the apropos parameters. in this case 2, category name in this case "event"... -->
<?php
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
)
)

));

// now do a loop that starts with the custom query and points to the normal functions.
while ($homepageEvents->have_posts()){
  $homepageEvents->the_post();
  get_template_part('template-parts/content', 'event');
 }
?>
<!-- the php in the button will take someone to the Events page -->
<p class="t-center no margin"><a href="<?php echo get_post_type_archive_link ('event'); ?>" class="btn btn--blue">View all events</a></p>
</div>
</div>


<!-- there are 2 seperate dynamic data driven sections on the landing page this is the second one -->
<!-- it is the same process as above though -->

<!-- start the html -->
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
<!-- // to begin a custom query you begin by creating a variable. in this instance we want to create a variable that
// will permit us to change the display to the last two blog posts. first you have to create a variable
// insert the apropos parameters. in this case 2, category name or whatever... -->
  <?php
$homepagePosts = new WP_Query(array (
  'posts_per_page'=>2
  // other parameters like the below can be given...
  // 'post_type' => 'page',
  // 'category_name' => 'awards'
));

// now do a loop that starts with the custom query and points to the normal functions.
while ($homepagePosts ->have_posts()) {
$homepagePosts->  the_post();?>
<!-- insert the html -->
<div class="event-summary">
  <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
    <span class="event-summary__month"><?php the_time('M'); ?></span>
    <span class="event-summary__day"><?php the_time('d'); ?></span>
  </a>
  <div class="event-summary__content">
    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
<!-- if the post has an excerpt ..use it otherwise trim whats shown to the first 18 words -->
    <p><?php if (has_excerpt()) {
      echo get_the_excerpt();
    }else{
      echo wp_trim_words( get_the_content(), 18);
    } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
  </div>
</div>
<!-- reset the data always on custom queries! -->
<?php } wp_reset_postdata();
       ?>



<!-- th php in the button will take someone to the blog page -->
      <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
    </div>
  </div>
</div>
<!-- after you write custom queries you need to go to wp-admin then settings then permalink and click "save" to refresh the permalinks -->
<!-- so that it will recognize "event" or " professor" or... whatever custom query you wrote above-->
<div class="hero-slider">
<div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Free Transportation</h2>
      <p class="t-center">All students have free unlimited bus fare.</p>
      <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
<div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">An Apple a Day</h2>
      <p class="t-center">Our dentistry program recommends eating apples.</p>
      <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
<div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Free Food</h2>
      <p class="t-center">Fictional University offers lunch plans for those in need.</p>
      <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
</div>
<!--call footer  -->
<?php get_footer();
 ?>
