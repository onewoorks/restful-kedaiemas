<?php

namespace App\Controllers;

use App\Models\YahyaSample as YahyaSample;

class YahyaController extends Controller {
    
    public function getSampleData($request, $response, $args){
        $sql = "SELECT * FROM yahya_sample";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $kedai = $sth->fetchAll();
        foreach ($kedai as $k):
            $result[] = array(
                'id' => $k['id'],
                'field1' => $k['field1'],
                'image' => $k['image']
            );
        endforeach;
        return $this->response
                        ->withHeader('Access-Control-Allow-Origin', '*')
                        ->withJson(['sample'=> $result]);
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
                $newfile->moveTo("/home/onewoork/public_html/demo/dump_storage/$uploadFileName");
            }
        }

        $imageUploadUrl = 'https://onewoorks-solutions.com/demo/dump_storage/'.$uploadFileName;
        $sql = "INSERT INTO yahya_sample "
                . "(field1,image) VALUES (:field1,:image_uri)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':field1', $input['field1']);
        $sth->bindParam(':image_uri', $imageUploadUrl);
        $sth->execute();
    }

}
