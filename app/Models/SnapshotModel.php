<?php

namespace App\Models;

use CodeIgniter\Model;

class SnapshotModel extends SimpleModel
{
    protected $table      = 'zfs_snapshots';
    protected $primaryKey = 'hash';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['hash', 'server', 'pool', 'brick', 'snapshot'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
    



    public function store_snapshots($hash, $server, $pool, $brick, string $snapshot_list)
    {
        # delete old snapshots
        $this->drop_snapshots($hash, $server, $pool, $brick);

        # ener new snapshots
        $list = explode(",", $snapshot_list);

        foreach ($list as $snapshot)
        {
            $data = [
                    "hash" => $hash,
                    "server" => $server,
                    "pool" => $pool,
                    "brick" => $brick,
                    "snapshot" => $snapshot,
            ];
            $this->insert($data);
        }
    }



    # drops all snapshots of current set to be replaced by new info
    private function drop_snapshots($hash, $server, $pool, $brick)
    {
        $sql = "
            DELETE FROM  
                `" . $this->table. "` 
            WHERE
                hash =  " . $this->db->escape($hash) . "
            AND
                server =  " . $this->db->escape($server) . "
            AND
                pool =  " . $this->db->escape($pool) . "
            AND
                brick =  " . $this->db->escape($brick) . ";
        ";
        return $this->db->query($sql);
    }
}
