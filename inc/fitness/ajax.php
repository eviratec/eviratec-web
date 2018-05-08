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

add_action( 'wp_ajax_nopriv_eviratec_fitness', 'eviratec_fitness_nopriv_ajax' );
add_action( 'wp_ajax_eviratec_fitness', 'eviratec_fitness_ajax' );

function eviratec_fitness_nopriv_ajax () {
  $response = json_encode( $_REQUEST );

  header( 'Content-Type: application/json;charset=utf-8' );

  print json_encode( [
    'Error' => 'Login required',
    'Echo' => $response,
  ] );

  wp_die();
}

// wp-admin/admin-ajax.php?action=eviratec_fitness
function eviratec_fitness_ajax () {
  $response = json_encode( $_REQUEST );

  header( 'Content-Type: application/json;charset=utf-8' );

  try {
    switch ( $_REQUEST['type'] ) {
      case 'createWorkout':
        $response = FitnessCmd::createWorkout(
          $_REQUEST['summary']
        );
        break;

      case 'createExercise':
        $response = FitnessCmd::createExercise(
          $_REQUEST['workout_id'],
          $_REQUEST['exercise_type_id']
        );
        break;

      case 'createExerciseType':
        $response = FitnessCmd::createExerciseType(
          $_REQUEST['name']
        );
        break;

      case 'createEntry':
        $response = FitnessCmd::createEntry(
          $_REQUEST['exercise_id'],
          $_REQUEST['sets'],
          $_REQUEST['reps'],
          $_REQUEST['weight']
        );
        break;
    }

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
