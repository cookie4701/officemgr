<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Offene Anfragen</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
  <div class="fluid-container">
    <h4>Offene Anfragen</h4>

    <?php echo topmenu(); ?>
    <?php require_once('menu.php'); ?>

		<div class="row">
			<div class="col-md-2">
				<a href="<?= base_url('requests/process?showall=1') ?>">Alle anzeigen</a>
			</div>
		</div>

    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?>  </div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))) : ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success'); ?>  </div>
    <?php endif ?>

    <div class="row">


        <div class="col-md-1">
          Mail
        </div>
        <div class="col-md-2">
          Datum
        </div>
        <div class="col-md-2">
          Art
        </div>

				<div class="col-md-2">
					Beschreibung
				</div>
        <div class="col-md-1">
          Status
        </div>
        <div class="col-md-2">

        </div>
				<div class="col-md-2">

        </div>
      </div>

    <?php
      foreach ($requests as $request) {
    ?>
      <div class="row">
        <div class="col-md-1">
          <?= $request->email ?>
        </div>
        <div class="col-md-2">
          <?= $request->start_date ?> - <?= $request->end_date ?>
        </div>
        <div class="col-md-2">
          <?= $request->request_type ?>
        </div>
				<div class="col-md-2">
					<?= $request->description ?>
				</div>
        <div class="col-md-1">
            <?= $request->status ?>
        </div>
        <div class="col-md-2">
          <form action="<?= base_url('requests/process') ?>" method="post" >
            <?= csrf_field(); ?>
						<input type="hidden" name="userid" value="<?= $request->requester ?>" />
            <input type="hidden" name="requestid" value="<?= $request->id ?>" />
            <select name="request_status" class="form-control">
              <?php
                foreach ($request_states as $request_status) {
                  $selected = '';
                  if ($request_status->id == $request->numstatus) $selected = 'selected';
                  echo "<option value=\"" . $request_status->id . "\" $selected>
                    $request_status->label
                  </option>";
                }
               ?>
            </select>
          </div>
          <div class="col-md-2">
                      <button class="form-control" type="submit">Speichern</button>
          </form>
        </div>
      </div>
    <?php
      }
    ?>
  </table>
</div>

</body>
