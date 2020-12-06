<?php


namespace App\Services;

use \App\Models\News;


class NewsService
{
    public function create($data)
    {
        News::create($data);
    }
}
