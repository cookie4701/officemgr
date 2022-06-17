var rowIdx = 0;


$(document).ready(function() {


  // Handler for .ready() called.
  rowIdx = 0;

  $('form').submit(function(e) {
    $(':disabled').each(function(e) {
      $(this).removeAttr('disabled');
    })
  });

  $('#btnAdd').on('click', function(e) {

    e.preventDefault();
    // Adding a row inside the tbody.
    $('#posbody').append(`<tr id="R${++rowIdx}">
    <td class="row-index">
      <div class="form-group">
      <input type="text" name="pos[]" class="form-control" disabled size="3" value="${rowIdx}" />
      </div>

    </td>

    <td class="label">
    <div class="form-group">
    <input type="text" class="form-control" name="label[]" />

    </div>
    </td>

    <td class="item-amount">
    <div class="form-group">
    <input type="text" class="form-control" name="item_amount[]"  />
    </div>
    </td>

    <td class="unit-price">
    <div class="form-group">
    <input type="text" class="form-control" name="unit_price[]" " />

    </div>
    </td>

    <td class="item-total">
    <div class="form-group">
    <input class="form-control" size="6" name="subtotal[]" disabled />
    </div>
    </td>

    <td class="text-center">
    <div class="form-group">
      <button class="form-control btn btn-danger remove"
    type="button">X</button>
    </div>
    </td>
    </tr>`);

    $('#posbody tr').focusout(
      function() {
        calc_row_result($(this));
        calc_total($('#posbody'), $('#totalresult'));
      }
    );

    return false;
  });

  $('#posbody').on('click', '.remove', function() {

    // Getting all the rows next to the
    // row containing the clicked button
    var child = $(this).closest('tr').nextAll();

    // Iterating across all the rows
    // obtained to change the index
    child.each(function() {

      // Getting <tr> id.
      var id = $(this).attr('id');


      // Getting the <p> inside the .row-index class.
      //var idx = $(this).children('.row-index').children('input');
      var idx = $(this).children('.row-index').children('.form-group').children('input');

      // Gets the row number from <tr> id.
      var dig = parseInt(id.substring(1));


      // Modifying row index.
      //idx.html(`${dig - 1}`);
      idx.val(`${dig - 1}`);

      // Modifying row id.
      $(this).attr('id', `R${dig - 1}`);
    });

    // Removing the current row.
    $(this).closest('tr').remove();

    // Decreasing the total number of rows by 1.
    rowIdx--;

    // Recalc
    calc_total($('#posbody'), $('#totalresult'));
  });


  $('#btnorga').on('click', function(e) {
    var id_selected = $('#masterdata').val();

    // url: "<?= site_url('masterdata/ajax/') ?>" + id_selected,
    $.ajax({
      url: "/masterdata/ajax/" + id_selected,
      type: 'get',
      success: function(data) {
        var result = JSON.parse(data);
        $('#invoice_rcpt').val(result['orga_name']);
        $('#invoice_rcpt_contact').val(result['contact_name']);
        $('#invoice_rcpt_address1').val(result['address1']);
        $('#invoice_rcpt_address2').val(result['address2']);
        $('#invoice_rcpt_zip').val(result['zip']);
        $('#invoice_rcpt_country').val(result['country']);
        $('#invoice_rcpt_city').val(result['city']);
        // TBC
      }
    });
  });


});

function pre_calc(obj) {
  var r = obj.find('tr');

  for (var i = 0; i < r.length; i++) {
    calc_row_result($(r[i]));
  }
}

function calc_row_result(obj) {
  var row = obj.closest('tr');
  var amount = row.find("td:eq(2) input[type=text]").val();
  var unitprice = row.find("td:eq(3) input[type=text]").val();

  amount = amount.replace(',', '.');
  amount = parseFloat(amount);

  unitprice = unitprice.replace(',', '.');
  unitprice = parseFloat(unitprice);

  totalprice = amount * unitprice;
  totalprice = totalprice.toFixed(2);
  totalprice = totalprice.replace('.', ',');

  if (totalprice !== 'NaN') {
    //row.find("td:eq(4) span").text(totalprice);
    row.find("td:eq(4) input").val(totalprice);
  } else {
    //row.find("td:eq(4) span").text('');
    row.find("td:eq(4) input").val('');
  }

}

function set_idx(new_index) {

  rowIdx = new_index;
}

function calc_total(objtable, objoutput) {
  var totalprice = 0.0;
  objtable.find('tr').each(function(index, domobj) {
    var oo = $(domobj);
    var row_amount = oo.find("td:eq(2) input[type=text]").val();
    var row_unitprice = oo.find("td:eq(3) input[type=text]").val();

    row_amount = row_amount.replace(',', '.');
    row_amount = parseFloat(row_amount);

    row_unitprice = row_unitprice.replace(',', '.');
    row_unitprice = parseFloat(row_unitprice);

    var row_total = row_unitprice * row_amount;
    totalprice += row_total;
  });

  totalprice = totalprice.toFixed(2);
  totalprice = totalprice.replace('.', ',');

  if (totalprice !== 'NaN') {
    objoutput.text(totalprice);
  } else {
    objoutput.text('');
  }
}
