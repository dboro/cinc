<?php


namespace Tests\Feature;


trait TestTrait
{
    public function getData($data, $key = false)
    {
        $content = json_decode($data, true);

        if ($key) {
            return $content[$key];
        }
        else {
            return $content;
        }
    }
}