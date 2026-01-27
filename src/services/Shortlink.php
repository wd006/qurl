<?php

class Shortlink
{

    public function create(array $input)
    {

        $target_url = trim($input['long_url'] ?? '');
        $shortname = trim($input['custom_shortname'] ?? '');
        $domain_id = $input['domain_id'] ?? 0;


        $settings = $input['settings'] ?? [];
        $settings['use_https'] = $settings['use_https'] ?? false;


        $admin = $input['admin'] ?? [];
        $admin['enabled'] = $admin['enabled'] ?? false;
        $admin['password'] = !empty($admin['password']) ? Security::hasher($admin['password']) : null;


        $protection = $input['protection'] ?? [];
        $protection['enabled'] = $protection['enabled'] ?? false;
        $protection['password'] = !empty($protection['password']) ? Security::hasher($protection['password']) : null;


        $preview = $input['preview'] ?? [];
        $preview['enabled'] = $preview['enabled'] ?? false;
        $preview['note'] = $preview['note'] ?? null;



        if (empty($target_url)) {
            echo Response::error(400, "Missing Parameter", "Long URL can't be blank.");
            exit;
        }

        if (!$target_url = $this->formatUrl($target_url, $settings['use_https'])) {
            echo Response::error(400, "Invalid URL", "Long URL format is invalid.");
            exit;
        }


        $shortname = $this->slugify($shortname);

        if (empty($shortname)) {
            $shortname = Str::random(6);
        }


        $link_data = [
            "shortname" => $shortname,
            "domain_id" => $domain_id,
            "target_url" => $target_url,
            "settings" => [
                "use_https" => $settings['use_https'],
            ],
            "admin" => [
                "enabled" => $admin['enabled'],
                "password" => $admin['password'],
            ],
            "protection" =>  [
                "enabled" => $protection['enabled'],
                "password" => $protection['password'],
            ],
            "preview" => [
                "enabled" => $preview['enabled'],
                "note" => $preview['note'],
            ],
        ];

        $this->saveFile($link_data);
    }


    public function read($domainId, $shortname)
    {

        $file_path = ROOTDIR . CONFIG['links_dir'] . "$domainId/$shortname.json";
        if (file_exists($file_path)) return $data = file_get_contents($file_path);
        else return false;
    }


    protected function saveFile(array $link_data)
    {

        if (empty($link_data)) {
            echo Response::error(500, 'Internal Server Error', 'An error occured, try again later.');
            exit;
        }

        $shortname = $link_data['shortname'];
        $domain_id = $link_data['domain_id'];
        $directory = ROOTDIR . CONFIG['links_dir'] . "$domain_id/";

        if (!is_dir($directory)) {
            if (!@mkdir($directory, 0755, true)) {
                echo Response::error(500, "Critical Error", "Permission denied to create directory: $directory");
                exit;
            }
        }

        $file_path = $directory . $link_data['shortname'] . '.json';

        if ($this->read($domain_id, $shortname)) {
            echo Response::error(409, "Shortlink Conflict", "$shortname is exist.");
            exit;
        }

        if (file_put_contents($file_path, json_encode($link_data, JSON_PRETTY_PRINT)) === false) {
            echo Response::error(500, "Critical Error", "Permission denied to write file: $file_path");
            exit;
        }

        echo Response::success(201, $link_data);
        exit;
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
