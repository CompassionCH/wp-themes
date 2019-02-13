<div class="section background-blue section_abgerissen_unten has_breadcrumb">

  <div class="row section_breadcrumb">
<!--     <?php compassion_breadcrumb(get_permalink( get_option( 'page_for_posts' ) )); ?> -->
    <a href="<?php bloginfo('url'); ?>/agenda/" class="back-to-overview"></a> 

  </div>

  <div class="row section_row">

    <div class="large-10 large-centered text-center column">

      <h2><?php the_title(); ?></h2>
<!-- 	 Affiche la date de début et de fin conditionnellement -->
	  <?php if ( get_post_meta($post->ID, '_agenda_date_agenda_fin', true) ) : ?>
      
      <h3><?php _e('Vom', 'compassion'); ?> <?php $text = get_post_meta(get_the_id(), '_agenda_date_agenda', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text)));?> <?php _e('bis', 'compassion'); ?> <?php  $text1 = get_post_meta(get_the_id(), '_agenda_date_agenda_fin', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text1)));
	      ?>
	      
	     </h3>
	    <?php else: ?>
	    
	     <h3><?php $text3 = get_post_meta(get_the_id(), '_agenda_date_agenda', true);
	      echo date("d.m.Y", strtotime(str_replace('.', '-', $text3)));   ?>
	   
	  </h3>
	  <?php endif ?>

    </div>

  </div>
</div>

<?php the_content(); ?>

<div class="article-footer">
  <div class="row">

    <div class="large-8 medium-8 medium-centered column">
      <div class="footer-content">
        <div class="large-6 medium-8 column">
          <div class="inline-row">
            <?php
            $categories = wp_get_post_terms($post->ID, 'categorie-cat');
            if ( ! empty( $categories ) ) {
                echo '<label>'.__('Kategorie', 'compassion').':</label>';
                echo '<a href="' . get_bloginfo('url').'/agenda/' . '?filter=' . $categories[0]->slug . '">' . esc_html( $categories[0]->name ) . '</a>';
            }
            ?>
          </div>
          <div class="inline-row">
            <?php
            $tags = get_the_tags();
            if ($tags) {
              echo '<label>'.__('Tags', 'compassion').':</label>';
              foreach($tags as $tag) {
                echo '<a href="' . get_the_permalink(get_bloginfo('url').'/agenda/') . '?tag=' . $tag->slug . '" class="tag">' . $tag->name . '</a> ';
              }
            }
            ?>
          </div>
        </div>

        <div class="large-6 medium-4 column">

          <div class="social-links">
            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" target="_blank" class="button-social facebook">
            </a>

            <a href="https://twitter.com/share?url=<?php the_permalink() ?>&text=<?php echo urlencode(get_the_title()) ?>" target="_blank" class="button-social twitter">
            </a>

            <a href="mailto:?Subject=<?php the_title(); ?>&amp;Body=<?php the_permalink(); ?>" class="button-social email">
            </a>
          </div>

        </div>
      </div>
    </div>
    </div>
  </div>
</div>
