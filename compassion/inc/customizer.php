<?php

function customizer_verlinkungen($wp_customize) {

  $seiten_select = array(
    '-1' => 'Seite auswählen'
  );
  $seiten = new WP_Query(array('post_type' => 'page', 'posts_per_page' => '-1'));
  while($seiten->have_posts()):
    $seiten->the_post();

    $seiten_select[get_the_id()] = get_the_title();
  endwhile;

  $wp_customize->add_section( 'verlinkungen' , array(
    'title' => __( 'Verlinkungen', 'compassion' ),
    'priority' => 90, // Before Navigation.
  ) );

  $wp_customize->add_setting( 'spenden-seite', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'spenden-seite', array(
    'label' => __( 'Spenden-Seite', 'compassion' ),
    'type' => 'select',
    'section' => 'verlinkungen',
    'choices' => $seiten_select
  ) );

   $wp_customize->add_setting( 'schreiben-seite', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'schreiben-seite', array(
    'label' => __( 'schreiben-seite', 'compassion' ),
    'type' => 'select',
    'section' => 'verlinkungen',
    'choices' => $seiten_select
  ) );


  $wp_customize->add_setting( 'pate-werden', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'pate-werden', array(
      'label' => __( '"Pate werden"-Seite', 'compassion' ),
      'type' => 'select',
      'section' => 'verlinkungen',
      'choices' => $seiten_select
  ) );

  $wp_customize->add_setting( 'children-archive', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'children-archive', array(
      'label' => __( '"Kinder-Übersicht"-Seite', 'compassion' ),
      'type' => 'select',
      'section' => 'verlinkungen',
      'choices' => $seiten_select 
  ) );

  $wp_customize->add_setting( 'location-archive', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'location-archive', array(
      'label' => __( 'Länder-Übersicht', 'compassion' ),
      'type' => 'select',
      'section' => 'verlinkungen',
      'choices' => $seiten_select 
  ) );

}
add_action ( 'customize_register', 'customizer_verlinkungen' );


function customizer_kontaktdaten($wp_customize) {

  $wp_customize->add_section( 'kontakt' , array(
    'title' => __( 'Kontaktdaten', 'compassion' ),
    'priority' => 90, // Before Navigation.
  ) );

  $wp_customize->add_setting( 'kontakt-name', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'kontakt-name', array(
    'label' => __( 'Name', 'compassion' ),
    'type' => 'textarea',
    'section' => 'kontakt',
  ) );

  $wp_customize->add_setting( 'kontakt-strasse', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'kontakt-strasse', array(
    'label' => __( 'Straße', 'compassion' ),
    'type' => 'textarea',
    'section' => 'kontakt',
  ) );

  $wp_customize->add_setting( 'kontakt-plz', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'kontakt-plz', array(
    'label' => __( 'PLZ', 'compassion' ),
    'type' => 'textarea',
    'section' => 'kontakt',
  ) );

  $wp_customize->add_setting( 'kontakt-ort', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'kontakt-ort', array(
    'label' => __( 'Ort', 'compassion' ),
    'type' => 'textarea',
    'section' => 'kontakt',
  ) );

  $wp_customize->add_setting( 'kontakt-tel', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'kontakt-tel', array(
    'label' => __( 'Telefon', 'compassion' ),
    'type' => 'textarea',
    'section' => 'kontakt',
  ) );

  $wp_customize->add_setting( 'kontakt-email', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'kontakt-email', array(
    'label' => __( 'E-Mail-Adresse', 'compassion' ),
    'type' => 'textarea',
    'section' => 'kontakt',
  ) );
}
add_action ( 'customize_register', 'customizer_kontaktdaten' );

function customizer_bankverbindung($wp_customize) {

  $wp_customize->add_section( 'bankverbindung' , array(
    'title' => __( 'Bankverbindung', 'compassion' ),
    'priority' => 90, // Before Navigation.
  ) );

  $wp_customize->add_setting( 'bankverbindung-bank', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'bankverbindung-bank', array(
    'label' => __( 'Bank', 'compassion' ),
    'type' => 'textarea',
    'section' => 'bankverbindung',
  ) );

  $wp_customize->add_setting( 'bankverbindung-kto', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'bankverbindung-kto', array(
    'label' => __( 'Kto', 'compassion' ),
    'type' => 'textarea',
    'section' => 'bankverbindung',
  ) );

  $wp_customize->add_setting( 'bankverbindung-blz', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'bankverbindung-blz', array(
    'label' => __( 'BLZ', 'compassion' ),
    'type' => 'textarea',
    'section' => 'bankverbindung',
  ) );

  $wp_customize->add_setting( 'bankverbindung-iban', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'bankverbindung-iban', array(
    'label' => __( 'IBAN', 'compassion' ),
    'type' => 'textarea',
    'section' => 'bankverbindung',
  ) );

  $wp_customize->add_setting( 'bankverbindung-bic', array(
    'default' => ''
  ) );

  $wp_customize->add_control( 'bankverbindung-bic', array(
    'label' => __( 'BIC', 'compassion' ),
    'type' => 'textarea',
    'section' => 'bankverbindung',
  ) );

}
add_action ( 'customize_register', 'customizer_bankverbindung' );

function customizer_social_networks($wp_customize) {

  $wp_customize->add_section( 'social_networks' , array(
      'title' => __( 'Soziale Netzwerke', 'compassion' ),
      'priority' => 90, // Before Navigation.
  ) );

  $wp_customize->add_setting( 'my_compassion', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'my_compassion', array(
      'label' => __( 'my_compassion', 'compassion' ),
      'type' => 'textarea',
      'section' => 'social_networks',
  ) );

  $wp_customize->add_setting( 'facebook', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'facebook', array(
      'label' => __( 'Facebook', 'compassion' ),
      'type' => 'textarea',
      'section' => 'social_networks',
  ) );

  $wp_customize->add_setting( 'youtube', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'youtube', array(
      'label' => __( 'YouTube', 'compassion' ),
      'type' => 'textarea',
      'section' => 'social_networks',
  ) );

  $wp_customize->add_setting( 'vimeo', array(
      'default' => ''
  ) );

  $wp_customize->add_control( 'vimeo', array(
      'label' => __( 'Vimeo', 'compassion' ),
      'type' => 'textarea',
      'section' => 'social_networks',
  ) );

}
add_action ( 'customize_register', 'customizer_social_networks' );

function customizer_downloads($wp_customize) {

  require_once 'customizer-tinymce.php';

  $wp_customize->add_section( 'downloads' , array(
    'title' => __( 'Downloads', 'compassion' ),
    'priority' => 90, // Before Navigation.
  ) );

  $wp_customize->add_setting( 'downloads-form', array(
    'default' => ''
  ) );

  $wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'downloads-form', array(
      'label' => __('Formular Shortcode', 'compassion'),
      'section' => 'downloads',
      'settings' => 'downloads-form',
      'type' => 'textarea'
  ) ) );


}
add_action ( 'customize_register', 'customizer_downloads' );

/*
function customizer_blog($wp_customize) {

  require_once 'customizer-tinymce.php';

  $wp_customize->add_section( 'blog' , array(
      'title' => __( 'Blog', 'compassion' ),
      'priority' => 90, // Before Navigation.
  ) );

  $wp_customize->add_setting( 'blog-content', array(
      'default' => ''
  ) );

  $wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'blog-content', array(
      'label' => __('Content', 'compassion'),
      'section' => 'blog',
      'settings' => 'blog-content',
      'type' => 'textarea'
  ) ) );


}
add_action ( 'customize_register', 'customizer_blog' );
*/

?>
