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

?>
