<li class="card">
  <a class="card-content"
    href="/event/<?php the_ID(); ?>/"
    title="<?php the_title(); ?>">
    <!-- <div class="icon-container">
      <span class="material-icons">
        info_outline
      </span>
    </div> -->
    <div style="margin-right: 8px;line-height: 18px;">
      <?php the_time('H:i'); ?>
    </div>
    <div class="card-text">
      <h3>
        <span><?php echo get_the_title(); ?></span>
      </h3>
    </div>
    <span class="spacer"></span>
    <div style="margin-right: 8px;line-height: 18px;font-size:1.1em;color:rgba(0,0,0,0.87)">
      <?php echo get_field( 'transaction_amt', get_the_ID() ); ?>
    </div>
    <span class="material-icons">
      chevron_right
    </span>
  </a>
</li>
