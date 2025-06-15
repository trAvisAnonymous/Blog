<?php
class CategoryManager {
    private $db;
    private static $instance = null;

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

    public function getCategoryHierarchy() {
        $query = "SELECT * FROM categories WHERE status = 'active' ORDER BY parent_id, display_order";
        $categories = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->buildHierarchy($categories);
    }

    private function buildHierarchy($categories, $parentId = 0) {
        $branch = [];
        
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children = $this->buildHierarchy($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }
        
        return $branch;
    }

    public function getBreadcrumbs($categoryId) {
        $breadcrumbs = [];
        $currentId = $categoryId;
        
        while ($currentId > 0) {
            $query = "SELECT id, name, slug, parent_id FROM categories WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $currentId);
            $stmt->execute();
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($category) {
                array_unshift($breadcrumbs, [
                    'id' => $category['id'],
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                    'url' => SITE_URL . '/category/' . $category['slug']
                ]);
                $currentId = $category['parent_id'];
            } else {
                break;
            }
        }
        
        // Add home page
        array_unshift($breadcrumbs, [
            'id' => 0,
            'name' => 'Home',
            'slug' => '',
            'url' => SITE_URL
        ]);
        
        return $breadcrumbs;
    }

    public function getCategoryPath($categoryId) {
        $breadcrumbs = $this->getBreadcrumbs($categoryId);
        return implode(' > ', array_map(function($item) {
            return $item['name'];
        }, $breadcrumbs));
    }

    public function getRelatedCategories($categoryId, $limit = 5) {
        $query = "SELECT c.* FROM categories c
                 WHERE c.status = 'active'
                 AND c.id != :categoryId
                 AND (c.parent_id = :categoryId OR c.parent_id = (
                     SELECT parent_id FROM categories WHERE id = :categoryId
                 ))
                 ORDER BY RAND()
                 LIMIT :limit";
                 
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryStats($categoryId) {
        $query = "SELECT 
                    COUNT(DISTINCT a.id) as article_count,
                    COUNT(DISTINCT CASE WHEN a.status = 'published' THEN a.id END) as published_count,
                    MAX(a.last_modified) as last_updated
                 FROM categories c
                 LEFT JOIN articles a ON a.category_id = c.id
                 WHERE c.id = :categoryId";
                 
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function generateCategorySitemap() {
        $categories = $this->db->query("SELECT * FROM categories WHERE status = 'active'")->fetchAll(PDO::FETCH_ASSOC);
        $sitemap = [];
        
        foreach ($categories as $category) {
            $sitemap[] = [
                'url' => SITE_URL . '/category/' . $category['slug'],
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }
        
        return $sitemap;
    }
} 