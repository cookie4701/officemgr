<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

	<div class="container">
    <h4>Stammdaten verwalten</h4>

		<?php echo topmenu(); ?>
		<?php require_once('menu.php'); ?>

		<?php if (!empty(session()->getFlashdata('fail'))) : ?>
			<div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
		<?php endif ?>

		<?php if (!empty(session()->getFlashdata('success'))) : ?>
			<div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
		<?php endif ?>


		<form action="<?= base_url('masterdata/store') ?>" method="post" >
			<?= csrf_field(); ?>
			<div class="form-group">
				<label for="">Name der Firma</label>
				<input type="text" class="form-control" name="name_orga" value="<?= set_value('name_orga'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'name_orga') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Adresszeile 1</label>
				<input type="text" class="form-control" name="address1" value="<?= set_value('address1'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'address1') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Adresszeile 2</label>
				<input type="text" class="form-control" name="address2" value="<?= set_value('address2'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'address2') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Plz.</label>
				<input type="text" class="form-control" name="zip" value="<?= set_value('zip'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'zip') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Stadt / Ort</label>
				<input type="text" class="form-control" name="city" value="<?= set_value('city'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'city') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Land</label>
				<input type="text" class="form-control" name="country" value="<?= set_value('country'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'country') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">MWSt. Nummer (falls vorhanden)</label>
				<input type="text" class="form-control" name="vat" value="<?= set_value('vat'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'vat') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Telefonnummer</label>
				<input type="text" class="form-control" name="phone" value="<?= set_value('phone'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">Ansprechpartner (Name, Vorname und Titel falls vorhansden)</label>
				<input type="text" class="form-control" name="contact" value="<?= set_value('contact'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'contact') : '' ?></span>
			</div>

			<div class="form-group">
				<label for="">E-Mail Adresse Ansprechpartner</label>
				<input type="text" class="form-control" name="email_contact" value="<?= set_value('email_contact'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'email_contact') : '' ?></span>
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Anlegen</button>
			</div>

		</form>
	</div>

	<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
