<?php

namespace App\Controllers;

use App\Entity\Invoice;
use App\Libraries\Mypdf;
use \CodeIgniter\I18n\Time;

class InvoiceController extends BaseController
{
    public function __construct() {
      helper(['url', 'Form', 'form', 'Menu']);
    }

    public function index()
    {
      $invoice_model = new \App\Models\InvoiceModel();
      $invoices = $invoice_model->orderBy('invoice_number', 'DESC')->findAll();

      $data = [
        'invoices' => $invoices
      ];
      return view('invoice/index', $data);
    }

    public function create()
    {
      // gather masterdata for insertion
      $master_model = new \App\Models\MasterdataModel();
      $master_data = $master_model->orderBy('orga_name', 'ASC')->findAll();
      $data = [
        'master' => $master_data
      ];

      return view('invoice/create', $data);
    }

    public function update($id) {
      $validation = $this->validate([
        'invoice_date' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib das Rechnungsdatum an!'
          ]
        ],
        'invoice_rcpt_contact' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib den Empfänger ein!'
          ]
        ],
        'invoice_rcpt_address1' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Adresse an!'
          ]
        ],
        'invoice_rcpt_zip' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Postleitzahl ein!'
          ]
        ],
        'invoice_rcpt_city' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Ortschaft bzw. die Stadt ein!'
          ]
        ],

      ]);

      $invoice_model = new \App\Models\InvoiceModel();
      $ent_invoice = $invoice_model->find($id);
      $mdate = Time::parse($this->request->getVar('invoice_date'), 'Europe/Berlin', 'de_DE');
      $db_date = $mdate->toDateTimeString();
      $ent_invoice->invoice_date = $db_date;
      $ent_invoice->rcpt_orga = $this->request->getVar('invoice_rcpt');
      $ent_invoice->rcpt_contact = $this->request->getVar('invoice_rcpt_contact');
      $ent_invoice->rcpt_address1 = $this->request->getVar('invoice_rcpt_address1');
      $ent_invoice->rcpt_address2 = $this->request->getVar('invoice_rcpt_address2');
      $ent_invoice->rcpt_zip = $this->request->getVar('invoice_rcpt_zip');
      $ent_invoice->rcpt_city = $this->request->getVar('invoice_rcpt_city');
      $ent_invoice->rcpt_country = $this->request->getVar('invoice_rcpt_country');
      $ent_invoice->remark = $this->request->getVar('invoice_remark');
      $ent_invoice->status = $this->request->getVar('invoice_status') ? $this->request->getVar('invoice_status') : '' ;
      $ent_invoice->issuer_name = $this->request->getVar('invoice_issuer');

      $invoice_model->save($ent_invoice);

      $invoice_items_model = new \App\Models\InvoiceItemsModel();

      /*
      $invoice_items = $this->request->getPost([
        'pos',
        'label',
        'item_amount',
        'unit_price',
        'item_id',
        'vat'
      ]);
      */
      $invoice_items = $this->request->getPost('row');

      $invoice_ids = array();

      for ($k = 1; $k < count($invoice_items)+1; $k++ ) {
        if ( isset($invoice_items[$k]['item_id']) )
          $invoice_ids[] = $invoice_items[$k]['item_id'];
      }

      if (is_array($invoice_ids) && count($invoice_ids) > 0) {
        $invoice_items_model
          ->where('invoice', $id)
          ->whereNotIn('id', $invoice_ids)
          ->delete();
      } else if (isset($invoice_items['item_id'])) {
        $invoice_items_model
          ->where('invoice', $id)
          ->whereNotIn('id', [$invoice_items['item_id']] )
          ->delete();
      } else {
        // no items given, delete all
        $invoice_items_model
          ->where('invoice', $id)
          ->delete();
      }

      // check if anything left
      if (count($invoice_items) <= 0  )
        return redirect()
        ->to('/invoice/' . $id)
        ->with('success', 'Datensatz wurde gespeichert redirect simple');

      /*
      if (! is_array($invoice_items['item_id'])) {
        if (isset($ent)) unset($ent);
        $ent = null;

        if ($invoice_items['item_id'] <= 0 ) {
          // create new Entity
          $ent = new \App\Entities\InvoiceItem();

        } else {
          $ent = $invoice_items_model->find($invoice_items['item_id']);
        }

        $unit_price = $invoice_items['unit_price'];
        $unit_price = str_replace(',', '.', $unit_price);
        $unit_price = floatval($unit_price);
        log_message('critical', $unit_price);

        $ent->invoice = $id;
        $ent->position = $invoice_items['pos'];
        $ent->label = $invoice_items['label'];
        $ent->vat = $invoice_items['vat'];
        $ent->amount = $invoice_items['item_amount'];
        $ent->unit_price = $unit_price;

        if ($ent->hasChanged() ) $invoice_items_model->save($ent);

        return redirect()
        ->to('/invoice/' . $id)
        ->with('success', 'Datensatz wurde gespeichert');
      }
      */



      for ($i = 1; $i < count($invoice_items)+1; $i++ ) {
        if (isset($ent)) unset($ent);
        $ent = null;

        if (! isset($invoice_items[$i]['item_id']) || $invoice_items[$i]['item_id'] <= 0 ) {
          // create new Entity
          //session()->setFlashdata('success', 'new ent');
          $ent = new \App\Entities\InvoiceItem();

        } else {
          session()->setFlashdata('success', 'updating ent ' . $invoice_items[$i]['item_id']);
          $ent = $invoice_items_model->find($invoice_items[$i]['item_id']);

        }

        $unit_price = $invoice_items[$i]['unit_price'];

        $unit_price = str_replace(',', '.', $unit_price);
        $unit_price = floatval($unit_price);
        log_message('critical', $unit_price);
        session()->setFlashdata('success', 'id ' . $ent->invoice);
        $ent->invoice = $id;

        $ent->position = $invoice_items[$i]['pos'];
        $ent->label = $invoice_items[$i]['label'];

        if ( isset($invoice_items[$i]['vat']))
          $ent->vat = $invoice_items[$i]['vat'];
        else
          $ent->vat = 0.0;
        $ent->amount = $invoice_items[$i]['item_amount'];
        $ent->unit_price = $unit_price;

        if ($ent->hasChanged() ) $invoice_items_model->save($ent);

      }

      return redirect()
        ->to('/invoice/' . $id)
        ->with('success', 'Datensatz wurde gespeichert');
    }

    public function store()
    {
      $validation = $this->validate([
        'invoice_date' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib das Rechnungsdatum an!'
          ]
        ],
        'invoice_rcpt_contact' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib den Empfänger ein!'
          ]
        ],
        'invoice_rcpt_address1' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Adresse an!'
          ]
        ],
        'invoice_rcpt_zip' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Postleitzahl ein!'
          ]
        ],
        'invoice_rcpt_city' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Bitte gib die Ortschaft bzw. die Stadt ein!'
          ]
        ],
      ]);

      $invoice_model = new \App\Models\InvoiceModel();

      $inv_max = $invoice_model->orderBy('invoice_number', 'DESC')->first();

      $nbr = date('Y');
      $nbr .= '0001';
      if (isset($inv_max->invoice_number) ) {
          $nbr = $inv_max->invoice_number + 1;

          $start_nbr = substr($nbr, 0,4);
          $start_date = substr($inv_max->invoice_date,0, 4);

          if ($start_date != $start_nbr) {
            $nbr = $start_date . "0001";
          }
      }

      $ent_invoice = new \App\Entities\Invoice();

      $mdate = Time::parse($this->request->getVar('invoice_date'), 'Europe/Berlin', 'de_DE');
      $db_date = $mdate->toDateTimeString();

      $ent_invoice->invoice_date = $db_date;
      $ent_invoice->rcpt_orga = $this->request->getVar('invoice_rcpt');
      $ent_invoice->rcpt_contact = $this->request->getVar('invoice_rcpt_contact');
      $ent_invoice->invoice_number = $nbr;
      $ent_invoice->rcpt_address1 = $this->request->getVar('invoice_rcpt_address1');
      $ent_invoice->rcpt_address2 = $this->request->getVar('invoice_rcpt_address2');
      $ent_invoice->rcpt_zip = $this->request->getVar('invoice_rcpt_zip');
      $ent_invoice->rcpt_city = $this->request->getVar('invoice_rcpt_city');
      $ent_invoice->rcpt_country = $this->request->getVar('invoice_rcpt_country');
      $ent_invoice->remark = $this->request->getVar('invoice_remark');
      $ent_invoice->status = 'Offen';
      $ent_invoice->issuer_name = $this->request->getVar('invoice_issuer');

      $invoice_model->save($ent_invoice);
      $last_id = $invoice_model->getInsertID();


      $invoice_items = $this->request->getPost('row');

      $invoice_items_model = new \App\Models\InvoiceItemsModel();


      for ($i = 1; $i < count($invoice_items)+1; $i++ )
      {
        $ent = new \App\Entities\InvoiceItem();
        $ent->invoice = $last_id;
        $ent->position = $invoice_items[$i]['pos'];
        $ent->label = $invoice_items[$i]['label'];
        $ent->vat = 0.0;
        $ent->amount = floatval( str_replace(',', '.', $invoice_items[$i]['item_amount'])) ;
        $ent->unit_price = floatval( str_replace(',', '.', $invoice_items[$i]['unit_price'])) ;

        $invoice_items_model->save($ent);
      }
      return redirect()->to('invoice');
    }

    public function edit($id) {
      $invoice_model = new \App\Models\InvoiceModel();
      $invoice_items_model = new \App\Models\InvoiceItemsModel();

      $invoice = $invoice_model->find($id);

      if (!$invoice) {
        return redirect()->to('/invoice')->with('fail', 'Rechnung nicht gefunden');
      }

      $items = $invoice_items_model->where('invoice', $id)->orderBy('position', 'ASC')->findAll();
      foreach ($items as $item) {
        $item->unit_price = str_replace('.', ',', $item->unit_price);
      }
      $invoice_date = $mdate = Time::parse($invoice->invoice_date, 'America/Chicago', 'en_US');
      $invoice_date = $invoice_date->toLocalizedString('dd.MM.YYYY');
      $data = [
        'invoice_id' => $id,
        'invoice_date' => $invoice_date,
        'invoice_rcpt' => $invoice->rcpt_orga,
        'invoice_rcpt_contact' => $invoice->rcpt_contact,
        'invoice_rcpt_address1' => $invoice->rcpt_address1,
        'invoice_rcpt_address2' => $invoice->rcpt_address2,
        'invoice_rcpt_zip' => $invoice->rcpt_zip,
        'invoice_rcpt_city' => $invoice->rcpt_city,
        'invoice_rcpt_country' => $invoice->rcpt_country,
        'invoice_remark' => $invoice->remark,
        'invoice_status' => $invoice->status,
        'invoice_issuer' => $invoice->issuer_name,
        'items' => $items,
      ];


      return view('invoice/edit', $data);
    }

    public function pdf($id)
    {
      $invoice_model = new \App\Models\InvoiceModel();
      $invoice = $invoice_model->find($id);

      $invoice_items_model = new \App\Models\InvoiceItemsModel();
      $items = $invoice_items_model->where('invoice', $id)->orderBy('position', 'ASC')->findAll();

      //if ($invoice) session()->setFlashdata('success', 'Rechnung wurde gefunden');

      $pdf = new Mypdf();
      $pdf->setInvoice($invoice);
      $pdf->setInvoiceItems($items);
      $pdf->setFileName($invoice->invoice_number . '.pdf');

      if (! $pdf->toHtml()) return redirect()->to('/invoice')->with('fail', 'Konnte Rechnung nicht erstellen');
    }
}
