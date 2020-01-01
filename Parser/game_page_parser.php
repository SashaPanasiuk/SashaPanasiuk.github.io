<?
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

$gamepages = scandir('pages/',1);
array_pop($gamepages);
$link = mysqli_connect("127.0.0.1", "root", "", "game_parser");

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Соединение с MySQL установлено!" . PHP_EOL;
array_pop($gamepages);
foreach ($gamepages as $game) {
	
	$tobd  = array();
	
	$content = file_get_contents('pages/'.$game);
	
	$gamedom =  new Dom();

	$gamedom->load($content);
	
	$genre;
	$lang;
	$date;
	$props = $gamedom->find('.prop .prop_value');
	for ($i=0; $i < count($props); $i++) { 
		if($i == 0){
		$genre = $gamedom->find('.prop .prop_value')[$i]->text;
	}else if($i ==3){
		$lang = $gamedom->find('.prop .prop_value')[$i]->text;
	}else if($i ==4){
		$date = $gamedom->find('.prop .prop_value')[$i]->text;
	}	}
	$url = 'https://good-steam.ru'.$gamedom->find('.product_image img',0)->src;
	$path = dirname(__FILE__).'/'.substr($gamedom->find('.product_image img',0)->src,8);
	
	file_put_contents($path, file_get_contents($url));
	
	if ((int)$gamedom->find('.price_value',0)->innerHtml == null) {
		$tobd['price'] = 0;
		
	}else{
		$tobd['price'] = (int)$gamedom->find('.price_value',0)->innerHtml;

	}
	$tobd['name'] = $gamedom->find('.single_product h1',0)->text;
	$tobd['genre'] = $genre;
	$tobd['lang'] = $lang;
	$tobd['release_date'] = $date;
	$tobd['description'] = $gamedom->find('.product_description',0)->innerHtml;
	

	$tobd['image'] = $path;
	echo 'INSERT INTO `games`(`id`, `name`, `price`, `genre`, `lang`, `release date`, `description`, `image`) VALUES (0,"'.$tobd['name'].'",'.$tobd['price'].',"'.$tobd['genre'].'","'.$tobd['lang'].'","'.$tobd['release_date'].'","'.$tobd['description'].'","'.$tobd['image'].'")';
	mysqli_query($link,'INSERT INTO `games`(`id`, `name`, `price`, `genre`, `lang`, `release date`, `description`, `image`) VALUES (0,"'.$tobd['name'].'",'.$tobd['price'].',"'.$tobd['genre'].'","'.$tobd['lang'].'","'.$tobd['release_date'].'","'.$tobd['description'].'","'.$tobd['image'].'")');
}



mysqli_close($link);
?>