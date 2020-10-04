<?
require_once 'vendor/autoload.php';

(new \App\Router())->init([
    ''          => 'MainController@main',
    'save'      => 'MainController@save',
    'add-album' => 'MainController@addAlbum'
]);


?>