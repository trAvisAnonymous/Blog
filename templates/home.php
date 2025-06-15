<?php
// Get featured articles
$stmt = $db->query("SELECT * FROM articles WHERE status = 'published' ORDER BY date DESC LIMIT 6");
$featuredArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get main categories
$stmt = $db->query("SELECT * FROM categories WHERE parent_id = 0 AND status = 'active'");
$mainCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
    <h1>Welcome to Insurance Blog</h1>
    <p>Your trusted source for insurance information and advice</p>
</section>

<section class="featured-articles">
    <h2>Latest Articles</h2>
    <div class="article-grid">
        <?php foreach ($featuredArticles as $article): ?>
            <article class="article-card">
                <h3><a href="/article/<?php echo $article['slug']; ?>"><?php echo $article['title']; ?></a></h3>
                <p class="article-meta">
                    <span class="date"><?php echo date('F j, Y', strtotime($article['date'])); ?></span>
                    <span class="category">
                        <a href="/category/<?php echo $article['category_slug']; ?>"><?php echo $article['category_name']; ?></a>
                    </span>
                </p>
                <p class="article-excerpt"><?php echo substr($article['meta']['description'], 0, 150) . '...'; ?></p>
                <a href="/article/<?php echo $article['slug']; ?>" class="read-more">Read More</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="categories">
    <h2>Insurance Categories</h2>
    <div class="category-grid">
        <?php foreach ($mainCategories as $category): ?>
            <div class="category-card">
                <h3><a href="/category/<?php echo $category['slug']; ?>"><?php echo $category['name']; ?></a></h3>
                <p><?php echo $category['description']; ?></p>
                <a href="/category/<?php echo $category['slug']; ?>" class="explore-category">Explore <?php echo $category['name']; ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="newsletter">
    <div class="newsletter-content">
        <h2>Stay Updated</h2>
        <p>Subscribe to our newsletter for the latest insurance tips and news</p>
        <form action="/subscribe" method="POST" class="newsletter-form">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </div>
</section> 