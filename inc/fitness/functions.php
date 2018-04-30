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

require_once 'query.php';

function createWorkout ( $summary = 'New Workout' ) {
  $workout_id = null;

  return $workout_id;
}

function createExercise ( $workout_id, $exercise_type_id ) {
  $exercise_id = null;

  return $exercise_id;
}

function createEntry ( $exercise_id, $sets, $reps, $weight, $date = null ) {
  $entry_id = null;

  if (null === $date) {
    $date = now();
  }

  return $entry_id;
}

function setEntrySets ( $entry_id, $new_value ) {

}

function setEntryReps ( $entry_id, $new_value ) {

}

function setEntryWeight ( $entry_id, $new_value ) {

}

function setEntryDate ( $entry_id, $new_value ) {

}

function deleteWorkout ( $workout_id ) {

}

function deleteExercise ( $exercise_id ) {

}

function deleteEntry ( $entry_id ) {

}
