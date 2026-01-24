<?php
function get_header($page = null)
{
    if (empty($page['title'])) {
        $title = "qURL";
    } else {
        $title = $page['title'] . ' - ' . "qURL";
    }


    include_once(ROOTDIR . '/views/partials/header.php');
}


function get_footer()
{
    include_once(ROOTDIR . '/views/partials/footer.php');
}

function loadEnv($path)
{
    if (!file_exists($path)) {
        return false;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
    return true;
}
