<?php

class Shortlink
{

    public function create(array $input)
    {

        $target_url = trim($input['long_url'] ?? '');
        $alias = trim($input['custom_alias'] ?? '');
        $domain_id = $input['domain_id'] ?? 0;


        $settings = $input['settings'] ?? [];
        $settings['use_https'] = isset($settings['use_https']) ? true : false;


        $admin = $input['admin'] ?? [];
        $admin['enabled'] = isset($admin['enabled']) ? true : false;
        $admin['password'] = !empty($admin['password']) ? Security::hasher($admin['password']) : null;


        $protection = $input['protection'] ?? [];
        $protection['enabled'] = isset($protection['enabled']) ? true : false;
        $protection['password'] = !empty($protection['password']) ? Security::hasher($protection['password']) : null;


        $preview = $input['preview'] ?? [];
        $preview['enabled'] = isset($preview['enabled']) ? true : false;
        $preview['note'] = $preview['note'] ?? null;



        if (empty($target_url)) {
            echo Response::error(400, "Missing URL", "Please enter a link to shorten.");
            exit;
        }

        if (!$target_url = $this->formatUrl($target_url)) {
            echo Response::error(400, "Invalid URL", "Please enter a valid URL.");
            exit;
        }


        $alias = $this->slugify($alias);


        if (empty($alias)) {
            $alias = Str::random(6);
        }


        $link_data = [
            "alias" => $alias,
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


    public function read($domainId, $alias)
    {
        $alias = strtolower($alias);
        $file_path = ROOTDIR . CONFIG['links_dir'] . "$domainId/$alias.json";
        if (file_exists($file_path)) return $data = file_get_contents($file_path);
        else return false;
    }


    protected function saveFile(array $link_data)
    {

        if (empty($link_data)) {
            echo Response::error(400, 'Error', 'Data could not be fetched, please check your connection or try again later.');
            exit;
        }

        $alias = $link_data['alias'];
        $domain_id = $link_data['domain_id'];
        $directory = ROOTDIR . CONFIG['links_dir'] . "$domain_id/";

        if (!is_dir($directory)) {
            if (!@mkdir($directory, 0755, true)) {
                // TODO: logger -> Critical Error: Permission denied to create directory: $directory
                echo Response::error(500, 'Failed to save link', 'Your link could not be saved, please try again later.');
                exit;
            }
        }

        $file_path = $directory . strtolower($link_data['alias']) . '.json';

        if ($this->read($domain_id, $alias)) {
            echo Response::error(409, 'Alias Unavailable', "Please try another one.");
            exit;
        }

        if (file_put_contents($file_path, json_encode($link_data, JSON_PRETTY_PRINT)) === false) {
            // TODO: logger -> Critical Error -> Permission denied to write file: $file_path
            echo Response::error(500, 'Failed to save link', 'Your link could not be saved, please try again later.');
            exit;
        }

        echo Response::success(201, 'Link created successfully!', $link_data);
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


    protected function formatUrl(string $rawUrl): string
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

        $urlForValidate = 'https://' . $domain;
        if (!filter_var($urlForValidate, FILTER_VALIDATE_URL)) {
            return false;
        }

        return $domain;
    }
}
