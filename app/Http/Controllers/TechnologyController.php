<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\User;


class TechnologyController extends Controller
{
    public function index(User $user, string $type = 'Programming / markup languages') {

        $tech = TechnologyController::getAllowedTypes();

        if (in_array($type, $tech)) {
            $items = Technology::where('type', $type)->get();
        }
        
        return isset($items) ? TechnologyController::renderTech($user, $items) : null;
    }

    public function getAllowedTypes() {

        $tech = Technology::select('type')->distinct()->get()->all();
        array_walk($tech, array(TechnologyController::class, 'setTechType'));

        return $tech;
    }

    public function userTech (Object $techs) {
        $userTechs = array();

        foreach ($techs as $tech) {
            isset ($userTechs[$tech->type]) ? array_push($userTechs[$tech->type], $tech) : $userTechs[$tech->type] = [$tech];
        }

        return $userTechs;
    }

    private function renderTech(User $user, object $tech) {

        $user_tech = UserTechController::names($user);
        $items = '';

        foreach ($tech as $item) {
            $class = in_array($item->name, $user_tech) ? 'bg-primary' : 'bg-base-100';
            $icon  = isset($item->icon) ? "<i class='scale-125 mr-2 devicon-" . $item->icon . "'></i>"
                                       : "<svg height='14' class='fill-current mr-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z'/></svg>";

            $items .= "<div onclick='toggleTech($(this)," . $item->id . ")' class='sm:col-span-6 md:col-span-3 xs:col-span-6 lg:col-span-3 rounded-md bg-opacity-75 $class shadow-sm transition ease-in-out duration-200 hover:bg-indigo-500 cursor-pointer'>                                
                            <div class='mt-1 flex'>
                                <div class='flex items-center justify-center h-8 w-full rounded-md text-gray-100 sm:text-sm'>
                                    $icon " .  $item->name .  "
                                </div>
                            </div>
                       </div>";
        }

        return $items;
    }

    private function setTechType(object &$item) {
        $item = $item->type;
    }

}
