<?php

namespace App\Http\Controllers;

use League\CommonMark\Converter;

class ContentController extends Controller
{
    protected $converter;

    public function __construct(Converter $converter)
    {
        $this->converter = $converter;
    }

    public function index($content)
    {
        return $this->converter
            ->convertToHtml(
                \File::get(base_path('resources/views/content/'.$content . '.md'
                )
            ));
    }
}