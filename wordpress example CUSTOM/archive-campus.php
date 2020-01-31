<?php
get_header();
pageBanner(array(
  'title'=>'Our Campuses',
  'subtitle'=>'We have several conveniently located campuses'
));
?>

<div class="container container--narrow page-section">
  <!-- start the loop for the blogs -->
  <!-- we are going to make an unordered list of programs we pull in -->
<div class="acf=map">

<?php
while (have_posts ()) {
  the_post();
$mapLocation = get_field('map_location');
  ?>
  <div class= "marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
  </div>
<?php }
echo paginate_links();
 ?>
</div>

</div>
<!-- dont forget the the footer -->
<?php get_footer();

 ?>
