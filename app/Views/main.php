<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<style>
    .t-photos-item__image {
        max-width: 150px;
    }

    .t-album {
        border: 1px solid #cacaca;
        padding: 30px;
        margin-bottom: 30px;
    }

    .card {
        width: 100% !important;
    }
</style>

<body>

<div class="container">
    <div class="row">
        <form action="save" method="post" enctype="multipart/form-data">
            <a href="/add-album" class="btn btn-primary mt-4 mb-4">Добавить альбом</a>

            <? if ($albums): ?>
                <input type="submit" value="Сохранить изменения" class="btn btn-primary mb-5 d-block">
            <? endif; ?>

            <? foreach ($albums as $albumId => $album): ?>
                <div class="t-album">
                    <div class="col-12 mb-5">
                        <div>
                            <div class="form-group">
                                <label>Название альбома:</label>
                                <input type="text"
                                       class="form-control"
                                       name="albums[<?= $albumId; ?>][title]"
                                       value="<?= $album['title'] ?>"
                                >
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>Дата создания:</label>
                                <input type="date"
                                       value="<?= $album['created_at'] ?>"
                                       name="albums[<?= $albumId; ?>][date]"
                                       class="form-control"
                                       style="width: 150px"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea class="form-control"
                                      rows="3"
                                      name="albums[<?= $albumId; ?>][description]"
                            ><?= $album['description'] ?></textarea>
                        </div>
                        <div>
                            Количество фотографий: <?= $album['photos'] ? count($album['photos']) : 0  ?>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>Порядок сортировки альбома:</label>
                                <input type="text"
                                       class="form-control"
                                       name="albums[<?= $albumId; ?>][sort]"
                                       value="<?= $album['sort'] ?>"
                                       style="width: 50px"
                                >
                            </div>
                        </div>

                        <? if ($album['photos']): ?>
                            <div class="row">
                                <? foreach ($album['photos'] as $photo): ?>
                                    <div class="col-md-4">
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" src="upload/<?= $photo['file_name'] ?>" alt="">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Заголовок:</label>
                                                    <input type="text"
                                                           value="<?= $photo['title']; ?>"
                                                           name="albums[<?= $albumId; ?>][photo][<?= $photo['id']; ?>][title]"
                                                           class="form-control"
                                                    >
                                                </div>
                                                <div class="form-group">
                                                    <label>Сортировка:</label>
                                                    <input type="text"
                                                           value="<?= $photo['sort']; ?>"
                                                           name="albums[<?= $albumId; ?>][photo][<?= $photo['id']; ?>][sort]"
                                                           class="form-control"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        <? endif; ?>

                        <div class="mt-2">
                            Добавить фотографии в альбом
                            <input type="file" multiple="multiple" name="<?= $albumId; ?>[]">
                        </div>
                        <hr>
                    </div>
                </div>
            <? endforeach; ?>

            <? if ($albums): ?>
                <a href="/add-album" class="btn btn-primary mt-4 mb-4">Добавить альбом</a>
                <input type="submit" value="Сохранить изменения" class="btn btn-primary mb-5 d-block">
            <? endif; ?>
        </form>
    </div>
</div>
</body>
</html>