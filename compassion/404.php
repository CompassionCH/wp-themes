<?php get_header(); ?>

<div class="row">
	<div class="small-12 columns error-page" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<header>
				<h2 class="entry-title"><?php _e( 'Willkommen auf unserer neuen Website!', 'compassion' ); ?></h2>
			</header>

			<div class="entry-content">

				<div class="error">
					<p class="bottom"><?php _e( 'Einiges hat sich verändern und es ist deswegen möglich, dass der Inhalt, den Sie suchen gelöscht oder verschoben wurde. <br/>
						Gerne können Sie unten im Menü auf der rechten Seite suchen oder uns kontaktieren.', 'compassion' ); ?></p>
				</div>

				<a href="<?php bloginfo( 'url' ); ?>"><?php esc_html_e( 'Zur Startseite', 'compassion' ) ?></a>
			</div>

		</article>

	</div>
</div>

<?php get_footer(); ?>
