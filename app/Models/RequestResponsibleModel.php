<?php namespace App\Models;

use CodeIgniter\Model;

class RequestResponsibleModel extends Model
{
  protected $table = 'requests_responsibles';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user', 'request_type'];

  protected $returnType    = \App\Entities\RequestResponsible::class;
}

?>
