<?php
// it is important to use the must use plugins folder (create it ) inside wp-content to save the custom pages...
// the reason is because if you migrate this theme without a must use plugin it will lose all the custom pages.

// permits wordpress to have custom post types such like "events","professors"  or named whatever...beyond just "pages" and "posts"
function university_post_types(){

  // this is the post type for "campuses"
  register_post_type('campus',array(
    // this first line below me tells wp-admin what all it will permit as the inputs
    'supports'=> array('title', 'editor', 'excerpt'),
    // this one below me tells wp-admin to have a sidebar named campuses
    'rewrite'=> array('slug' =>'campuses'),
    'has_archive'=> true,
    'public' => true,
    //names the new page and sets parameters for its display inside wp-admin
    'labels' =>array(
      'name' => 'Campuses',
      'add_new_item'=> 'Add new Campus',
      'edit_item'=> 'Edit Campus',
      'all_items'=> 'All Campuses',
      'singular_name'=>'Campus'
    ),
    //generates a unique icon for each new page for wp-admin sidebar so you can find them easier... google 'WP dash icons'
    'menu_icon' =>'dashicons-location-alt'
  ));


  // this is the post type for "events"
  register_post_type('event',array(
    // this first line below me tells wp-admin what all it will permit as the inputs
    'supports'=> array('title', 'editor', 'excerpt'),
    // this one below me tells wp-admin to have a sidebar named events
    'rewrite'=> array('slug' =>'events'),
    'has_archive'=> true,
    'public' => true,
    //names the new page and sets parameters for its display inside wp-admin
    'labels' =>array(
      'name' => 'Events',
      'add_new_item'=> 'Add new Event',
      'edit_item'=> 'Edit Event',
      'all_items'=> 'All Events',
      'singular_name'=>'Event'
    ),
    //generates a unique icon for each new page for wp-admin sidebar so you can find them easier... google 'WP dash icons'
    'menu_icon' =>'dashicons-calendar'
  ));
  // this is the post type for "programs"
  register_post_type('program',array(
    // this first line below me tells wp-admin what all it will permit as the inputs
    'supports'=> array('title', 'editor',),
    // this one below me tells wp-admin to have a sidebar named events
    'rewrite'=> array('slug' =>'programs'),
    'has_archive'=> true,
    'public' => true,
    //names the new page and sets parameters for its display inside wp-admin
    'labels' =>array(
      'name' => 'Programs',
      'add_new_item'=> 'Add new Program',
      'edit_item'=> 'Edit Program',
      'all_items'=> 'All Programs',
      'singular_name'=>'Program'
    ),
    //generates a unique icon for each new page for wp-admin sidebar so you can find them easier... google 'WP dash icons'
    'menu_icon' =>'dashicons-awards'
  ));
  // this is the post type for "proffesors"
  register_post_type('professor',array(
    // this first line below me tells wp-admin what all it will permit as the inputs
    'supports'=> array('title', 'editor', 'thumbnail'),
    // this one below me tells wp-admin to have a sidebar named professor
    'public' => true,
    //names the new page and sets parameters for its display inside wp-admin
    'labels' =>array(
      'name' => 'Professors',
      'add_new_item'=> 'Add new Professor',
      'edit_item'=> 'Edit Professor',
      'all_items'=> 'All Professors',
      'singular_name'=>'Professor'
    ),
    //generates a unique icon for each new page for wp-admin sidebar so you can find them easier... google 'WP dash icons'
    'menu_icon' =>'dashicons-welcome-learn-more'
  ));

}

add_action('init', 'university_post_types');
?>
