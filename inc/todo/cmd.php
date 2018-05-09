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

class TodoCmd {
  public function __construct () {

  }

  public static function createList ( $name, $parent_id = 0 ) {
    $list_id = null;

    $list_id = wp_insert_post(array(
      'post_author'  => wp_get_current_user()->ID,
      'post_content' => sanitize_text_field( $name ),
      'post_title'   => sanitize_text_field( $name ),
      'post_status'  => 'publish',
      'post_type'    => 'todo_list',
      'post_parent'  => (int) $parent_id
    ));

    update_field( 'list_parent_id', $parent_id, $list_id );
    update_field( 'list_name', $name, $list_id );

    return $list_id;
  }

  public static function createEntry ( $list_id, $summary ) {
    $entry_id = null;

    $entry_id = wp_insert_post(array(
      'post_author'  => wp_get_current_user()->ID,
      'post_content' => sanitize_text_field( $summary ),
      'post_title'   => sanitize_text_field( $summary ),
      'post_status'  => 'publish',
      'post_type'    => 'todo_entry',
    ));

    update_field( 'entry_list_id', $list_id, $entry_id );
    update_field( 'entry_summary', $summary, $entry_id );
    update_field( 'entry_done', '0', $entry_id );

    return $entry_id;
  }

  public static function setListName ( $list_id, $new_value ) {
    if ( wp_get_current_user()->ID !== get_the_author_meta( 'ID', $list_id ) ) {
      return;
    }
    update_field( 'list_name', sanitize_text_field( $new_value ), $list_id );
  }

  public static function setEntryDone ( $entry_id ) {
    if ( wp_get_current_user()->ID !== (int) get_the_author_meta( 'ID', $entry_id )->ID ) {
      return;
    }
    update_field( 'entry_done', time(), $entry_id );
  }

  public static function setEntryTodo ( $entry_id ) {
    if ( wp_get_current_user()->ID !== (int) get_the_author_meta( 'ID', $entry_id )->ID ) {
      return;
    }
    update_field( 'entry_done', '0', $entry_id );
  }

  public static function deleteList ( $list_id ) {
    if ( wp_get_current_user()->ID !== get_the_author_meta( 'ID', $list_id ) ) {
      return;
    }

  }

  public static function deleteEntry ( $entry_id ) {
    if ( wp_get_current_user()->ID !== get_the_author_meta( 'ID', $entry_id ) ) {
      return;
    }

  }
}
