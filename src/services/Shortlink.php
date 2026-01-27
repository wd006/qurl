<?php

class Shortlink
{

    public function read($domainId, $shortname)
    {

        $file_path = ROOTDIR . CONFIG['links_dir'] . "$domainId/$shortname.json";
        if (file_exists($file_path)) return $data = file_get_contents($file_path);
        else return false;
    }

    protected function saveFile(array $link_data)
    {

        if (empty($link_data)) {
            Response::error(500, 'Internal Server Error', 'An error occured, try again later.');
        }

        $shortname = $link_data['shortname'];
        $domain_id = $link_data['domain_id'];
        $directory = ROOTDIR . CONFIG['links_dir'] . "$domain_id/";

        if (!is_dir($directory)) {
            if (!@mkdir($directory, 0755, true)) {
                echo Response::error(500, "Critical Error", "Permission denied to create directory: $directory");
            }
        }

        $file_path = $directory . $link_data['shortname'] . '.json';

        if ($this->read($domain_id, $shortname)) {
            echo Response::error(409, "Shortlink Conflict", "$shortname is exist.");
        }

        if (file_put_contents($file_path, json_encode($link_data, JSON_PRETTY_PRINT)) === false) {
            echo Response::error(500, "Critical Error", "Permission denied to write file: $file_path");
        }

        echo Response::success(201, $link_data);
    }


    protected function slugify($text, $divider = '-')
    {

        $text = mb_convert_encoding($text, 'UTF-8', mb_detect_encoding($text));

        if (function_exists('iconv')) {
            $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        }

        $text = strtolower($text);

        $text = preg_replace('/[^a-z0-9]+/', $divider, $text);

        $text = trim($text, $divider);

        if (empty($text)) {
            return null;
        }

        return $text;
    }


    protected function formatUrl(string $rawUrl, bool $useHttps): string
    {

        $domain = preg_replace('#^https?://#i', '', trim($rawUrl));

        if (strpos($domain, '.') === false) { // must contain a period
            return false;
        }


        if (strlen($domain) < 3) { // min length 3
            return false;
        }


        $parts = explode('.', $domain);

        if (count($parts) < 2) { // example. -> invalid
            return false;
        }

        //
        // $tld = end($parts);  

        // if (strlen($tld) < 2) { // example.a -> invalid
        //     return false;
        // }
        //

        if (!filter_var($domain, FILTER_VALIDATE_URL)) {
            return false;
        }

        return $domain;
    }
}
