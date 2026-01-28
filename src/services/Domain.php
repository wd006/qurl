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


    public function getAll(): array
    {
        return $this->data;
    }


    public function getById(int $id)
    {
        return $this->data[$id] ?? false;
    }


    public function getActiveList(): array
    {
        $activeList = [];
        foreach ($this->data as $domain) {
            if (!empty($domain['is_active'])) {
                $activeList[] = $domain;
            }
        }
        return $activeList;
    }


    public function getDefault()
    {
        foreach ($this->data as $domain) {
            if (!empty($domain['is_default'])) {
                return $domain;
            }
        }

        $actives = $this->getActiveList();
        return $actives[0] ?? null;
    }
}
