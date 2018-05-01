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

class FitnessCmd {
  public function __construct () {

  }

  public static function createWorkout ( $summary = 'New Workout' ) {
    $workout_id = null;

    $workout_id = wp_insert_post(array(
      'post_author'  => wp_get_current_user()->ID,
      'post_content' => $summary,
      'post_title'   => $summary,
      'post_status'  => 'publish',
      'post_type'    => 'workout',
    ));

    update_field( "workout_summary", $summary, $workout_id );

    return $workout_id;
  }

  public static function createExercise ( $workout_id, $exercise_type_id ) {
    $exercise_id = null;

    $exercise_id = wp_insert_post(array(
      'post_author'  => wp_get_current_user()->ID,
      'post_content' => 'Fitness_WorkoutExercise',
      'post_title'   => 'Fitness_WorkoutExercise',
      'post_status'  => 'publish',
      'post_type'    => 'workout_exercise',
    ));

    update_field( "workout_id", $workout_id, $exercise_id );
    update_field( "exercise_type_id", $exercise_type_id, $exercise_id );

    return $exercise_id;
  }

  public static function createEntry ( $exercise_id, $sets, $reps, $weight, $date = null ) {
    $entry_id = null;

    if (null === $date) {
      $date = now();
    }

    $entry_id = wp_insert_post(array(
      'post_author'  => wp_get_current_user()->ID,
      'post_content' => 'Fitness_WorkoutEntry',
      'post_title'   => 'Fitness_WorkoutEntry',
      'post_status'  => 'publish',
      'post_type'    => 'workout_entry',
    ));

    update_field( "exercise_id", $exercise_id, $entry_id );
    update_field( "entry_sets", $sets, $entry_id );
    update_field( "entry_reps", $reps, $entry_id );
    update_field( "entry_weight", $weight, $entry_id );

    return $entry_id;
  }

  public static function setEntrySets ( $entry_id, $new_value ) {

  }

  public static function setEntryReps ( $entry_id, $new_value ) {

  }

  public static function setEntryWeight ( $entry_id, $new_value ) {

  }

  public static function setEntryDate ( $entry_id, $new_value ) {

  }

  public static function deleteWorkout ( $workout_id ) {

  }

  public static function deleteExercise ( $exercise_id ) {

  }

  public static function deleteEntry ( $entry_id ) {

  }
}
