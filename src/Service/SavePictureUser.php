<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SavePictureUser {

    private string $pictureDir;

    public function __construct(string $pictureDir)
    {
        $this->pictureDir = $pictureDir;
    }

    public function save(User $user, UploadedFile $picture) {
        $pictureName = bin2hex(random_bytes(6)) . '.' . $picture->guessExtension();
        try {
            $picture->move($this->pictureDir, $pictureName);
        } catch (FileException $e) {
        }
        $user->setPicture($pictureName);
    }

} 