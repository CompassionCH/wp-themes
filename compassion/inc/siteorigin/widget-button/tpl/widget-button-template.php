
<?php if( $instance['center'] ) : ?>
  <div class="button-center-wrapper">
<?php endif; ?>

<a href="<?php echo $instance['href']; ?>" class="button <?php echo $instance['color']; ?> <?php echo ($instance['center']) ? 'button-center' : ''; ?> <?php echo $instance['size'] ?>"><?php echo $instance['title']; ?></a>

<?php if( $instance['center'] ) : ?>
  </div>
<?php endif; ?>
