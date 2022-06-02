<?php namespace App\Models;

use CodeIgniter\Model;

class MasterdataModel extends Model
{
  protected $table = 'masterdata_partners';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'orga_name',
    'address1',
    'address2',
    'zip',
    'city',
    'country',
    'vat',
    'phone',
    'contact_name',
    'contact_email'
  ];

  protected $returnType    = \App\Entities\Masterdata::class;
}

?>
