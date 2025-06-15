<?php
function generateMetaTags($pageData) {
    $defaultTitle = "Insurance Blog - Expert Insurance Advice and Information";
    $defaultDescription = "Get expert advice on insurance topics including health, auto, home, and life insurance. Find the best coverage options and save money on your insurance policies.";
    $defaultKeywords = "insurance, health insurance, auto insurance, home insurance, life insurance, insurance advice, insurance tips";

    $title = isset($pageData['title']) ? $pageData['title'] . " - Insurance Blog" : $defaultTitle;
    $description = isset($pageData['meta']['description']) ? $pageData['meta']['description'] : $defaultDescription;
    $keywords = isset($pageData['meta']['keywords']) ? $pageData['meta']['keywords'] : $defaultKeywords;
    $canonicalUrl = isset($pageData['canonical']) ? $pageData['canonical'] : SITE_URL . $_SERVER['REQUEST_URI'];
    $ogImage = isset($pageData['og_image']) ? $pageData['og_image'] : SITE_URL . '/assets/images/default-og.jpg';

    $metaTags = <<<HTML
    <!-- Primary Meta Tags -->
    <title>{$title}</title>
    <meta name="title" content="{$title}">
    <meta name="description" content="{$description}">
    <meta name="keywords" content="{$keywords}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{$canonicalUrl}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{$canonicalUrl}">
    <meta property="og:title" content="{$title}">
    <meta property="og:description" content="{$description}">
    <meta property="og:image" content="{$ogImage}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{$canonicalUrl}">
    <meta property="twitter:title" content="{$title}">
    <meta property="twitter:description" content="{$description}">
    <meta property="twitter:image" content="{$ogImage}">
    
    <!-- Additional Meta Tags -->
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <meta name="author" content="Insurance Blog">
    
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
HTML;

    return $metaTags;
} 