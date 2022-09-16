<?php

namespace App\Models;

use CodeIgniter\Model;

class PingModel extends SimpleModel
{
    protected $table      = 'ping';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['hash', 'descr', 'cron_code', 'expected_result', 'count'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
                        'hash'  => 'required|is_unique[ping.hash]',
                        'count' => 'permit_empty|integer',
                ];
    protected $validationMessages = [
                        'count' => [
                                'integer' => 'needs to be a number'
                            ],
                ];
    protected $skipValidation     = false;
    
}