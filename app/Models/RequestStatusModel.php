<?php namespace App\Models;

use CodeIgniter\Model;

class RequestStatusModel extends Model
{
  protected $table = 'request_status';
  protected $primaryKey = 'id';
  protected $allowedFields = ['label'];

  protected $returnType    = \App\Entities\RequestStatus::class;
}

?>
