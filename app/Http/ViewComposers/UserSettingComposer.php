<?php

namespace App\Http\ViewComposers;


use App\AlterBase\Models\User\Module;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class UserSettingComposer
{
    public function compose(View $view)
    {
        $setting = auth()->user()->setting;

        return $view->with('setting',$setting);
    }
}