<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Anmeldung</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

	<div class="container">
		<h4>Anmelden</h4>
		<?php if (!empty(session()->getFlashdata('fail'))) : ?>
			<div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
		<?php endif ?>

		<?php if (!empty(session()->getFlashdata('success'))) : ?>
			<div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
		<?php endif ?>
		
		<form action="<?= base_url('auth/check'); ?>" method="post">
			<?= csrf_field(); ?>
			<div class="form-group">
				<label for="">E-Mail Adresse</label>
				<input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
			</div>
			<div class="form-group">
				<label for="">Passwort</label>
				<input type="password" class="form-control" name="password" value="<?= set_value('password'); ?>" />
				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
			</div>
			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Login</button>
			</div>
			<br />
      <a href="<?= site_url('auth/register'); ?>" >Du hast noch kein Konto? Dann erstelle es jetzt!</a>
		</form>
	</div>

	<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
