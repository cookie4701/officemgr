<?php namespace App\Models;

use CodeIgniter\Model;

class ModuleUserModel extends Model
{
  protected $table = 'module_user';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user', 'module'];

  protected $returnType    = \App\Entities\ModuleUser::class;
}

?>
