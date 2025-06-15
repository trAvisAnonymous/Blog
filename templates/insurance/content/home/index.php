<?php
if (!defined('INCLUDED')) {
    die('Direct access not permitted');
}

$page_title = 'Insurance Blog - Expert Insurance Advice';
$meta_description = 'Get expert insurance advice, compare insurance policies, and learn about different types of insurance coverage.';
?>

<div class="hero-section">
    <div class="container">
        <h1>Find the Right Insurance Coverage for Your Needs</h1>
        <p>Compare insurance policies and get expert advice to protect what matters most.</p>
        <div class="hero-buttons">
            <a href="/categories" class="btn-primary">Explore Insurance Types</a>
            <a href="/contact" class="btn-secondary">Get a Free Quote</a>
        </div>
    </div>
</div>

<div class="insurance-calculator">
    <div class="container">
        <h2>Calculate Your Insurance Premium</h2>
        <form class="quote-form">
            <div class="form-group">
                <label for="insuranceType">Insurance Type</label>
                <select name="insuranceType" id="insuranceType" required>
                    <option value="">Select Insurance Type</option>
                    <option value="auto">Auto Insurance</option>
                    <option value="home">Home Insurance</option>
                    <option value="health">Health Insurance</option>
                    <option value="life">Life Insurance</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="coverage">Coverage Amount ($)</label>
                <input type="number" name="coverage" id="coverage" min="1000" step="1000" required>
            </div>
            
            <div class="form-group">
                <label for="deductible">Deductible ($)</label>
                <input type="number" name="deductible" id="deductible" min="0" step="100" required>
            </div>
            
            <div class="form-group">
                <label>Risk Factors</label>
                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="riskFactors[]" value="high-risk"> High Risk Area
                    </label>
                    <label>
                        <input type="checkbox" name="riskFactors[]" value="claims"> Previous Claims
                    </label>
                    <label>
                        <input type="checkbox" name="riskFactors[]" value="credit"> Poor Credit Score
                    </label>
                </div>
            </div>
            
            <div class="estimate-display"></div>
            
            <button type="submit" class="btn-primary">Calculate Premium</button>
        </form>
        
        <div class="calculator-result" style="display: none;"></div>
    </div>
</div>

<div class="featured-categories">
    <div class="container">
        <h2>Insurance Categories</h2>
        <div class="category-grid">
            <div class="category-card">
                <img src="/templates/insurance/image/health-insurance.jpg" alt="Health Insurance">
                <h3>Health Insurance</h3>
                <p>Find the right health coverage for you and your family.</p>
                <a href="/categories/health-insurance" class="read-more">Learn More</a>
            </div>
            
            <div class="category-card">
                <img src="/templates/insurance/image/auto-insurance.jpg" alt="Auto Insurance">
                <h3>Auto Insurance</h3>
                <p>Protect your vehicle with comprehensive auto coverage.</p>
                <a href="/categories/auto-insurance" class="read-more">Learn More</a>
            </div>
            
            <div class="category-card">
                <img src="/templates/insurance/image/life-insurance.jpg" alt="Life Insurance">
                <h3>Life Insurance</h3>
                <p>Secure your family's future with life insurance.</p>
                <a href="/categories/life-insurance" class="read-more">Learn More</a>
            </div>
            
            <div class="category-card">
                <img src="/templates/insurance/image/home-insurance.jpg" alt="Home Insurance">
                <h3>Home Insurance</h3>
                <p>Protect your home and belongings with proper coverage.</p>
                <a href="/categories/home-insurance" class="read-more">Learn More</a>
            </div>
        </div>
    </div>
</div>

<div class="latest-articles">
    <div class="container">
        <h2>Latest Insurance Articles</h2>
        <div class="article-grid">
            <?php
            // This would be replaced with actual article data from your database
            $articles = array(
                array(
                    'title' => 'Understanding Health Insurance Deductibles',
                    'excerpt' => 'Learn how deductibles work and how to choose the right one for your health insurance plan.',
                    'image' => '/templates/insurance/image/article1.jpg',
                    'category' => 'Health Insurance',
                    'date' => '2024-03-15'
                ),
                array(
                    'title' => 'Auto Insurance: What You Need to Know',
                    'excerpt' => 'Essential information about auto insurance coverage and how to get the best rates.',
                    'image' => '/templates/insurance/image/article2.jpg',
                    'category' => 'Auto Insurance',
                    'date' => '2024-03-14'
                ),
                array(
                    'title' => 'Life Insurance for Young Families',
                    'excerpt' => 'Why young families need life insurance and how to choose the right policy.',
                    'image' => '/templates/insurance/image/article3.jpg',
                    'category' => 'Life Insurance',
                    'date' => '2024-03-13'
                )
            );
            
            foreach ($articles as $article): ?>
                <article class="article-card">
                    <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" class="article-image">
                    <div class="article-content">
                        <div class="article-meta">
                            <span class="category"><?php echo $article['category']; ?></span>
                            <span class="date"><?php echo date('F j, Y', strtotime($article['date'])); ?></span>
                        </div>
                        <h3 class="article-title"><?php echo $article['title']; ?></h3>
                        <p class="article-excerpt"><?php echo $article['excerpt']; ?></p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Get a free insurance quote today and protect what matters most.</p>
        <a href="/contact" class="btn-primary">Get a Free Quote</a>
    </div>
</div> 