<!-- insert the html -->
<div class="event-summary">
  <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
<!-- this php is calling the CUSTOM field info. but it is converting the 01/01/1902 to just the month three letter abbreviation-->
    <span class="event-summary__month"><?php
    // get field tells WP to find the custom field the argument if the name of the custom event...create a variable for it
$eventDate= new DateTime(get_field('event_date'));
// 'M' is for month...
echo $eventDate->format('M')
     ?></span>
     <!-- 'd' is for day -->
    <span class="event-summary__day"><?php echo $eventDate->format('d') ?></span>
  </a>
  <div class="event-summary__content">
    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <!-- if the post has an excerpt ..use it otherwise trim whats shown to the first 18 words -->
    <p><?php if (has_excerpt()) {
      echo get_the_excerpt();
    }else{
      echo wp_trim_words( get_the_content(), 18);
    } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
  </div>
</div>
