<?php

namespace App\Service;

class SaveIllustration{

    private $photoDir;

    public function __construct(string $photoDir)
    {
        $this->photoDir = $photoDir;
    }

    public function save($illustration) {
        if ($illustration->get('file')->getData() != null){
            $fileData = $illustration->get('file')->getData();
            $filename = bin2hex(random_bytes(6)) . '.' . $fileData->guessExtension();
            try {
                   $fileData->move($this->photoDir, $filename);
                } catch (FileException $e) {
                }
                $illustration->getData()->setPath($filename);
        }
    }
    
}