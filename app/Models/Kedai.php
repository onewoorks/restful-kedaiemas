<?php

namespace App\Models;

class Kedai extends Model {

    protected $table = 'kedai';

    public function SenaraiKedai($request) {
        $sql = "SELECT * FROM kedai";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $kedai = $sth->fetchAll();
        return $this->response->withJson($kedai);
    }

}
