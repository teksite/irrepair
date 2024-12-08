<?php

namespace Modules\Main\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminTrashLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title ,
        public string $indexRoute ,
        public string $restoreAllRoute ,
        public string $deleteAllRoute ,
        public array $indexRoutePrams = [] ,
        public mixed $instances=null ,
        public ?string $restoreRoute=null ,
        public ?string $deleteRoute=null ,
        public array $columns=[]
    )
    {

    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('main::layouts.admin.trash');
    }
}
