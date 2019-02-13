<?php
if( empty($instance['accordion_repeater']) ) return;
?>

<ul class="accordion" data-accordion data-allow-all-closed="true">
	<?php
	  foreach($instance['accordion_repeater'] as $repeat) {
			$accordion_title = $repeat['accordion_title'];
	    $accordion_text = $repeat['accordion_text'];
	    $checkbox = array();
	    if( !empty($repeat['accordion_checkbox']) ) $checkbox[] = 'is-active';
	?>

	<li class="accordion-item <?php echo implode(' ', $checkbox) ?>" data-accordion-item>
    <a class="accordion-title"><span class="text"><?php echo $accordion_title; ?></span></a>
    <div class="accordion-content" data-tab-content>
       <?php echo balanceTags($accordion_text) ?>
    </div>
	</li>

<?php
	}
	wp_reset_query();
?>
</ul>
