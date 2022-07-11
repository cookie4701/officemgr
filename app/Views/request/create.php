<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Anfrage stellen</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

	<div class="container">
    <h4>Anfrage stellen</h4>

		<?php echo topmenu(); ?>
		<?php require_once('menu.php'); ?>

		<?php if (!empty(session()->getFlashdata('fail'))) : ?>
			<div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
		<?php endif ?>

		<?php if (!empty(session()->getFlashdata('success'))) : ?>
			<div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
		<?php endif ?>


		<form action="<?= base_url('requests') ?>" method="post" >
			<?= csrf_field(); ?>
			<div class="form-group">
        <label for="">Art der Anfrage</label>
        <select name="request_type" class="form-control">
          <?php
            foreach ($request_types as $request_type) {
              echo "<option value=\"" . $request_type->id . "\">
                $request_type->label
              </option>";
            }
           ?>
        </select>
        <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'request_type') : '' ?></span>
      </div>

      <div class="form-group">

				<input type="hidden" class="form-control" name="request_user" value="<?= $request_user; ?>" />

			</div>

			<div class="form-group">
				<label for="">Startdatum</label>
				<input type="text" class="form-control" name="start_date" value="<?= set_value('start_date'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'start_date') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Enddatum</label>
				<input type="text" class="form-control" name="end_date" value="<?= set_value('end_date'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'end_date') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Beschreibung (falls erforderlich)</label>
        <textarea name="description"><?= set_value('description'); ?></textarea>
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
			</div>


			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Anlegen</button>
			</div>

		</form>
	</div>

	<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
