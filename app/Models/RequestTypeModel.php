<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestTypeModel extends Model
{
  protected $table = 'request_types';
  protected $primaryKey = 'id';
  protected $allowedFields = ['label'];

  protected $returnType    = \App\Entities\RequestType::class;
}

?>
