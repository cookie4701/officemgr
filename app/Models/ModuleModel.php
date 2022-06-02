<?php namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
  protected $table = 'modules';
  protected $primaryKey = 'id';
  protected $allowedFields = ['module_name', 'module_path'];

  protected $returnType    = \App\Entities\Module::class;
}

?>
