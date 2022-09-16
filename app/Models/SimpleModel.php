<?php

namespace App\Models;

use CodeIgniter\Model;

abstract class SimpleModel extends Model 
{

    # increase_value (count, 11) --> field & value
    # increase_value (count, array('hash' => $hash)) --> field & primkey + id
    public function increase_value(string $field, $key)
    {

        if (is_array($key)) 
        {
            $primkey = array_keys($key)[0];
            $value = $this->db->escape(array_values($key)[0]);
        }
        else
        {
            $primkey = $this->primaryKey;
            $value = $key;
        }
        
        $sql = "
            UPDATE 
                `" . $this->table. "` 
            SET 
                " . $field . " = " . $field . " + 1,
                " . $this->updatedField . " = '" . $this->setDate() . "'
            WHERE 
                `". $primkey ."` = " . $value. ";";

        return $this->db->query($sql);
    }
}