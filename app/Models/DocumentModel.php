<?php namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
  protected $table = 'postregister';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'document_type',
    'document_number',
    'post_date',
    'area',
    'description',
    'assignee'
  ];

  protected $returnType = \App\Entities\Document::class;
}

?>
