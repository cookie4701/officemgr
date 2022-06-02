<?php namespace App\Models;

use CodeIgniter\Model;

class InvoiceItemsModel extends Model
{
  protected $table = 'invoice_item';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'invoice',
    'position',
    'label',
    'vat',
    'amount',
    'unit_price'
  ];

  protected $returnType = \App\Entities\InvoiceItem::class;
}

?>
