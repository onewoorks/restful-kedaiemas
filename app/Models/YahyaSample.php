<?php

namespace App\Models;

class YahyaSample extends Model {

    protected $table = 'YahyaSample';

    public function SenaraiKedai($request) {
        $sql = "SELECT * FROM YahyaSample";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $kedai = $sth->fetchAll();
        return $this->response->withJson($kedai);
    }
    
     public function postDog($request, $response) {
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

}
