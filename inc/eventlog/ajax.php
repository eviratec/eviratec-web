<?php
/**
 * Copyright (c) 2018 Callan Peter Milne
 *
 * Permission to use, copy, modify, and/or distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED 'AS IS' AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
 * REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
 * INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
 * LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
 * OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
 * PERFORMANCE OF THIS SOFTWARE.
 */

add_action( 'wp_ajax_nopriv_eviratec_eventlog', 'eviratec_eventlog_nopriv_ajax' );
add_action( 'wp_ajax_eviratec_eventlog', 'eviratec_eventlog_ajax' );

function eviratec_eventlog_nopriv_ajax () {
  $response = json_encode( $_REQUEST );

  header( 'Content-Type: application/json;charset=utf-8' );

  print json_encode([
    'Error' => 'Login required',
    'Echo' => $response,
  ]);

  wp_die();
}

// wp-admin/admin-ajax.php?action=eviratec_eventlog
function eviratec_eventlog_ajax () {
  $response = json_encode( $_REQUEST );



  try {
    switch ( $_REQUEST['type'] ) {
      case 'createEvent':
        $response = EventLogCmd::createEvent(
           $_REQUEST['summary'],
           explode( ',', $_REQUEST['tags'] )
        );
        break;

      case 'getEvents':
        // &type=getEvents&offset=8
        $events = EventLogQuery::getEvents( [
          'offset' => $_REQUEST['offset'],
        ] );
        // $response = [
        //   $events->posts,
        //   $events->post_count,
        // ];
        header( 'Content-Type: text/html;charset=utf-8' );
        ?>
        <?php if ($events->have_posts()) : while ($events->have_posts()) : ?>
          <?php $events->the_post(); ?>
            <?php if ( !in_array( get_the_time('l, M j'), $days ) ) : ?>
            <?php $days[count($days)] = get_the_time('l, M j'); ?>
            <li class="card-group-heading">
              <h3>
                <span><?php the_time('l, M j'); ?></span>
              </h3>
            </li>
            <?php endif; ?>
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
                  <!-- <p>
                    <?php the_time('l, M t'); ?>
                  </p> -->
                </div>
                <span class="spacer"></span>
                <span class="material-icons">
                  chevron_right
                </span>
              </a>
            </li>
          <?php endwhile; endif; ?>
      <?php
      wp_die();
    }

    header( 'Content-Type: application/json;charset=utf-8' );

    print json_encode( [
      'Success' => true,
      'Result' => $response,
      'Echo' => json_encode( $_REQUEST ),
    ] );
  }
  catch (Exception $e) {
    print json_encode( [
      'Error' => true,
      'Message' => $e->getMessage(),
    ] );
  }

  wp_die();
}
