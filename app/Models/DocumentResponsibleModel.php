<?php namespace App\Models;

use CodeIgniter\Model;

class DocumentResponsibleModel extends Model
{
  protected $table = 'postregister_responsibles';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'user'
  ];

  protected $returnType = \App\Entities\DocumentResponsible::class;
}

?>
