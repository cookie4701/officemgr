<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rechnung bearbeiten</title>
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
				<h4>Rechnung bearbeiten</h4>
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



				<form method="POST" action="<?= base_url('invoice/' . $invoice_id) ?>" id="invoice_form">
          <?= csrf_field(); ?>
          <div class="row">
    			<div class="form-group col-md-2">
            <input type="hidden" name="invoice_id" value="<?= $invoice_id ?>"
    				<label for="">Rechnungsdatum</label>
    				<input type="text" class="form-control" name="invoice_date" value="<?= set_value('invoice_date', $invoice_date) ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_date') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Empfänger (Organisation)</label>
    				<input type="text" class="form-control" name="invoice_rcpt" value="<?= set_value('invoice_rcpt', $invoice_rcpt); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Empfänger (Kontaktperson, falls vorhanden)</label>
    				<input type="text" class="form-control" name="invoice_rcpt_contact" value="<?= set_value('invoice_rcpt_contact', $invoice_rcpt_contact); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt_contact') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Adresse</label>
    				<input type="text" class="form-control" name="invoice_rcpt_address1" value="<?= set_value('invoice_rcpt_address1', $invoice_rcpt_address1) ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt_address1') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Adresse (weiter.)</label>
    				<input type="text" class="form-control" name="invoice_rcpt_address2" value="<?= set_value('invoice_rcpt_address2', $invoice_rcpt_address2); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt_address2') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Plz.</label>
    				<input type="text" class="form-control" name="invoice_rcpt_zip" value="<?= set_value('invoice_rcpt_zip', $invoice_rcpt_zip); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt_zip') : '' ?></span>
    			</div>

        </div>

        <div class="row">



          <div class="form-group col-md-2">
    				<label for="">Stadt</label>
    				<input type="text" class="form-control" name="invoice_rcpt_city" value="<?= set_value('invoice_rcpt_city', $invoice_rcpt_city); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt_city') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Land</label>
    				<input type="text" class="form-control" name="invoice_rcpt_country" value="<?= set_value('invoice_rcpt_country', $invoice_rcpt_country); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_rcpt_country') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Bemerkung</label>
    				<input type="text" class="form-control" name="invoice_remark" value="<?= set_value('invoice_remark', $invoice_remark); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_remark') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Aussteller</label>
    				<input type="text" class="form-control" name="invoice_issuer" value="<?= set_value('invoice_issuer', $invoice_issuer); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_issuer') : '' ?></span>
    			</div>

          <div class="form-group col-md-2">
    				<label for="">Status</label>
    				<input type="text" class="form-control" name="invoice_status" value="<?= set_value('invoice_status', $invoice_status); ?>" />
    				<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'invoice_status') : '' ?></span>
    			</div>

        </div>

				<div class="row">
  				<div class="form-group">
    				<button class="btn btn-primary btn-block" id="btnAdd" type="submit">Posten hinzufügen</button>
    			</div>
        </div>

				<div class="row post" id="positions">
					<div class="col-md-12">
						<table>
							<thead>
								<tr>
									<th> Pos. </th>
									<th> Beschreibung </th>
									<th> Anzahl </th>
									<th> Einheitspreis </th>
									<th > Total </th>
									<th> </th>
								</tr>
							</thead>
							<tbody id="posbody">

                <?php
                $idx = 0;
                foreach($items as $item) {
                  ++$idx;
                ?>
                <tr id="R<?= $item->position ?>">
          			<td class="row-index">
                  <input type="hidden" value="<?= $item->id ?>" name="row[<?= $item->position ?>][item_id]"/>
          				<div class="form-group">
                  <input type="text" name="row[<?= $item->position ?>][pos]" class="form-control" disabled size="3" value="<?= $item->position ?>" />
          				</div>

          			</td>

          			<td class="label">
          			<div class="form-group">
          			<input type="text" class="form-control" name="row[<?= $item->position ?>][label]" value="<?= $item->label ?>" />
          			<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'label') : '' ?></span>
          			</div>
          			</td>

          			<td class="item-amount">
          			<div class="form-group">
          			<input type="text" class="form-control" name="row[<?= $item->position ?>][item_amount]" value="<?= $item->amount ?>" />
          			<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'item_amount') : '' ?></span>
          			</div>
          			</td>

          			<td class="unit-price">
          			<div class="form-group">
          			<input type="text" class="form-control" name="row[<?= $item->position ?>][unit_price]" value="<?= $item->unit_price ?>" />
          			<span class="text-danger"> <?= isset($validation) ? display_error($validation, 'unit_price') : '' ?></span>
          			</div>
          			</td>

          			<td class="item-total">
          			<div class="form-group">
          			<input class="form-control" size="6" name="row[<?= $item->position ?>][subtotal]" disabled />
          			</div>
          			</td>

          			<td class="text-center">
          			<div class="form-group">
          				<button class="form-control btn btn-danger remove"
          			type="button">X</button>
          			</div>
          			</td>
          			</tr>

                <?php
                }
                 ?>

							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						Rechnungstotal EUR <span id="totalresult"></span>
					</div>
				</div>

        <div class="row">
  				<div class="form-group">
    				<button class="btn btn-primary btn-block" type="submit">Speichern</button>
    			</div>
        </div>


        </form>

		</div>


	</div>

	<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
			<script src="<?php echo base_url('js/app-invoice.js'); ?>"></script>
	<script>
	$( document ).ready(function() {

    pre_calc( $('#posbody') );
		calc_total( $('#posbody'), $('#totalresult')  );
		set_idx(<?= $idx ?>);

		// Handler for .ready() called.
		//var rowIdx = <?= $idx ?>;


	});

	</script>


</body>
