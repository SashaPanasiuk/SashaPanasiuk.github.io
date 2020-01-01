<?
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

foreach ($links as $link) {
$pagedom = new Dom();

$pagedom->loadFromUrl('https://good-steam.ru/'.$link);
	file_put_contents('pages/'.substr($link,6,-1).'.html',$pagedom);
}

?>