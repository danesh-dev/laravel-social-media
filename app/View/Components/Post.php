<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Post extends Component
{
    public $image;
    public $title;
    public $username;
    public $time;
    public $caption;

    public function __construct($image, $title, $username, $time, $caption)
    {
        $this->image = $image;
        $this->title = $title;
        $this->username = $username;
        $this->time = $time;
        $this->caption = $caption;
    }

    public function render()
    {
        return view('components.post');
    }
}
