<?php

namespace App\Controllers;

class PermintaanController extends Controller {

    public function postPermintaan($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO permintaan_pelanggan "
                . "(kenyataan,person_id,image_uri,status) VALUES (:kenyataan,:person_id,:image_uri,:status)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':kenyataan', $input['kenyataan']);
        $sth->bindParam(':person_id', $input['person_id']);
        $sth->bindParam(':image_uri', $input['image_uri']);
        $sth->bindParam(':status', $input['status']);
        $sth->execute();
//        return $this->response->withJson($input);
    }

}
