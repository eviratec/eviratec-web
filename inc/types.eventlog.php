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

class EventLogPostTypes {
  public function __construct () {
    add_action( 'init', array( $this, 'registerPostTypes'));
  }
  public function registerPostTypes () {
    $this->registerEventsPostType();
    $this->registerEventTagTaxa();
  }
  private function registerEventsPostType () {
    $this->registerPostType(array(
      'label_single'     => 'Event',
      'label_single_lc'  => 'event',
      'label_multi'      => 'Events',
      'label_multi_lc'   => 'events',
      'name'             => 'event',
      'slug'             => 'event',
      'type_name'        => 'event'
    ));
  }
  private function registerEventTagTaxa () {
    $this->registerTaxa('event', array(
      'label_single'     => 'Event Tag',
      'label_single_lc'  => 'event tag',
      'label_multi'      => 'Event Tags',
      'label_multi_lc'   => 'event tags',
      'name'             => 'event_tag',
      'slug'             => 'event_tag',
      'type_name'        => 'event_tag'
    ));
  }
  private function registerTaxa ($postType, $d) {
    $labels = array(
      'name'                       => _x( sprintf('%s', $d['label_multi']), 'taxonomy general name', 'textdomain' ),
      'singular_name'              => _x( sprintf('%s', $d['label_single']), 'taxonomy singular name', 'textdomain' ),
      'search_items'               => __( sprintf('Search %s Name', $d['label_multi']), 'textdomain' ),
      'popular_items'              => __( sprintf('Popular %s Name', $d['label_multi']), 'textdomain' ),
      'all_items'                  => __( sprintf('All %s Name', $d['label_multi']), 'textdomain' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( sprintf('Edit %s', $d['label_single']), 'textdomain' ),
      'update_item'                => __( sprintf('Update %s', $d['label_single']), 'textdomain' ),
      'add_new_item'               => __( sprintf('Add New %s', $d['label_single']), 'textdomain' ),
      'new_item_name'              => __( sprintf('New %s Name', $d['label_single']), 'textdomain' ),
      'separate_items_with_commas' => __( sprintf('Separate %s with commas', $d['label_multi_lc']), 'textdomain' ),
      'add_or_remove_items'        => __( sprintf('Add or remove %s', $d['label_multi_lc']), 'textdomain' ),
      'choose_from_most_used'      => __( sprintf('Choose from the most used %s', $d['label_multi_lc']), 'textdomain' ),
      'not_found'                  => __( sprintf('No %s found.', $d['label_multi_lc']), 'textdomain' ),
      'menu_name'                  => __( sprintf('%s', $d['label_multi']), 'textdomain' ),
    );

    $args = array(
      'hierarchical'          => false,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => $d['slug'] ),
    );

    register_taxonomy( $d['name'], $postType, $args );
  }
  private function registerPostType ($d) {

    $labels = array(
      'name'               => _x( $d['label_multi'], 'post type general name', 'eviratec' ),
      'singular_name'      => _x( $d['label_single'], 'post type singular name', 'eviratec' ),
      'menu_name'          => _x( $d['label_multi'], 'admin menu', 'eviratec' ),
      'name_admin_bar'     => _x( $d['label_single'], 'add new on admin bar', 'eviratec' ),
      'add_new'            => _x( 'Add New', $d['name'], 'eviratec' ),
      'add_new_item'       => __( sprintf('Add New %s', $d['label_single']), 'eviratec' ),
      'new_item'           => __( sprintf('New %s', $d['label_single']), 'eviratec' ),
      'edit_item'          => __( sprintf('Edit %s', $d['label_single']), 'eviratec' ),
      'view_item'          => __( sprintf('View %s', $d['label_single']), 'eviratec' ),
      'all_items'          => __( sprintf('All %s', $d['label_multi']), 'eviratec' ),
      'search_items'       => __( sprintf('Search %s', $d['label_multi']), 'eviratec' ),
      'parent_item_colon'  => __( sprintf('Parent %s:', $d['label_multi']), 'eviratec' ),
      'not_found'          => __( sprintf('No %s found.', $d['label_multi_lc']), 'eviratec' ),
      'not_found_in_trash' => __( sprintf('No %s found in Trash.', $d['label_multi_lc']), 'eviratec' )
    );
    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'eviratec' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      // 'show_in_menu'    => 'eviratec',
      'show_in_nav_menus'  => false,
      'show_in_admin_bar'  => false,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => $d['slug'] ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'supports'           => array( 'title', 'comments', 'editor' )
    );

    register_post_type( $d['type_name'], $args );

  }
}

new EventLogPostTypes();
