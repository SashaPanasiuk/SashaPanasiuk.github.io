<?
require "vendor/autoload.php";
use PHPHtmlParser\Dom;
$dom = new Dom;
$dom->loadFromUrl('https://good-steam.ru/catalog/');
$games = $dom->find('.product a');

$links =  array();

for ($i=0; $i < count($games); $i++) { 
$links[$i] = $games[$i]->href;

}
require "game_pages_parser.php";
?>