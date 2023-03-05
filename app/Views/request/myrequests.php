<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Meine Anfragen</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <h4>Meine Anfragen</h4>

    <?php echo topmenu(); ?>
    <?php require_once('menu.php'); ?>

    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))) : ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
    <?php endif ?>

    <table>

      <tr>
        <td>
          Datum
        </td>
        <td>
          Art
        </td>
        <td>
          Status
        </td>
        <td>

        </td>
      </tr>

    <?php
      foreach ($requests as $request) {
    ?>
      <tr>
        <td>
          <?= $request->start_date ?> - <?= $request->end_date ?>
        </td>
        <td>
          <?= $request->request_type ?>
        </td>
        <td>
            <?= $request->status ?>
        </td>
        <td>
					<?= $request->numstatus == 4 ? "<a href=\"" . base_url('requests/' . $request->id) . "\">Bearbeiten</a>" :  "";  ?>

        </td>
      </tr>
    <?php
      }
    ?>
  </table>
</div>

</body>
