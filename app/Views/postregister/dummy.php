<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Postregister</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

	<div class="container">
    <div class="row">
        <div class="col-md-12">
          <h4>Postregister verwalten</h4>
        </div>
    </div>


			<?php echo topmenu(); ?>
			<?php require_once('menu.php'); ?>

		<?php if (!empty(session()->getFlashdata('fail'))) : ?>
			<div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
		<?php endif ?>

		<?php if (!empty(session()->getFlashdata('success'))) : ?>
			<div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
		<?php endif ?>

    <div class="row">
      <div class="col-md-12">
        ...
      </div>
    </div>


	</div>

	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="<?php echo base_url('js/app-document.js'); ?>"></script>

  <script>
  $( document ).ready(function() {
    // local ready things for JavaScript
  });

  </script>
</body>
