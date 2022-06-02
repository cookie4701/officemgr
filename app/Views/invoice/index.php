<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rechnungen</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

	<div class="container bg-light">


		<div class="row">
			<div class="col-md-12">
				<h4>Rechnungen</h4>
			</div>
		</div>
    <div class="row">
			<div class="col-md-12">
				<?php if (!empty(session()->getFlashdata('fail'))) : ?>
					<div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
				<?php endif ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php if (!empty(session()->getFlashdata('success'))) : ?>
					<div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
				<?php endif ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php
					echo topmenu();
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php require_once('menu.php'); ?>
			</div>
		</div>

		<?php foreach($invoices as $invoice) { ?>
    <div class="row border-bottom mb-2">
      	<div class="col-md-1">
					<a href="<?= site_url('/invoice/' . $invoice->id) ?>">
						<?= $invoice->invoice_number ?>
					</a>
					
				</div>
				<div class="col-md-1">
					<?php echo $invoice->rcpt_orga; ?>
				</div>

				<div class="col-md-1">
					<?php echo $invoice->status; ?>
				</div>

				<div class="col-md-1">
					<a href="<?= site_url('invoice/pdf/' . $invoice->id) ?>" target="__BLANK">PDF erstellen </a>
				</div>
    </div>

	<?php } ?>


	</div>

	<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
