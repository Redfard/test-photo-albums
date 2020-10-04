<?php

namespace App\Services;

use App\TableGateway\AlbumsGateway;
use App\TableGateway\PhotoGateway;

class UpdateAlbumsService {

    public function update(array $albums, array $newPhotos): void
    {
        foreach ($albums as $albumId => $data) {
            $this->updateAlbums($albumId, $data);

            if ($data['photo']) {
                $this->updatePhotos($data['photo']);
            }
        }
        
        foreach ($newPhotos as $albumId => $files) {
            $this->saveNewPhotos($albumId, $files);
        }
    }

    protected function saveNewPhotos(int $albumId, array $files): void
    {
        foreach ($files['name'] as $key => $fileName) {
            if (!$fileName) {
                continue;
            }

            $newFileName = uniqid().'.jpg'; //здесь следует расширение получать из исходного файла
            move_uploaded_file($files['tmp_name'][$key], "upload/".$newFileName);

            $photoGateway = new PhotoGateway();
            $photoGateway->insert($albumId, $newFileName);
        }
    }

    protected function updateAlbums(int $albumId, array $data): void
    {
        $albumsGateway = new AlbumsGateway();
        $albumsGateway->update($albumId, $data);
    }

    protected function updatePhotos(array $photos): void
    {
        $photoGateway = new PhotoGateway();

        foreach ($photos as $photoId => $data) {
            $photoGateway->update($photoId, $data);
        }
    }
}