<?php get_header(); ?>

<div class="section background-blue section_abgerissen_unten has_breadcrumb">

    <div class="row section_breadcrumb">
        <?php compassion_breadcrumb(false); ?>
    </div>

    <div class="row section_row contains-nav">

        <div class="large-10 large-centered column">

            <h2 class="text-center"><?php _e('Suchergebnisse', 'compassion'); ?></h2>

        </div>

    </div>
</div>

<div class="section background-beige">

    <div class="row about">
        <div class="medium-10 medium-centered column">
            <ul>
            <?php

            if ( have_posts() ) :

                while ( have_posts() ) : the_post();
                    ?>

                        <?php get_template_part( 'template-parts/content', 'search-result' ); ?>

                    <?php

                endwhile;

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
            </ul>
        </div>
    </div>

</div>

<?php get_footer(); ?>
