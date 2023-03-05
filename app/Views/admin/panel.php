<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Adminpanel</title>
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
          <h4>Adminpanel</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
          <?php echo topmenu(); ?>
        </div>
    </div>


    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
      <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
          </div>
      </div>

    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))) : ?>
      <div class="row">
        <div class="col">
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
        </div>
      </div>

    <?php endif ?>

    <?php
		if (!isset($users)) exit;
      foreach ($users as $user) {


    ?>
      <div class="row">
        <div class="col-md-2">
          <?= $user['email'] ?>
        </div>
        <div class="col-md-8">

					<form action="<?= base_url('admin/modules') ?>" method="post" >

						<?= csrf_field(); ?>
						<input type="hidden" name="userid" value="<?= $user['id'] ?>" />
							<?php
							echo "<div class=\"form-group\">\n";
            foreach ($user['modules'] as $module) {
              if ($module['has'] == 1) {



								echo "<div class=\"form-check form-check-inline\"> \n";
                echo "<input class=\"form-control form-check-input\" id=\"c" . $module['id'] . "\" name=\"chk_module[]\" type=\"checkbox\" value=\"" . $module['id']  .  "\" checked /> <label class=\"form-check-label\" for=\"c" . $module['id'] . "\">" . $module['label'] . " </label>\n";
								echo "</div>\n";
              } else {
								echo "<div class=\"form-check form-check-inline\">\n";
                echo "<input class=\"form-control form-check-input\" id=\"c" . $module['id'] . "\" name=\"chk_module[]\" type=\"checkbox\" value=\"" . $module['id']  .  "\" /> <label class=\"form-check-label\" for=\"c" . $module['id'] . "\" /> " . $module['label'] . " </label>\n";
								echo "</div>\n";

              }
            }
						echo "</div>\n";
          ?>

        </div>
        <div class="col-md-1">
          <button type="submit">Speichern</button>
        </div>
      </div>

		</form>

    <?php
      }
    ?>



  </div>

</body>
