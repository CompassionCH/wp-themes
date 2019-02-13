<div class="facts-grid">

  <div class="medium-4 column wrapper1">
    <div class="medium-12 column large-box box box1 <?php echo ($instance['box1']['pattern']) ? 'background-pattern' : ''; ?>" <?php echo (! empty($instance['box1']['image'])) ? 'style="background-image: url('.wp_get_attachment_url($instance['box1']['image']).');"' : ''; ?>>

      <div class="box-content">

        <div class="single-icon icon-small">
          <object type="image/svg+xml" data="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box1']['icon'] ?>.svg">
            <img src="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box1']['icon'] ?>.png" alt="">
          </object>
        </div>

        <div class="divider"></div>

        <p><?php echo $instance['box1']['text_before']; ?></p>

        <div class="number"><?php echo $instance['box1']['number']; ?></div>

        <p><?php echo $instance['box1']['text_after']; ?></p>

        <div class="divider"></div>

      </div>

    </div>

    <div class="medium-12 column small-box box box4 <?php echo ($instance['box4']['pattern']) ? 'background-pattern' : ''; ?>" <?php echo (! empty($instance['box4']['image'])) ? 'style="background-image: url('.wp_get_attachment_url($instance['box4']['image']).');"' : ''; ?>>

      <div class="box-content">

        <p><?php echo $instance['box4']['text_before']; ?></p>

        <div class="number-wrapper">
          <div class="single-icon icon-small">
            <object type="image/svg+xml" data="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box4']['icon'] ?>.svg">
              <img src="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box4']['icon'] ?>.png" alt="">
            </object>
          </div>

          <div class="number"><?php echo $instance['box4']['number']; ?></div>
        </div>

        <p><?php echo $instance['box4']['text_after']; ?></p>

      </div>

    </div>
  </div>

  <div class="medium-8 column wrapper2">
    <div class="medium-6 column small-box box box2 <?php echo ($instance['box2']['pattern']) ? 'background-pattern' : ''; ?>" <?php echo (! empty($instance['box2']['image'])) ? 'style="background-image: url('.wp_get_attachment_url($instance['box2']['image']).');"' : ''; ?>>

      <div class="box-content">

        <p><?php echo $instance['box2']['text_before']; ?></p>

        <div class="number-wrapper">
          <div class="single-icon icon-small">
            <object type="image/svg+xml" data="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box2']['icon'] ?>.svg">
              <img src="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box2']['icon'] ?>.png" alt="">
            </object>
          </div>

          <div class="number"><?php echo $instance['box2']['number']; ?></div>
        </div>

        <p><?php echo $instance['box2']['text_after']; ?></p>

      </div>

    </div>

    <div class="medium-6 column small-box box box3 <?php echo ($instance['box3']['pattern']) ? 'background-pattern' : ''; ?>" <?php echo (! empty($instance['box3']['image'])) ? 'style="background-image: url('.wp_get_attachment_url($instance['box3']['image']).');"' : ''; ?>>

      <div class="box-content">

        <p><?php echo $instance['box3']['text_before']; ?></p>

        <div class="number-wrapper">
          <div class="single-icon icon-small">
            <object type="image/svg+xml" data="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box3']['icon'] ?>.svg">
              <img src="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box3']['icon'] ?>.png" alt="">
            </object>
          </div>

          <div class="number"><?php echo $instance['box3']['number']; ?></div>
        </div>

        <p><?php echo $instance['box3']['text_after']; ?></p>

      </div>

    </div>

    <div class="medium-12 column large-box box box5 <?php echo ($instance['box5']['pattern']) ? 'background-pattern' : ''; ?>" <?php echo (! empty($instance['box5']['image'])) ? 'style="background-image: url('.wp_get_attachment_url($instance['box5']['image']).');"' : ''; ?>>

      <div class="box-content <?php echo ($instance['box5']['textalign']) ? 'align-left' : ''; ?>">

        <div class="single-icon icon-small">
          <object type="image/svg+xml" data="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box5']['icon'] ?>.svg">
            <img src="<?php bloginfo('template_directory'); ?>/assets/img/<?php echo $instance['box5']['icon'] ?>.png" alt="">
          </object>
        </div>

        <div class="divider"></div>

        <p><?php echo $instance['box5']['text_before']; ?></p>

        <div class="number"><?php echo $instance['box5']['number']; ?></div>

        <p><?php echo $instance['box5']['text_after']; ?></p>

        <div class="divider"></div>

      </div>

    </div>
  </div>

</div>
