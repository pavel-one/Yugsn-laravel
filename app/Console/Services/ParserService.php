<?php

namespace App\Console\Services;

class ParserService
{
    public $apiUrl;

    public const TYPE_MATERIAL = 'Материалы';
    public const TYPE_CATEGORIES = 'Категории';

    public function __construct()
    {
        $this->apiUrl = '';
    }
}
