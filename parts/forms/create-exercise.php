<div id="CreateExerciseForm"
  class="eviratec-web eviratec-form">
  <form>
    <p class="form-title">Create Exercise</p>

    <div class="form-field">
      <label for="ExerciseType">
        Exercise Type
      </label>

      <?php $exercise_types = FitnessQuery::getExerciseTypes(); ?>

      <select id="ExerciseType"
        name="ExerciseType">
        <option value="">Other</option>
        <?php if ($exercise_types->have_posts()) : ?>
          <?php while ($exercise_types->have_posts()) : ?>
            <?php $exercise_types->the_post(); ?>
            <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
          <?php endwhile; ?>
        <?php endif; ?>
      </select>
    </div>

    <div class="form-field">
      <label for="OtherExerciseType">
        Exercise Type (other)
      </label>

      <input id="OtherExerciseType"
        name="OtherExerciseType"
        placeholder="E.g. Deadlifts"
        value="">
    </div>

    <button id="CreateExercise">
      Create Exercise
    </button>
    <input name="form-id"
      type="hidden"
      value="create-exercise">
  </form>
</div>
