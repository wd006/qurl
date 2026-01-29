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

        <div class="page header">
            <h3><?= htmlspecialchars($page['header']) ?></h3>
        </div>
        <hr>

        <?php require $viewFile; ?>

    </div>
</main>
<?php get_footer(); ?>