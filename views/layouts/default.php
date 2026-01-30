<?php get_header($page); ?>
<main>
    <br>
    <div class="app-container">
        <header class="brand-header">
            <a href="/"><h1 class="brand-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.3" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 1px;">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                </svg>
                <?= htmlspecialchars(CONFIG['name']) ?> 
            </h1></a>
            <p class="brand-slogan"><?= htmlspecialchars(CONFIG['slogan']) ?></p>
        </header>
        <h2 class="page-content__header"><?= htmlspecialchars($page['header']) ?></h2>
        <?php require $viewFile; ?>
    </div>
</main>
<?php get_footer(); ?>