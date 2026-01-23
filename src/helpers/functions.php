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
