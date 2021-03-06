


<div class="google-map-wrapper map-projekte">

  <div id="map_projekte" class="google-map" close-icon-src="<?php echo get_template_directory_uri().'/assets/img/close-icon-black-small.png'?>"></div>

  <div class="items row">

    <?php

    $locations = new WP_Query( array(
      'post_type'   =>  array( 'location' ),
      'posts_per_page'  =>  '-1',
      'tax_query' => array(
        array(
          'taxonomy' => 'location-category',
          'field'    => 'name',
          'terms'    => __('Projektländer', 'compassion'),
        ),
      ),
    ) );

    $locations_array = array();

    while( $locations->have_posts() ) {
      $locations->the_post();

      $terms = wp_get_post_terms(get_the_id(), 'location-group');

      $locations_array[$terms[0]->term_id][] = array(
        'latitude' => get_post_meta(get_the_id(), '_cmb_latitude', true),
        'longitude' => get_post_meta(get_the_id(), '_cmb_longitude', true),
        'title' =>  get_the_title(),
        'permalink' => get_the_permalink(),
        'link-text' => get_post_meta(get_the_id(), '_cmb_link_text', true)
      );

    }

    foreach( $locations_array as $term_id => $group ) {
      $term = get_term_by('id', $term_id, 'location-group');
      ?>
      <div class="medium-3 column">
        <h5><?php echo $term->name ?></h5>

        <?php foreach( $group as $location ) {
          ?>
          <a
            class="item"
            data-lat="<?php echo $location['latitude']; ?>"
            data-lng="<?php echo $location['longitude']; ?>"
            href="<?php echo $location['permalink']; ?>"
            data-linktext="<?php echo $location['link-text']; ?>"
          ><?php echo $location['title']; ?></a>
          <?php
        } ?>

      </div>
      <?php

    }
    ?>

  </div>

</div>


<script>
jQuery(document).ready(function($) {
  var myLatLng = {lat: 28.217290, lng: 14.238281};

  var map = new google.maps.Map(document.getElementById('map_projekte'), {
    zoom: 2,
    center: myLatLng
  });

  $('.map-projekte').each(function() {
    $(this).find('.item').each(function() {
      var item = $(this);

      var $closeIcon = jQuery('#map_projekte').attr('close-icon-src');

      var contentString = '<div class="content infowindow-content">'+
      '<h5 class="svg-divider">' + item.text() + '</h5>' +
      '<a href="' + item.attr('href') + '">' + item.data('linktext') + '</a>'
      '</div>';

      var infowindow = new InfoBox({
         disableAutoPan: false,
         maxWidth: 240,
         pixelOffset: new google.maps.Size(-100, -180),
         zIndex: 99999,
         boxStyle: {
            background: '#FFFFFF',
            opacity: 1,
            borderRadius: "3px",
            padding: "15px 0",
            boxShadow: "0 1px 1px rgba(0, 0, 0, 0.2)"
        },
        closeBoxMargin: "-5px 10px 0 0",
        closeBoxURL: $closeIcon,
        infoBoxClearance: new google.maps.Size(1, 1)
      });

      var marker = new google.maps.Marker({
        position: {lat: parseFloat(item.data('lat')), lng: parseFloat(item.data('lng'))},
        map: map,
        title: item.text(),
        permalink: item.attr('href')
      });

      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString);
        infowindow.open(map, marker);
      });
    })
  });


});


</script>
