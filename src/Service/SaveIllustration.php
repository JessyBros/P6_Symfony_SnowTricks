<?php

namespace App\Service;

use App\Entity\Illustration;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SaveIllustration{

    private string $photoDir;

    public function __construct(string $photoDir)
    {
        $this->photoDir = $photoDir;
    }

    public function save(Illustration $illustration, UploadedFile $uploadedFile) {
        $filename = bin2hex(random_bytes(6)) . '.' . $uploadedFile->guessExtension();
        try {
            $uploadedFile->move($this->photoDir, $filename);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $illustration->setPath($filename);
    }
}