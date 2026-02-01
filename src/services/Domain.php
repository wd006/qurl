<?php

class Domain
{
    protected static $data = null;
    private function __construct() {}
    protected static function load()
    {
        if (self::$data !== null) {
            return;
        }

        $dataDir = ROOTDIR . '/data/domains.json';
        self::$data = [];

        if (file_exists($dataDir)) {
            $dataContent = file_get_contents($dataDir);
            if ($decoded = json_decode($dataContent, true)) {
                self::$data = $decoded;
            }
        }
    }

    public static function getAll(): array
    {
        self::load();
        return self::$data;
    }

    public static function getById(int $id)
    {
        self::load();
        return self::$data["$id"] ?? false;
    }

    public static function getActiveList(): array
    {
        self::load();
        $activeList = [];
        foreach (self::$data as $domain) {
            if (!empty($domain['is_active'])) {
                $activeList[] = $domain;
            }
        }
        return $activeList;
    }

    public static function getDefault()
    {
        self::load();
        foreach (self::$data as $domain) {
            if (!empty($domain['is_default'])) {
                return $domain;
            }
        }

        $actives = self::getActiveList();
        return $actives[0] ?? null;
    }

    public static function isAvailable(int $id): bool
    {
        self::load();
        $domain = self::getById($id);

        if (!$domain) return false;

        if (!empty($domain['is_active']) && $domain['status'] === 'online') {
            return true;
        }

        return false;
    }
}