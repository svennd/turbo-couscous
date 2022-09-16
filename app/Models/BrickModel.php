<?php

namespace App\Models;

use CodeIgniter\Model;

class BrickModel extends SimpleModel
{
    protected $table      = 'brick_info';
    protected $primaryKey = 'hash';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['hash', 'server', 'pool', 'avail', 'used', 'brick', 'snapshots'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
    
    public function insert_or_update($data)
    {
        $sql = "
        INSERT INTO 
            `" . $this->table. "` 
                (hash, server, pool, brick, avail, used, snapshots, updated_at, created_at)
            VALUES
                (
                    " . $this->db->escape($data['hash']) . ",
                    " . $this->db->escape($data['server']) . ",
                    " . $this->db->escape($data['pool']) . ",
                    " . $this->db->escape($data['brick']) . ",
                    " . $this->db->escape($data['avail']) . ",
                    " . $this->db->escape($data['used']) . ",
                    " . $this->db->escape($data['snapshots']) . ",
                    '" . $this->setDate()  . "',
                    '" . $this->setDate()  . "'
                ) 
            ON DUPLICATE KEY UPDATE 
                avail =  " . $this->db->escape($data['avail']) . ",
                used = " . $this->db->escape($data['used']) . ",
                snapshots = " . $this->db->escape($data['snapshots']) . ",
                updated_at = '" . $this->setDate()  . "'
            ;  
        ";
        return $this->db->query($sql);
    }
}
