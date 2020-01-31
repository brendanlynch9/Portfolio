<?php
// function to call for a profile picture subtext and background banner images
function pageBanner($args = NULL){
  // php logic will live here
  // if no title is provided on the .php page using this function then pull in the wordpress title as a fallback
  if (!$args['title']){
    $args['title'] = get_the_title();
  }
  // if no subtitle is provided on the .php page using this function then pull in the wordpress subtitle as a fallback
if (!$args['subtitle']){
$args['subtitle'] =get_field('page_banner_subtitle');

}

if (!$args['photo']){
if (get_field('page_banner_background_image')){
$args ['photo']= get_field('page_banner_background_image')['sizes']['pageBanner'];
}else{
  $args['photo']  = get_theme_file_uri('/images/ocean.jpg');
}
}

  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args ['photo']?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
  <p><?php echo $args['subtitle'] ?></p>
      </div>
    </div>
  </div>
<?php }

// function to call stylesheets and javascript files
function university_files(){
  // load css or javascript files here:
  // this first one pulls in the google api for the campus  map from the internet and loads the js that google has for the map
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=SHAAPIKEYGOESHERE############',NULL,microtime(),true);

  wp_enqueue_script('main-university-javascript', get_theme_file_uri('/js/scripts-bundled.js'),NULL,microtime(),true);
  wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_stylesheet_uri(),Null,microtime());
}

// gives wordpress instructions and tells it what to do from above. This calls the function above.
add_action('wp_enqueue_scripts', 'university_files');

function university_features(){
  register_nav_menu('headerMenuLocation','Header Menu Location');
  add_theme_support('title-tag');
  // enables images
  add_theme_support('post-thumbnails');
  // when you upload an image to WP it automatically creates 5 different sized copies the below lets us assign a custom one
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);

}
add_action('after_setup_theme', 'university_features');

// this is for the all events and program archive pages to EDIT the query rather than writing another custom query.
function university_adjust_queries($query){
  // orders the program archive alphabetically and displays them to infinity
if (!is_admin() AND  is_post_type_archive ('program') AND $query-> is_main_query()) {
  $query->set ('orderby', 'title');
  $query->set ('order', 'ASC');
  $query->set ('posts_per_page', -1);
}

// the below says dont apply this to wp-admin & only use the function for all events page
//  and what we are manipulating is not a custom query. THEN proceed...
if (!is_admin() AND is_post_type_archive ('event') AND $query->is_main_query()){
  $today= date('Ymd');
  $query->set('meta_key', 'event_date');
  $query->set ('orderby', 'meta_value_num');
  $query->set ('order', 'ASC');
  $query->set ('meta_query',array(
  array(
  'key'=> 'event_date',
  'compare'=> '>=',
    'value'=> $today,
    'type'=> 'numeric'
  )
  ));
}
}
add_action('pre_get_posts', 'university_adjust_queries');

// to call the api for the google maps
// function universityMapKey($api) {
// $api['key'] = 'SHA ################################## ';
// return $api;
// }
// add_filter('acf/fields/google_map/api', 'universityMapKey');


 ?>
