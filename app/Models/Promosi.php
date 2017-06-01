<?php

namespace App\Models;

class Promosi {
    
    public function getSenaraiPromosi(){
        $sql = "SELECT * FROM promosi";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $promosi = $sth->fetchAll();
        return $this->response->withJson($promosi);
    }
}