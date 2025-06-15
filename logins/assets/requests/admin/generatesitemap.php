<?php
if (!defined('R_PILOT')) {
    exit();
}


// Games
$allGames = "SELECT * FROM `" . GAMES . "`";
$allGames = $GameMonetizeConnect->query($allGames);
$allGamesCount = $allGames->num_rows;

$gamePages = floor($allGamesCount / 1000);
$isThereMod = $allGamesCount % 1000;
if($isThereMod > 0){
    $gamePages++;
}


$xmlGames = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
$i = 1;
$currentGamePageCount = 1;
while ($game = $allGames->fetch_assoc()) {
    if ($i % 1000 == 0) {
        $isSuccessGames = $xmlGames->asXML('./' . $currentGamePageCount . '000games.xml');
        $currentGamePageCount++;
        $xmlGames = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
    }
    $gameData = (object)gameData($game);

    $name = $gameData->name;
    $url = $gameData->game_url;
    
    // Create a new URL element
    $urlElement = $xmlGames->addChild('url');
    $urlElement->addChild('loc', $url);
    $i++;
}
$isSuccessGames = $xmlGames->asXML('./' . $currentGamePageCount . '000games.xml');

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></sitemapindex>');
for($i = 1;$i <= $gamePages; $i++){
    $urlElement = $xml->addChild('url');
    $urlElement->addChild('loc', siteUrl() . '/' . $i . '000games.xml');
    $urlElement->addChild('lastmod', date('Y-m-d\TH:i:sP', time()));
    
}
$urlElement = $xml->addChild('url');
$urlElement->addChild('loc', siteUrl() . '/categories.xml');
$urlElement->addChild('lastmod', date('Y-m-d\TH:i:sP', time()));

// Save the XML document
$isSuccess = $xml->asXML('./sitemap.xml');

// Sitemap for categories
$xmlCategory = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

$fixedCategories = ['featured-games', 'best-games', 'new-games', 'categories'];
foreach($fixedCategories as $category){
    $urlElement = $xmlCategory->addChild('url');
    $urlElement->addChild('loc', siteUrl() . '/' . $category);
}

// Dynamic categories
$allCategories = "SELECT * FROM `" . CATEGORIES . "`";
$allCategories = $GameMonetizeConnect->query($allCategories);
while ($category = $allCategories->fetch_assoc()) {
    $urlElement = $xmlCategory->addChild('url');
    $urlElement->addChild('loc', siteUrl() . '/' . seo_friendly_url($category['name']));
}
$xmlCategory->asXML('./categories.xml');
if($isSuccess) {
    $data['success_message'] = 'Sitemap generated successfully';
    $data['status'] = 200;
} else {
    $data['error_message'] = 'Sitemap generation failed';
}

function seo_friendly_url($string)
{
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
    return strtolower(trim($string, '-'));
}
