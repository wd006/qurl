<?php get_header($page); ?>
<main>
    <div class="container">

        <h1 class="brand header">
            <img class="brand logo" src="/favicon.svg" alt="Logo">
            <?= CONFIG['name'] ?>
        </h1>

        <p class="brand slogan">
            <?= CONFIG['slogan'] ?>
        </p>

        <div>
            <a href="javascript:history.back()" style="font-size:smaller; text-align:left; color:orange; text-decoration: none;">
                ← Go Back
            </a>
        </div>

        <h3 class="page-header">
            <?= htmlspecialchars($page['header']) ?>
        </h3>
        <hr>

        <?php require $viewFile; ?>

    </div>
</main>
<?php get_footer(); ?>