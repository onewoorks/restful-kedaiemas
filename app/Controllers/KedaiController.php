<?php

namespace App\Controllers;

use App\Models\Kedai as Kedai;

class KedaiController extends Controller {
    
    public function getSenaraiKedai($request, $response) {
        $sql = "SELECT * FROM kedai";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $kedai = $sth->fetchAll();
        foreach($kedai as $k):
            $result[] = array(
                'id' => $k['id'],
                'nama_kedai' => $k['nama_kedai'],
                'nama_cawangan' => $k['nama_cawangan'],
                'imej' => json_decode($k['images'],true)
            );
        endforeach;
        return $this->response->withJson($result);
    }
    
    public function getKedaiById($request,$response,$args){
        $sql = "SELECT * FROM kedai WHERE id=:id";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':id',$args['id']);
        $sth->execute();
        $result = $sth->fetchObject();
        $data['id'] = $result->id;
        $data['nama_kedai'] = $result->nama_kedai;
        $imej = json_decode($result->images);
        $data['cover'] = $imej->cover;
        return $this->response->withJson($data);
    }

}
