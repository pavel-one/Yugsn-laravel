<?php

namespace App\Services;

class Editor
{
    protected array $data;

    function __construct($data)
    {
        $this->data = $data['blocks'];
    }

    public function render(): string
    {
        $out = '';

        foreach ($this->data as $item) {
            $out .= view("editor.{$item['type']}", $item['data']);
        }

        return $out;
    }
}
