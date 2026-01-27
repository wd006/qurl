<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($page['description'] ?? 'qURL is a free, customizable URL Shortening service.') ?>">
    <title>
        <?= htmlspecialchars($title ?? 'qURL') ?>
    </title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="stylesheet" href="/style.css?v=<?= filemtime((ROOTDIR . '/style.css')); ?>">
    <?php foreach ($page['style'] ?? [] as $style) : ?>
        <?php $style_file = "/assets/css/{$style}.css"; ?>
        <?php if (file_exists(ROOTDIR . $style_file)) : ?>
            <link rel="stylesheet" href="<?= $style_file ?>?v=<?= filemtime((ROOTDIR . $style_file)); ?>">
        <?php else : ?>
            <!-- <?= $style_file ?> not found -->
        <?php endif ?>
    <?php endforeach; ?>
</head>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "<?= CONFIG['url'] ?>",
        "name": "<?= CONFIG['name'] ?>",
        "description": "<?= CONFIG['slogan'] ?>"
    }
</script>

<body>