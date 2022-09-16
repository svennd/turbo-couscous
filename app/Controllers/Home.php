<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct() {
        $this->zfs = new \App\Models\ZfsModel();
        $this->bricks = new \App\Models\BrickModel();
        $this->snapshot = new \App\Models\SnapshotModel();
    }

    public function index(int $server = 0)
    {
        $all_zfs = $this->zfs->findAll();
        
        return $this->layout('home', array('zfs' => $all_zfs));
    }
    
    public function brick(int $server)
    {
        $all_zfs = $this->zfs->where(array("id" => $server))->find();
        
        return $this->layout('bricks', array(
                'server_id' => $server,
                'zfs' => $all_zfs,
                'bricks' => $this->bricks->where(array("server" => $all_zfs[0]['server']))->findall()
            ));
    }

    public function snapshot(int $server, int $brick)
    {

        $all_zfs = $this->zfs->where(array("id" => $server))->find();
        $brickinfo = $this->bricks->where(array("server" => $all_zfs[0]['server'], "id" => $brick))->find();

        return $this->layout('snapshot', array(
            'server_id' => $server,
            'zfs'        => $all_zfs,
            'snapshots' => $this->snapshot->where(array("server" => $all_zfs[0]['server'], 'brick' => $brickinfo[0]['brick']))->findall()
        ));
    }

    # receive a ping
    public function ping(string $hash)
    {
        $pingModel = new \App\Models\PingModel();
        $result = $pingModel->increase_value('count', array('hash' => $hash));
        
        # todo : process and give a clean 200
        var_dump($result);
    }

    public function zfs_info(string $hash)
    {
        $zfsModel = new \App\Models\ZfsModel();
        $data = array(
                "hash" => $hash,
                "server" => $this->request->getPost("server"),
                "name" => $this->request->getPost("name"),
                "size" => $this->request->getPost("size"),
                "free" => $this->request->getPost("free"),
        );
        
        $result = $zfsModel->save($data);
        var_dump($result);
    }

    public function brick_info(string $hash)
    {
        $zfsModel = new \App\Models\BrickModel();
        $snapshot = new \App\Models\SnapshotModel();

        $server = $this->request->getPost("server");
        $pool = $this->request->getPost("pool");
        $brick = $this->request->getPost("brick");
        $avail = $this->request->getPost("avail");
        $used = $this->request->getPost("used");

        $data = array(
                "hash" => $hash,
                "server" => $server,
                "pool" => $pool,
                "brick" => $brick,
                "avail" => $avail,
                "used" => $used,
                "snapshots" => $this->request->getPost("snapshots"),
        );


        if($this->request->getMethod() == "post")
        {
            $return = $snapshot->store_snapshots($hash, $server, $pool, $brick, $this->request->getPost("list_snapshot"));
            // var_dump($return);

            $result = $zfsModel->insert_or_update($data);
            // var_dump($result);
        }
        else
        {
            echo "hello, yes i'm sane";
        }
    }
}

