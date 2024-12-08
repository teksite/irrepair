<?php

namespace Modules\Main\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminEditorLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $instance =null , public ?string $method=null ,public bool $publishStatus =true)
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('main::layouts.admin.editor');
    }
}
