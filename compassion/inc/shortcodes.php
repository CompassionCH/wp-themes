<?php

function buttons($attrs, $content = null) {
  extract(shortcode_atts(array(
    'href' => '#',
    'size' => 'large',
    'color' => 'blue'
  ), $attrs));

  return '<a href="'.$href.'" class="button button-'.$color.' button-'.$size.'">'.$content.'</a>';
}
add_shortcode('button', 'buttons');
//[button href="link" size="large"]text[/button]

function button_ga($attrs, $content = null) {
  extract(shortcode_atts(array(
    'href' => '#',
    'send' => 'send',
    'event' => 'event',
    'cat' => 'cat',
    'action' => 'action',
    'label' => 'label',
    'value' => 'value',
    'size' => 'large',
    'color' => 'blue'
  ), $attrs));

  return '<a onClick="ga('.$send.' , '.$event.' , '.$cat.' , '.$action.' , '.$label.' , '.$value.');" href="'.$href.'" class="button button-'.$color.' button-'.$size.'">'.$content.'</a>';
}
add_shortcode('button_analytics', 'button_ga');

?>
