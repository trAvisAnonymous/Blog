<?php
class URLOptimizer {
    private static $instance = null;
    private $db;

    private function __construct() {
        global $db;
        $this->db = $db;
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function generateSlug($title) {
        // Convert to lowercase
        $slug = strtolower($title);
        
        // Replace spaces with hyphens
        $slug = str_replace(' ', '-', $slug);
        
        // Remove special characters
        $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
        
        // Remove multiple hyphens
        $slug = preg_replace('/-+/', '-', $slug);
        
        // Remove leading and trailing hyphens
        $slug = trim($slug, '-');
        
        return $slug;
    }

    public function isSlugUnique($slug, $type, $id = null) {
        $table = ($type === 'article') ? 'articles' : 'categories';
        $idCondition = ($id !== null) ? "AND id != :id" : "";
        
        $query = "SELECT COUNT(*) FROM {$table} WHERE slug = :slug {$idCondition}";
        $stmt = $this->db->prepare($query);
        
        if ($id !== null) {
            $stmt->bindParam(':id', $id);
        }
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        
        return $stmt->fetchColumn() === 0;
    }

    public function generateUniqueSlug($title, $type, $id = null) {
        $baseSlug = $this->generateSlug($title);
        $slug = $baseSlug;
        $counter = 1;
        
        while (!$this->isSlugUnique($slug, $type, $id)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    public function getFriendlyURL($type, $slug) {
        switch ($type) {
            case 'article':
                return SITE_URL . '/article/' . $slug;
            case 'category':
                return SITE_URL . '/category/' . $slug;
            case 'tag':
                return SITE_URL . '/tag/' . $slug;
            default:
                return SITE_URL;
        }
    }

    public function parseURL($url) {
        $path = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));
        
        if (empty($segments[0])) {
            return ['type' => 'home'];
        }
        
        switch ($segments[0]) {
            case 'article':
                return [
                    'type' => 'article',
                    'slug' => $segments[1] ?? null
                ];
            case 'category':
                return [
                    'type' => 'category',
                    'slug' => $segments[1] ?? null
                ];
            case 'tag':
                return [
                    'type' => 'tag',
                    'slug' => $segments[1] ?? null
                ];
            default:
                return ['type' => '404'];
        }
    }
} 