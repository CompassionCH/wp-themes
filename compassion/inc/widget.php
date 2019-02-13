<?php

if (function_exists('register_sidebar')) {
  register_sidebar(array(
    'name' => 'Footer Spalte 1',
      'id' => 'footer_column_1',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5 class="widgettitle">',
    'after_title' => '</h5>',
  ));

  register_sidebar(array(
    'name' => 'Footer Spalte 2',
      'id' => 'footer_column_2',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5 class="widgettitle">',
    'after_title' => '</h5>',
  ));

  register_sidebar(array(
    'name' => 'Footer Spalte 3',
      'id' => 'footer_column_3',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5 class="widgettitle">',
    'after_title' => '</h5>',
  ));

  register_sidebar(array(
    'name' => 'Footer Spalte 4',
      'id' => 'footer_column_4',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5 class="widgettitle">',
    'after_title' => '</h5>',
  ));

}
