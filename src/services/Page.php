<?php

class Page
{
    private $jsonPath;
    private $pages = [];

    public function __construct()
    {

        $this->jsonPath = ROOTDIR . '/data/pages.json';
        $this->load();
    }

    private function load()
    {
        if (file_exists($this->jsonPath)) {
            $json = file_get_contents($this->jsonPath);
            $data = json_decode($json, true);
            $this->pages = $data['pages'] ?? [];
        }
    }

    public function find($currentUrl)
    {
        foreach ($this->pages as $page) {

            if ($page['url'] === $currentUrl) {
                return $page;
            }

            // check aliases
            if (isset($page['url_aliases']) && is_array($page['url_aliases'])) {
                if (in_array($currentUrl, $page['url_aliases'])) {
                    return $page;
                }
            }
        }

        return null;
    }


    public function serve($pageData)
    {
        $page = $pageData; // used in views
        $viewFile = ROOTDIR . $pageData['file']; // used in layout

        // get controllers
        if (!empty($pageData['controller'])) {
            $controllerFile = ROOTDIR . $pageData['controller'];
            if (file_exists($controllerFile)) {
                require $controllerFile;
            }
        }

        // get view
        if (!empty($pageData['file'])) {

            $layoutFile = ROOTDIR . '/views/layouts/' . ($pageData['layout'] ?? 'default') . '.php';

            if (file_exists($layoutFile)) {
                require $layoutFile;
            } else {
                echo "Layout not found";
            }

        }
    }
}
