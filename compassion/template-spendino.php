<?php

/*
 * Template Name: Spendino Formular
 */

get_header();
?>

<?php
while(have_posts()): the_post();
?>

    <?php the_content(); ?>

<?php endwhile; ?>


<div class="section background-white">

    <div class="spendino-donation-wrapper">
        <script src="https://api.spendino.de/admanager/forms/display/<?php echo $_GET['spendino']; ?>"></script>
    </div>

</div>


<?php get_footer(); ?>
