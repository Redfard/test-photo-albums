<?php

namespace App\Services;

use App\TableGateway\AlbumsGateway;
use App\TableGateway\PhotoGateway;

class GetAlbumsAndPhotosDataService
{

    public function getData(): array
    {
        $albumsGateway = new AlbumsGateway();
        $photoGateway  = new PhotoGateway();

        $albums = $albumsGateway->all();
        $photos = $photoGateway->all();
        
        return $this->groupPhotosByAlbums($photos, $albums);
    }

    protected function groupPhotosByAlbums(array $photos, array $albums): array
    {
        foreach ($photos as $photo) {
            $albums[$photo['album_id']]['photos'][] = $photo;
        }

        return $albums;
    }
}