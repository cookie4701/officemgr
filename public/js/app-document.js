$(document).ready(function() {



  $('#btn_workarea').click( function(e) {
    e.preventDefault();
    store_workarea();
  });

  $('#upload_form').on('submit', function(e) {
    // $('.btn-success').html('sending');
    $('#submitfile').prop('disabled');

    e.preventDefault();


    if ($('#file_document').val() == '') {
      alert('Bitte wähle eine Datei!');
      $('#submitfile').prop('enabled');
      document.getElementById("upload_form").reset();
    } else {
      var obj = $.ajax({
        url: store_url,
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.success == true) {
            alert('Eintrag erfolgreich!');
            $('#submitfile').prop('enabled');
            document.getElementById("upload_form").reset();
            reloadDocumentTable();
          } else {
            alert('Es gab ein Problem: ' + res.msg);
          }
        }

      });
    }

  });

  loadDocuments();
  loadDoctypes();
  loadResponsibles();
  loadWorkareas();

});

function store_workarea() {
  var v = document.getElementById('workarea');
  var data = {
    workarea : $(v).val()
  };

  var obj = $.ajax({
    url: postregister_url + '/workarea',
    method: "POST",
    contentType: 'application/json; charset=utf-8',
    cache: false,
    processData: false,
    //dataType: 'json',
    data: JSON.stringify(data),
    success: function(res) {
      if (res.success == true) {
        // refresh
        alert('Daten wurden eingetragen');
        loadWorkareas();

      } else {
        alert('Es gab ein Problem: ' + res.msg);
      }
    }

  });
}

function loadWorkareas()
{
  var sel = document.getElementById('select_workarea');
  $(sel).empty();

  var obj = $.ajax({
    url: postregister_url + '/workarea',
    method: "GET",
    contentType: false,
    cache: false,
    processData: false,
    success: function(res) {
      if (res.success == true) {
        res.data.workareas.forEach((item, i) => {
            $(sel).append(`
              <option>${item.workarea}</option>
            `);
        });

      } else {
        alert('Es gab ein Problem: ' + res.msg);
      }
    }

  });
}

function loadResponsibles() {
  var sel = document.getElementById('select_responsible');
  var obj = $.ajax({
    url: postregister_url + '/responsibles',
    method: "GET",
    contentType: false,
    cache: false,
    processData: false,
    success: function(res) {
      if (res.success == true) {
        res.data.responsibles.forEach((item, i) => {
          if (item.friendly_name !== null && item.friendly_name !== '') {
            $(sel).append(`
            <option>${item.friendly_name}</option>
            `);
          } else {
            $(sel).append(`
            <option>${item.email}</option>
            `);
          }

        });

      } else {
        alert('Es gab ein Problem: ' + res.msg);
      }
    }

  });
}

function loadDoctypes() {
  var sel = document.getElementById('select_type');
  var obj = $.ajax({
    url: doctypes_url,
    method: "GET",
    contentType: false,
    cache: false,
    processData: false,
    success: function(res) {
      if (res.success == true) {
        res.data.forEach((item, i) => {
          $(sel).append(`
          <option>${item}</option>
          `);
        });

      } else {
        alert('Es gab ein Problem: ' + res.msg);
      }
    }

  });

}

function reloadDocumentTable() {
  var table = document.getElementById('document_table');
  $(table).empty();
  loadDocuments();
}

function loadDocuments() {
  var table = document.getElementById('document_table');

  var obj = $.ajax({
    url: document_url,
    method: "GET",
    contentType: false,
    cache: false,
    processData: false,
    success: function(res) {
      if (res.success == true) {
        res.data.forEach((item, i) => {
          $(table).append(`
          <div class="row">
            <div class="col-md-2">
              ${item.document_type}
            </div>

            <div class="col-md-2">
              <a href="${postregister_url}/download_pdf/${item.id}" target="__BLANK">
              ${item.document_number}
              </a>
            </div>

            <div class="col-md-2">
              ${item.post_date}
            </div>

            <div class="col-md-2">
              ${item.area}
            </div>

            <div class="col-md-2">
              ${item.assignee}
            </div>

            <div class="col-md-2">
              ${item.description}
            </div>

          </div>
          `);
        });


      } else {
        alert('Es gab ein Problem: ' + res.msg);
      }
    }

  });

}

function addRow() {
  var table = document.getElementById('document_table');
  $(table).append('<div class=\'col-md-1\'>foo</div>');
  console.log('clicked');

}

function set_url(u) {
  store_url = u;
}

function set_document_url(u) {
  document_url = u;
}
