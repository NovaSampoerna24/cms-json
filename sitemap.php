<?php 
include 'data/koneksi.php';
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
$datasitemap = file_get_contents('data/tb_artikel.json');
$datasitemap = json_decode($datasitemap);
foreach ($datasitemap as $key => $value) {
    echo '<url>' . PHP_EOL;
    echo '<loc>'.$GLOBALS['base_url']."/detail.php/". $value->slug .'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;
