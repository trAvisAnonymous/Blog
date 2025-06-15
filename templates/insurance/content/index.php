<?php
if (!defined('INCLUDED')) {
    die('Direct access not permitted');
}

// Template configuration
$template_config = array(
    'name' => 'Insurance Blog',
    'version' => '1.0',
    'author' => 'Your Name',
    'description' => 'Professional insurance blog template with modern design',
    'features' => array(
        'responsive' => true,
        'ad_ready' => true,
        'seo_optimized' => true
    )
);

// Load the appropriate content based on the page
$page = isset($_GET['p']) ? $_GET['p'] : 'home';
$content_file = __DIR__ . '/' . $page . '/index.php';

if (file_exists($content_file)) {
    include($content_file);
} else {
    include(__DIR__ . '/error/index.php');
}
?> 