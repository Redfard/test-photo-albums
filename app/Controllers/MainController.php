<?php

namespace App\Controllers;

use App\Services\GetAlbumsAndPhotosDataService;
use App\Services\UpdateAlbumsService;
use App\TableGateway\AlbumsGateway;

class MainController
{
    public function main(): void
    {
        $dataService = new GetAlbumsAndPhotosDataService();
        $albums      = $dataService->getData();

        require './app/Views/main.php';
    }

    public function save(): void
    {
        $updateService = new UpdateAlbumsService();
        $updateService->update($_POST['albums'], $_FILES);

        header('Location: /');
    }

    public function addAlbum(): void
    {
        $albumsGateway = new AlbumsGateway();
        $albumsGateway->add();

        header('Location: /');
    }
}