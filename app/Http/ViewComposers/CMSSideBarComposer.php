<?php

namespace App\Http\ViewComposers;


use App\AlterBase\Models\User\Module;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class CMSSideBarComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();
        $modules = new Collection();

        if($user->isSuperuser()){
            $modules = Module::all();
        }else{
            foreach($user->roles as $role)
            {
                $modules = $modules->merge($role->modules()->get());
            }
        }


        return $view->with('modules',$modules);
    }
}