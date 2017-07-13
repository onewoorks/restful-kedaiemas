<?php

namespace App\Controllers;

class PromosiController extends Controller {
    
    public function getSenaraiPromosi(){
        $sql = "SELECT * FROM promosi";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $promosi = $sth->fetchAll();
        return $this->response->withJson($promosi);
    }
    
    public function getSenaraiPromosiLayer($request,$response,$args){
       $sql = "SELECT * FROM promosi WHERE layer=:layer";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':layer',$args['layer']);
        $sth->execute();
        $result = $sth->fetchAll();
        return $this->response->withJson($result);
    }
}