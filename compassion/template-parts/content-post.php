<div class="section background-blue section_abgerissen_unten has_breadcrumb">

  <div class="row section_breadcrumb">
    <?php compassion_breadcrumb(get_permalink( get_option( 'page_for_posts' ) )); ?>
  </div>

  <div class="row section_row">

    <div class="large-10 large-centered column">

      <h2><?php the_title(); ?></h2>
      <h4>  <?php $seo_title = get_post_meta( get_the_ID(), '_posts_text', true );
  if ( !empty($seo_title)){
     echo $seo_title;
  }

 ?>  <h4 class="blog_date">  <?php the_date(); ?> </h4>

    </div>

  </div>
</div>

<?php the_content(); ?>

<div class="article-footer">
  <div class="row">

    <div class="large-8 medium-8 medium-centered column">
      <div class="footer-content">
        <div class="large-6 medium-8 column">
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
