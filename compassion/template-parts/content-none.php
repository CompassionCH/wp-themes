<?php if ( is_search() ) : ?>

	<p class="not-found-text">
		<?php esc_html_e( 'Es wurden keine Beiträge zu Ihrer Suche gefunden.', 'compassion' ); ?>
	</p>

<?php else : ?>

	<p class="not-found-text">
		<?php esc_html_e( 'Es wurden keine Beiträge gefunden.', 'compassion' ); ?>
	</p>

<?php endif; ?>
