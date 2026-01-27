<?php

class Shortlink
{
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
