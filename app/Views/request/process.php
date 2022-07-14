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
        <div class="col-md-1">
          Datum
        </div>
        <div class="col-md-1">
          Art
        </div>
        <div class="col-md-1">
          Status
        </div>
        <div class="col-md-1">

        </div>
      </div>

    <?php
      foreach ($requests as $request) {
    ?>
      <div class="row">
        <div class="col-auto">
          <?= $request->email ?>
        </div>
        <div class="col-auto">
          <?= $request->start_date ?> - <?= $request->end_date ?>
        </div>
        <div class="col-auto">
          <?= $request->request_type ?>
        </div>
        <div class="col-auto">
            <?= $request->status ?>
        </div>
        <div class="col-auto">
          <form action="<?= base_url('requests/process') ?>" method="post" >
            <?= csrf_field(); ?>
						<input type="hidden" name="userid" value="<?= $request->requester ?>" />
            <input type="hidden" name="requestid" value="<?= $request->id ?>" />
            <select name="request_type" class="form-control">
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
          <div class="col-auto">
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
