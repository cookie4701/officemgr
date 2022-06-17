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

      <div class="row">
        <div class="col-md-12">


		<?php if (!empty(session()->getFlashdata('fail'))) : ?>
			<div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
		<?php endif ?>

		<?php if (!empty(session()->getFlashdata('success'))) : ?>
			<div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
		<?php endif ?>
  </div>
  </div>

<form method="POST" action="<?= base_url('postregister') ?>" enctype="multipart/form-data" id="upload_form">
    <div class="row">


        <?= csrf_field(); ?>

          <div class="col-md-4 form-group">
            <label for="">Datum Dokument</label>
            <input type="text" class="form-control" name="document_date" value="<?= set_value('document_date'); ?>" />
            <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'document_date') : '' ?></span>
          </div>

          <div class="col-md-4 form-group">
            <label for="">Art</label>
            <select id="select_type" name="select_type" class="form-control">

            </select>
            <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'select_type') : '' ?></span>
          </div>

          <div class="col-md-4 form-group">
            <label for="">Bereich</label>
            <select id="select_workarea" name="select_workarea" class="form-control">
              <option>
                A
              </option>
            </select>
            <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'select_type') : '' ?></span>
          </div>

          <div class="col-md-4 form-group">
            <label for="">Beschreibung</label>
            <textarea class="form-control" name="description" ><?= set_value('description'); ?></textarea>
            <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
          </div>

          <div class="col-md-4 form-group">
            <label for="">Zuständig</label>
            <select id="select_responsible" name="responsible" class="form-control">
              
            </select>
            <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'responsible') : '' ?></span>
          </div>

          <div class="col-md-4 form-group">
            <label for="">Datei</label>
            <input type="file" class="form-control" name="file_document" id="file_document"  />
            <span class="text-danger"> <?= isset($validation) ? display_error($validation, 'file_document') : '' ?></span>
          </div>

          <div class="col-md-4 form-group">
            <button id="submitfile" class="form-control btn btn-primary">Speichern</button>
          </div>

      </div>
</form>

		<div class="row">
			<div class="col-md-2">
				Dokumentart
			</div>

			<div class="col-md-2">
				Dokument Nummer
			</div>

			<div class="col-md-2">
				Datum
			</div>

			<div class="col-md-2">
				Bereich
			</div>

			<div class="col-md-2">
				Zuständig
			</div>

			<div class="col-md-2">
				Beschreibung
			</div>

		</div>

		<div class="row">
			<div class="col-md-2">
				Filter Art
			</div>

			<div class="col-md-2">

			</div>

			<div class="col-md-2">
				Filter Von Bis
			</div>

			<div class="col-md-2">
				Filter Bereich
			</div>

			<div class="col-md-2">
				Filter Zuständig
			</div>

			<div class="col-md-2">

			</div>

		</div>

		<div id="document_table">

    </div>


	</div>

	<script>
	var postregister_url = "<?php echo base_url(); ?>/postregister";
	var document_url = "<?php echo base_url(); ?>/postregister/docs";
	var doctypes_url = "<?php echo base_url(); ?>/postregister/doctypes";
	</script>

	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="<?php echo base_url('js/app-document.js'); ?>"></script>

  <script>
  $( document ).ready(function() {

		set_url("<?php echo base_url(); ?>/postregister");

  });

  </script>
</body>
