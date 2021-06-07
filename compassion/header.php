<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title(' - '); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    
    
    <!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/img/apple-icon-touch.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="#f01d4f">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/img/win8-tile-icon.png">
	    	<meta name="theme-color" content="#121212">
	    <?php } ?>




    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="off-canvas-wrapper">

    <div class="off-canvas-wrapper-inner">

        <div class="off-canvas-menu" id="off-canvas-menu">
            <a href="#" class="off-canvas-toggle off-canvas-close"></a>

            <div class="content">
                <?php wp_nav_menu(array('menu' => 'Main Menu')); ?>

                <div class="search-form-wrapper">
                    <form action="<?php bloginfo('url'); ?>" method="GET">
                        <input type="text" name="s" class="input-field search-input"
                               placeholder="<?php esc_attr_e( 'Suchbegriff eingeben', 'compassion' );?>"/>
                    </form>
                </div>
            </div>

            <div class="bottom-content">
                <h5 class="text-uppercase"><?php _e('Bankverbindung', 'compassion'); ?></h5>
                <?php echo get_theme_mod("bankverbindung-bank"); ?><br/>
                <?php _e('IBAN', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-iban"); ?><br/>
<!--                 <?php _e('BIC', 'compassion'); ?> <?php echo get_theme_mod("bankverbindung-bic"); ?> -->
            </div>
        </div>

        <div class="off-canvas-content" data-off-canvas-content>

            <header class="site-header">

                <div class="svg-wrap">
                    <svg viewBox="0 0 400 20" xmlns="http://www.w3.org/2000/svg">
                        <path id="svg_line" clip-path="url(#SVGID_2_)" d="M2.594,2.709C2.329,2.675,1.888,2.618,1.436,2.565
									C0.431,2.446-0.021,2.304,0.015,2.132c0.048-0.194-0.033-0.389,0.034-0.583c0.033-0.109-0.328-0.224,0.522-0.326
									c0.319-0.038,0.349-0.18,0.041-0.219c-1.304-0.17-0.125-0.294,0.294-0.433c1.592-0.036,3.257,0.044,4.811-0.077
									c0.371-0.029,1.275,0.038,1.899,0.071c0.795,0.042,1.383-0.101,2.381-0.012c0.617,0.056,1.825,0.011,2.774,0.011
									c0.945,0,1.895-0.008,2.831,0.001c1.497,0.015,3.101-0.058,4.472,0.075l0.308,0.001c1.072-0.026,2.358-0.109,3.148-0.063
									c1.029,0.06,1.96,0.05,2.945,0.064c0.978,0.015,1.933-0.022,2.958,0.065c0.599,0.05,1.739-0.091,2.823-0.068
									c1.18,0.024,2.403-0.032,3.558,0.073c0.479,0.043,1.501,0.032,2.15,0.003c2.483-0.112,4.858-0.047,7.38-0.015
									c2.772,0.035,5.668,0.071,8.592-0.04c1.899-0.072,4.255-0.063,6.509,0.03c1.815-0.165,4.06-0.164,6.389-0.087
									c0.474,0.016,0.99,0.045,1.442,0.035c3.187-0.069,3.16-0.051,5.796-0.007c1.348,0.023,2.847,0.06,4.234-0.039
									c0.479-0.034,1.187-0.027,1.788-0.028c3.572-0.002,7.146-0.002,10.713,0.001c0.687,0,1.363,0.024,2.036,0.044
									c1.323,0.039,2.79,0.005,4.202-0.004c0.373-0.003,0.736-0.036,1.116-0.04c2.956-0.029,5.914-0.051,8.867-0.081
									c0.639-0.007,1.25-0.05,1.875-0.05c0.569-0.002,1.148,0.053,1.704,0.048c1.702-0.015,3.39-0.053,5.091-0.072
									c1.213-0.014,2.355,0.019,3.547,0.066c1.072,0.042,2.358,0.188,3.545,0.01c1.19,0.133,2.379-0.017,3.575-0.003
									c1.201,0.014,2.425,0.058,3.523,0.064c2.192,0.011,4.541,0.106,6.681-0.058c0.305-0.024,0.828,0,1.247-0.003
									c3.166-0.027,6.395,0.066,9.506-0.076c0.278-0.013,0.624-0.004,0.941-0.002c1.924,0.018,3.694,0.113,5.824,0.016
									c1.759-0.08,3.941-0.016,5.936-0.016c2.101,0,4.202,0.002,6.303-0.001c0.606-0.001,1.35,0.012,1.785-0.026
									c0.624-0.055,0.916-0.04,1.583-0.006c0.906,0.045,2.219,0.073,3,0.023c1.715-0.11,3.458-0.079,5.13-0.06
									c2.512,0.029,4.831-0.099,7.302-0.088c2.41,0.011,4.827,0.003,7.248,0.003h2.127c0.523,0.22,1.174,0.425,1.476,0.637
									c0.393,0.288-0.396,0.568-0.985,0.842c-0.312,0.146-0.333,0.264,0.354,0.372c-0.568,0.395-4.096,0.43-5.338,0.747
									c-2.133-0.138-4.194-0.109-6.227-0.109C178.323,2.74,172.863,2.743,167.4,2.74c-2.664-0.002-5.234,0.136-7.931,0.077
									c-0.859-0.018-1.704-0.061-2.57-0.074c-0.936-0.012-1.999-0.036-2.82,0.004c-2.407,0.117-4.94,0.104-7.305,0.062
									c-7.789-0.14-15.589-0.044-23.374-0.064c-7.766-0.02-15.542-0.01-23.307-0.002c-3.072,0.005-6.115,0.068-9.184,0.093
									c-2.182,0.017-4.25,0.105-6.437-0.013c-0.614-0.033-1.73-0.042-2.133,0.003c-1.046,0.118-2.181,0.066-3.257,0.067
									c-4.2,0.007-8.4-0.004-12.598,0.006c-2.021,0.005-4.027-0.035-6.079,0.062c-1.063,0.05-2.611,0.065-3.876-0.044
									c-0.43-0.037-1.196-0.02-1.809-0.021c-2.416-0.002-4.834,0.005-7.247-0.003c-0.98-0.004-2.09,0.056-2.94-0.063L43.962,2.82
									c-2.992,0.167-6.134,0.049-9.196,0.072c-3.034,0.021-6.099,0.026-9.131-0.001c-4.16-0.037-8.193,0.104-12.345,0.09
									c-2.857-0.009-5.521-0.089-8.183-0.196C4.444,2.76,3.753,2.743,2.594,2.709"/>
                    </svg>
                </div>

                <div class="static">

                    <div class="logo medium-3 column">
                        <a href="<?php bloginfo('url'); ?>">
                            <object type="image/svg+xml" class="default-logo"
                            <?php $image = get_template_directory_uri().'/assets/img/compassion-logo-' .ICL_LANGUAGE_CODE.".svg"?>;
                           data="<?php echo $image?>">
						    <?php $imagepng = get_template_directory_uri().'/assets/img/compassion-logo-' .ICL_LANGUAGE_CODE.".png"?>;
                                <img src="<?php echo $imagepng?>"
                                     alt="No SVG support">
                            </object>
                             <object type="image/svg+xml" class="dark-logo"
                            <?php $imagedark = get_template_directory_uri().'/assets/img/compassion-logo-dark-' .ICL_LANGUAGE_CODE.".svg"?>;
                           data="<?php echo $imagedark ?>">
						    <?php $imagedarkpng = get_template_directory_uri().'/assets/img/compassion-logo-dark-' .ICL_LANGUAGE_CODE.".png"?>;
                                <img src="<?php echo $imagedarkpng?>"
                                     alt="No SVG support">
                            </object>
                        </a>
                    </div>
<?php 
	if( is_page( 'test-csp' )) { ?>

                    <nav class="medium-9 column nav">
                        <ul>
	                       <li><a href="<?php echo get_the_permalink(get_theme_mod("children-archive")); ?>" class="button button-blue button-small"><?php _e('schön', 'compassion'); ?></a>
                            </li>
                           	<li><a href="<?php echo get_the_permalink(get_theme_mod("spenden-seite")); ?>" class="button button-blue button-small"><?php _e('Spenden', 'compassion'); ?></a>
                            </li>
                            <li> <?php do_action('wpml_add_language_selector');?></li>
                            <li class="nav-link"><a href="#" class="off-canvas-toggle"><?php _e('Menü', 'compassion'); ?> <span></span></a>
                            </li>
                        </ul>
                    </nav>
<?php } else { ?>
 					 <nav class="medium-9 column nav">
                        <ul>
	                       <li><a href="<?php echo get_the_permalink(get_theme_mod("children-archive")). '?utm_event=sponsorshipheaderbutton'; ?>" class="button button-blue button-small"><?php _e('Werde Pate', 'compassion'); ?></a>
                            </li>
                           	<li><a href="<?php echo get_the_permalink(get_theme_mod("spenden-seite")); ?>" class="button button-blue button-small"><?php _e('Spenden', 'compassion'); ?></a>
                            </li>
                            <li><a href="<?php echo get_the_permalink(get_theme_mod("schreiben-seite")); ?>" class="button button-blue button-small"><?php _e('Briefe Schreiben', 'compassion'); ?></a>
                            </li>
                            <?php if ((ICL_LANGUAGE_CODE=='fr') OR (ICL_LANGUAGE_CODE=='de') OR (ICL_LANGUAGE_CODE=='it')):?>
                            <li><a href="<?php echo get_theme_mod("my_compassion"); ?>" class="button button-blue button-small"><?php _e('MyCompassion', 'compassion'); ?></a>
                            </li>
                            <?php endif; ?>
                            <li> <?php do_action('wpml_add_language_selector');?></li>
                            <li class="nav-link"><a href="#" class="off-canvas-toggle"><?php _e('Menü', 'compassion'); ?> <span></span></a>
                            </li>
                        </ul>
                    </nav>
<?php } ?>

                </div>
                
               

            </header>

            <?php
            $random_child = method_exists('CompassionChildren', 'get_random_child') ? CompassionChildren::get_random_child() : false;

            if ($random_child) :
                $child_meta = get_child_meta($random_child);
                ?>

                <div class="random-child-wrapper child closed">

                    <div class="random-child-image-wrapper">
                        <a href="#" class="random-child-toggle"></a>
                        <div class="image" style="background-image: url(<?php echo $child_meta['portrait']; ?>);"></div>
                       <!-- remove waiting day on child random <span
                            class="random-child-waiting child-waiting"><?php /*echo $child_meta['waiting_days']; */?></span>-->
                        <span class="text-uppercase name"><?php echo $child_meta['name']; ?></span>
                    </div>

                    <div class="random-child-content">
                        <a href="#" class="close random-child-toggle"></a>
                        <h4 class="svg-divider text-uppercase"><?php echo $child_meta['name']; ?></h4>
                        <ul>
                            <li>
                                <div class="single-icon icon-small">
                                    <object type="image/svg+xml"
                                            data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                             alt="No SVG support">
                                    </object>
                                </div>
                                <span><strong><?php _e('Land', 'compassion'); ?></strong>: <?php echo $child_meta['country']; ?></span>
                            </li>
                            <li>
                                <div class="single-icon icon-small">
                                    <object type="image/svg+xml"
                                            data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                             alt="No SVG support">
                                    </object>
                                </div>
                                <span><strong><?php _e('Alter', 'compassion'); ?></strong>: <?php echo $child_meta['age']; ?></span>
                            </li>
                            <li>
                                <div class="single-icon icon-small">
                                    <object type="image/svg+xml"
                                            data="<?php bloginfo('template_directory'); ?>/assets/img/person.svg">
                                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/person.png"
                                             alt="No SVG support">
                                    </object>
                                </div>
                                <span><strong><?php _e('Geschlecht', 'compassion'); ?></strong>
                                    : <?php echo $child_meta['gender']; ?></span>
                            </li>
                        </ul>

                        <div class="description">
                        </div>
                        <!-- 	  differents boutons de langue "parrainez" -->
                         <?php if(ICL_LANGUAGE_CODE=='de'): ?>
                        <a href="<?php echo $child_meta['permalink']; ?>" class="random-btn button button-blue button-medium"><?php _e('Werde', 'compassion'); ?> <?php echo $child_meta['name']; ?>s <?php _e('Pate', 'compassion'); ?></a>
                        <?php elseif(ICL_LANGUAGE_CODE=='fr'): ?>
                        <a href="<?php echo $child_meta['permalink']; ?>" class="random-btn button button-blue button-medium"><?php _e('Parrainez', 'compassion'); ?> <?php echo $child_meta['name']; ?> <?php _e('aujourd\'hui', 'compassion'); ?></a>
						<?php elseif(ICL_LANGUAGE_CODE=='it'): ?>
						<a href="<?php echo $child_meta['permalink']; ?>" class="random-btn button button-blue button-medium"><?php _e('Parrainez', 'compassion'); ?> <?php echo $child_meta['name']; ?> <?php _e('aujourd\'hui', 'compassion'); ?></a>
						 <?php endif; ?>                        
                    </div>

                </div>

            <?php endif; ?>
