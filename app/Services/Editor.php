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
            if ($item['type'] === 'carousel') {
                $out .= view("editor.{$item['type']}", [
                    'images' => $item['data']
                ]);
                continue;
            }
            $out .= view("editor.{$item['type']}", $item['data']);
        }

        return $out;
    }
}
