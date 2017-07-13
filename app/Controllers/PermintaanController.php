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

    public function postImage($request, $response) {
        $input = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('2012-03-14 09:06:00'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        if (empty($files['picture']->file)) {
            
        } else {
            $newfile = $files['picture'];
            if ($newfile->getError() === UPLOAD_ERR_OK) {
                $uploadFileName = $rand . ".jpg";
                $newfile->moveTo("/Users/lydiairwan/Sites/api.kedaiemas/public/images/uploads/$uploadFileName");
            }
        }

        $imageUploadUrl = 'https://localhost/api.kedaiemas/public/images/upload/'.$uploadFileName;
        $sql = "INSERT INTO permintaan_pelanggan "
                . "(kenyataan,person_id,image_uri,status) VALUES (:kenyataan,:person_id,:image_uri,:status)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':kenyataan', $input['kenyataan']);
        $sth->bindParam(':person_id', $input['person_id']);
        $sth->bindParam(':image_uri', $imageUploadUrl);
        $sth->bindParam(':status', $input['status']);
        $sth->execute();
    }
    
    public function senaraiPermintaan(){
        $sql = "SELECT * FROM permintaan_pelanggan";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        return $this->response->withJson($result);
    }

}
