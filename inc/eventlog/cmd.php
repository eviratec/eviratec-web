<?php
/**
 * Copyright (c) 2018 Callan Peter Milne
 *
 * Permission to use, copy, modify, and/or distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
 * REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
 * INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
 * LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
 * OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
 * PERFORMANCE OF THIS SOFTWARE.
 */

class EventLogCmd {
  public function __construct () {

  }
  public static function createEvent ( $summary = 'Did/went/found ...', $tags = array() ) {
    $event_id = null;

    $event_id = wp_insert_post(array(
      'post_author'  => wp_get_current_user()->ID,
      'post_content' => $summary,
      'post_title'   => $summary,
      'post_status'  => 'publish',
      'post_type'    => 'event',
    ));

    update_field( "event_summary", $summary, $event_id );
    update_field( "event_tags", json_encode( $summary ), $event_id );

    return $event_id;
  }

  public static function setEventSummary ( $event_id, $new_value ) {
    update_field( "event_summary", $new_value, $event_id );
  }

  public static function setEventTags ( $event_id, $new_value ) {
    update_field( "event_tags", json_encode( $new_value ), $event_id );
  }

  public static function deleteEvent ( $event_id ) {

  }
}
