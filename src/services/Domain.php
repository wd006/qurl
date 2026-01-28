<?php

class Domain
{
    protected $data = [];

    public function __construct()
    {
        $this->load();
    }

    protected function load()
    {
        $dataDir = ROOTDIR . '/data/domains.json';

        if (file_exists($dataDir)) {
            $dataContent = file_get_contents($dataDir);
            if ($decoded = json_decode($dataContent, true)) {
                $this->data = $decoded;
            }
        }
    }
}
