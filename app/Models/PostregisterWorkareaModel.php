<?php namespace App\Models;

use CodeIgniter\Model;

class PostregisterWorkareaModel extends Model
{
  protected $table = 'postregister_workareas';
  protected $primaryKey = 'id';
  protected $allowedFields = ['workarea'];

  protected $returnType    = \App\Entities\PostregisterWorkarea::class;
}

?>
