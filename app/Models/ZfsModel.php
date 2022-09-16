<?php

namespace App\Models;

use CodeIgniter\Model;

class ZfsModel extends SimpleModel
{
    protected $table      = 'zfs_info';
    protected $primaryKey = 'hash';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['server', 'name', 'size', 'free'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
    
}