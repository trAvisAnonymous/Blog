<?php
require_once 'assets/conf.php';
require_once 'assets/db.php';

class SitemapGenerator {
    private $db;
    private $baseUrl;
    private $sitemapPath;
    private $categories;
    private $articles;

    public function __construct() {
        global $db;
        $this->db = $db;
        $this->baseUrl = SITE_URL;
        $this->sitemapPath = ROOT_PATH . '/sitemap.xml';
        $this->loadContent();
    }

    private function loadContent() {
        // Load categories
        $this->categories = $this->db->query("SELECT * FROM categories WHERE status = 'active'")->fetchAll(PDO::FETCH_ASSOC);
        
        // Load articles
        $this->articles = $this->db->query("SELECT * FROM articles WHERE status = 'published'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function generate() {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

        // Add homepage
        $this->addUrl($xml, $this->baseUrl, '1.0', 'daily');

        // Add categories
        foreach ($this->categories as $category) {
            $url = $this->baseUrl . '/category/' . $category['slug'];
            $this->addUrl($xml, $url, '0.8', 'weekly');
        }

        // Add articles
        foreach ($this->articles as $article) {
            $url = $this->baseUrl . '/article/' . $article['slug'];
            $this->addUrl($xml, $url, '0.7', 'monthly');
        }

        // Save sitemap
        $xml->asXML($this->sitemapPath);
    }

    private function addUrl($xml, $loc, $priority, $changefreq) {
        $url = $xml->addChild('url');
        $url->addChild('loc', $loc);
        $url->addChild('priority', $priority);
        $url->addChild('changefreq', $changefreq);
        $url->addChild('lastmod', date('Y-m-d'));
    }
}

// Generate sitemap
$generator = new SitemapGenerator();
$generator->generate(); 