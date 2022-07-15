<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Übersicht Anfragen</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h4>Übersicht Anfragen</h4>

    <?php echo topmenu(); ?>
    <?php require_once('menu.php'); ?>

    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))) : ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
    <?php endif ?>


    <?php if (! empty($events) ) : ?>
      <?php foreach ($events as $event ) { ?>
        <div class="row">
          <div class="col-auto">
            <?= $event->start_date ?> - <?= $event->end_date ?>
          </div>

          <div class="col-auto">
            <?= $event->label ?>
          </div>

          <div class="col-auto">
            <?= $event->email ?>
          </div>

          <div class="col-auto">
            <?= $event->description ?>
            
          </div>

        </div>
      <?php } ?>
    <?php endif ?>

  </div>
</body>
