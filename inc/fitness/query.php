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

class FitnessQuery {
  public function __construct () {

  }
  public static function getWorkouts ( $query = array() ) {
    return new WP_Query( array_merge(
      array ( 'posts_per_page' => 100 ),
      $query,
      array(
        'post_type'      => 'workout',
        'author'         => wp_get_current_user()->ID,
      )
    ) );
  }
  public static function getExercisesByWorkout ( $workout_id, $query = array() ) {
    return new WP_Query( array_merge(
      array ( 'posts_per_page' => 100 ),
      $query,
      array(
        'post_type'      => 'workout_exercise',
        'author'         => wp_get_current_user()->ID,
        'meta_key'       => 'workout_id',
        'meta_value'     => (int) $workout_id,
      )
    ) );
  }
  public static function getEntriesByExercise ( $exercise_id, $query = array() ) {
    return new WP_Query( array_merge(
      array ( 'posts_per_page' => 100 ),
      $query,
      array(
        'post_type'      => 'workout_entry',
        'author'         => wp_get_current_user()->ID,
        'meta_key'       => 'exercise_id',
        'meta_value'     => (int) $exercise_id,
      )
    ) );
  }
  public static function getExercisesByExerciseType ( $exercise_type_id, $query = array() ) {
    return new WP_Query( array_merge(
      array ( 'posts_per_page' => 100 ),
      $query,
      array(
        'post_type'      => 'workout',
        'author'         => wp_get_current_user()->ID,
        'meta_key'       => 'exercise_type_id',
        'meta_value'     => (int) $exercise_type_id,
      )
    ) );
  }
  public static function getExerciseTypes ( $query = array() ) {
    return new WP_Query( array_merge(
      array ( 'posts_per_page' => 100 ),
      $query,
      array(
        'post_type'      => 'exercise_type',
        'author'         => wp_get_current_user()->ID,
      )
    ) );
  }
}
