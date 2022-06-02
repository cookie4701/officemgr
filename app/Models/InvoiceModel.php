<?php namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
  protected $table = 'invoices';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'rcpt_orga',
    'rcpt_contact',
    'rcpt_address1',
    'rcpt_address2',
    'rcpt_zip',
    'rcpt_city',
    'rcpt_country',
    'invoice_date',
    'invoice_number',
    'remark',
    'status',
    'issuer'
  ];

  protected $returnType = \App\Entities\Invoice::class;
}

?>
