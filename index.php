<?php
/**
* @package GameMonetize.com CMS - Modern Arcade Script
*
*
* @author GameMonetize.com
*
*/
require_once 'assets/conf.php';
require_once 'assets/db.php';
require_once 'includes/meta-tags.php';
require_once 'includes/url-optimizer.php';
require_once 'includes/category-manager.php';

// Initialize URL Optimizer
$urlOptimizer = URLOptimizer::getInstance();

// Parse the current URL
$urlInfo = $urlOptimizer->parseURL($_SERVER['REQUEST_URI']);

// Get page data based on URL type
$pageData = [];
switch ($urlInfo['type']) {
    case 'home':
        $pageData = [
            'title' => 'Insurance Blog - Expert Insurance Advice and Information',
            'meta' => [
                'description' => 'Get expert advice on insurance topics including health, auto, home, and life insurance. Find the best coverage options and save money on your insurance policies.',
                'keywords' => 'insurance, health insurance, auto insurance, home insurance, life insurance, insurance advice, insurance tips'
            ]
        ];
        break;
        
    case 'article':
        // Fetch article data from database
        $stmt = $db->prepare("SELECT * FROM articles WHERE slug = ? AND status = 'published'");
        $stmt->execute([$urlInfo['slug']]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($article) {
            $pageData = [
                'title' => $article['title'],
                'meta' => [
                    'description' => $article['meta']['description'],
                    'keywords' => $article['meta']['keywords']
                ],
                'canonical' => SITE_URL . '/article/' . $article['slug']
            ];
        }
        break;
        
    case 'category':
        // Fetch category data from database
        $stmt = $db->prepare("SELECT * FROM categories WHERE slug = ? AND status = 'active'");
        $stmt->execute([$urlInfo['slug']]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($category) {
            $pageData = [
                'title' => $category['name'] . ' - Insurance Blog',
                'meta' => [
                    'description' => "Learn about {$category['name']}. Find expert advice, tips, and information about {$category['name']}.",
                    'keywords' => $category['name'] . ', insurance, ' . strtolower($category['name']) . ' tips, ' . strtolower($category['name']) . ' advice'
                ],
                'canonical' => SITE_URL . '/category/' . $category['slug']
            ];
        }
        break;
}

// If no page data found, show 404
if (empty($pageData)) {
    header("HTTP/1.0 404 Not Found");
    $pageData = [
        'title' => '404 - Page Not Found',
        'meta' => [
            'description' => 'The page you are looking for could not be found.',
            'keywords' => '404, page not found'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo generateMetaTags($pageData); ?>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="/" class="logo">Insurance Blog</a>
                <ul class="main-menu">
                    <li><a href="/category/health-insurance">Health Insurance</a></li>
                    <li><a href="/category/auto-insurance">Auto Insurance</a></li>
                    <li><a href="/category/home-insurance">Home Insurance</a></li>
                    <li><a href="/category/life-insurance">Life Insurance</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            switch ($urlInfo['type']) {
                case 'home':
                    // Display featured articles and categories
                    include 'templates/home.php';
                    break;
                    
                case 'article':
                    if (isset($article)) {
                        // Display article content
                        include 'templates/article.php';
                    } else {
                        include 'templates/404.php';
                    }
                    break;
                    
                case 'category':
                    if (isset($category)) {
                        // Display category content
                        include 'templates/category.php';
                    } else {
                        include 'templates/404.php';
                    }
                    break;
                    
                default:
                    include 'templates/404.php';
            }
            ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About Us</h3>
                    <p>Your trusted source for insurance information and advice.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="/category/health-insurance">Health Insurance</a></li>
                        <li><a href="/category/auto-insurance">Auto Insurance</a></li>
                        <li><a href="/category/home-insurance">Home Insurance</a></li>
                        <li><a href="/category/life-insurance">Life Insurance</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>Email: contact@insuranceblog.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Insurance Blog. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="/assets/js/main.js"></script>
</body>
</html>