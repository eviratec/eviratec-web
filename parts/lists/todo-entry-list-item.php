<li class="card todo-entry <?php if ( '1' === get_field( 'entry_done', get_the_ID() ) ) : ?>entry-done<?php endif; ?>">
  <a class="card-content"
    href="/todo-entry/<?php the_ID(); ?>/"
    title="<?php the_title(); ?>">
    <div class="icon-container entry-todo-toggle">
      <span class="material-icons">
        <?php if ( '0' === get_field( 'entry_done', get_the_ID() ) ) : ?>
          check_box_outline_blank
        <?php elseif ( '1' === get_field( 'entry_done', get_the_ID() ) ) : ?>
          check_box
        <?php endif; ?>
      </span>
    </div>
    <div class="card-text">
      <h3>
        <span><?php echo get_the_title(); ?></span>
      </h3>
      <!-- <p>
        <?php the_time('g:i a l, M t'); ?>
      </p> -->
    </div>
    <span class="spacer"></span>
    <span class="material-icons">
      chevron_right
    </span>
  </a>
</li>
