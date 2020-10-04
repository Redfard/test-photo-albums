<?php

namespace App\TableGateway;

use PDO;

class AlbumsGateway extends BaseGateway
{

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM albums ORDER BY sort");

        return $stmt->fetchAll(PDO::FETCH_UNIQUE);
    }

    public function add(): void
    {
        $this->pdo->query("INSERT INTO albums (created_at) VALUES (CURRENT_DATE)");
    }

    public function update(int $albumId, array $data): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE albums
            SET title = :title, description = :description, sort = :sort, created_at = :date
            WHERE id = :id;
        ");

        $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':sort'        => $data['sort'] === '' ? null : $data['sort'],
            ':id'          => $albumId,
            ':date'        => $data['date']
        ]);
    }
}