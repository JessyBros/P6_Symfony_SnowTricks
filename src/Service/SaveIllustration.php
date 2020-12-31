<?php

namespace App\Service;

class SaveIllustration{

    public function save($illustration, $photoDir) {
        if ($illustration->get('file')->getData() != null){
            $fileData = $illustration->get('file')->getData();
            $filename = bin2hex(random_bytes(6)) . '.' . $fileData->guessExtension();
            try {
                   $fileData->move($photoDir, $filename);
                } catch (FileException $e) {
                }
                $illustration->getData()->setPath($filename);
        }
    }
    
}