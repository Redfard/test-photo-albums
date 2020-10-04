<?php

namespace App\TableGateway;

use PDO;

class PhotoGateway extends BaseGateway
{

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM photos ORDER BY sort");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($albumId, $fileName): void
    {
        $this->pdo->query("INSERT INTO photos (album_id, file_name) VALUES ('$albumId', '$fileName'); ");
    }

    public function update(int $albumId, array $data): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE photos
            SET title = :title, sort = :sort
            WHERE id = :id;
        ");

        $stmt->execute([
            ':title' => $data['title'],
            ':sort'  => $data['sort'] === '' ? null : $data['sort'],
            ':id'    => $albumId
        ]);
    }

}