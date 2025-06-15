<?php
if (!defined('INCLUDED')) {
    die('Direct access not permitted');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - Insurance Blog' : 'Insurance Blog - Expert Insurance Advice'; ?></title>
    <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : 'Get expert insurance advice, compare insurance policies, and learn about different types of insurance coverage.'; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/templates/insurance/image/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="/templates/insurance/css/style.css">
    <link rel="stylesheet" href="/templates/insurance/css/responsive.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="header-top">
            <div class="container">
                <div class="contact-info">
                    <span><i class="fas fa-phone"></i> 1-800-INSURANCE</span>
                    <span><i class="fas fa-envelope"></i> contact@insuranceblog.com</span>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        
        <nav class="main-nav">
            <div class="container">
                <div class="logo">
                    <a href="/">
                        <img src="/templates/insurance/image/logo.png" alt="Insurance Blog Logo">
                    </a>
                </div>
                
                <div class="nav-links">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/categories/health-insurance">Health Insurance</a></li>
                        <li><a href="/categories/auto-insurance">Auto Insurance</a></li>
                        <li><a href="/categories/life-insurance">Life Insurance</a></li>
                        <li><a href="/categories/home-insurance">Home Insurance</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
                
                <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="main-content">
        <div class="container">
            <?php if (isset($breadcrumbs)): ?>
            <div class="breadcrumbs">
                <?php echo $breadcrumbs; ?>
            </div>
            <?php endif; ?> 