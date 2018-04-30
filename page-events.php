<?php

if ( !is_user_logged_in() ) {
  wp_redirect( "/login" );
  exit;
}

get_header();

?>

  <main role="main">
    <!-- section -->
    <section>

      <h1>Event Log &gt; <?php the_title(); ?></h1>

      <?php
      $events = new WP_Query( array(
        'post_type'      => 'event',
        'posts_per_page' => 20,
        'author'         => wp_get_current_user()->ID,
        // 'meta_key'       => 'display_order',
        // 'orderby'        => 'meta_value',
        // 'order'          => 'ASC'
      ) );
      ?>

      <button id="LogEvent">
        New Event
      </button>

      <?php if ($events->have_posts()) : ?>
      <div class="content-cards">
        <ul class="cards">
        <?php while ($events->have_posts()) : ?>
          <?php $events->the_post(); ?>
            <li class="card">
              <a class="card-content"
                href="<?php the_permalink(); ?>"
                title="<?php the_title(); ?>">
                <div class="icon-container">
                  <span class="material-icons">
                    info_outline
                  </span>
                </div>
                <h2>
                  <span><?php echo get_the_title(); ?></span>
                  <span class="spacer"></span>
                  <span class="material-icons">
                    chevron_right
                  </span>
                </h2>
                <div class="card-text">
                  <p>
                    ...
                  </p>
                </div>
              </a>
            </li>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </ul>
      </div>
      <?php else : ?>
      <p>You haven't logged any events, yet.</p>
      <?php endif; ?>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

      <!-- article -->
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php the_content(); ?>

        <?php comments_template( '', true ); // Remove if you don't want comments ?>

        <br class="clear">

        <?php edit_post_link(); ?>

      </article>
      <!-- /article -->

    <?php endwhile; ?>

    <?php else: ?>

      <!-- article -->
      <article>

        <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

      </article>
      <!-- /article -->

    <?php endif; ?>

    <?php



    ?>

    </section>
    <!-- /section -->
  </main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
