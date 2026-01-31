<?php

class LinkHandler {
    
    private $linkModes = [
        '+' => 'stats',
        '-' => 'preview',
        '!' => 'qr',
    ];

    public $mode = 'redirect'; // default mode
    public $path;              // cleaned link
    public $domain_id = 0;     // default id
    public $alias = '';

    public function __construct($incomingUrl) {
        
        
        $cleanPath = ltrim($incomingUrl, '/');
        $this->detectMode($cleanPath);
        $this->parsePath();
    }


    private function detectMode($path) {
        if (empty($path)) return;

        $lastChar = substr($path, -1);

        if (array_key_exists($lastChar, $this->linkModes)) {

            $this->mode = $this->linkModes[$lastChar];
            // remove last char
            $this->path = rtrim($path, $lastChar);
        } else {
            $this->path = $path;
        }
    }

    private function parsePath() {
        $parts = explode('/', $this->path);
        $count = count($parts);

        // /2/abc1234
        if ($count === 2 && is_numeric($parts[0])) {
            $this->domain_id = (int)$parts[0];
            $this->alias = $parts[1];
        }
        // /abc1234
        elseif ($count === 1 && !empty($parts[0])) {
            $this->alias = $parts[0];
        }
    }
    
    public function getResult() {
        return [
            'mode'      => $this->mode,
            'domain_id' => $this->domain_id,
            'alias' => $this->alias,
            'full_path' => $this->path
        ];
    }
}