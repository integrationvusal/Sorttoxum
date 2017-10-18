<?php

class RosterController extends Controller {

    public static function view($request, $vars, $context = array()){

        $context['plants'] = BaseModel::fQuery("SELECT plant FROM dle_rosters_list GROUP BY plant");
        $context['sorts'] = BaseModel::fQuery("SELECT name FROM dle_rosters_list GROUP BY name");

        self::renderTemplate('roster' . ds . 'roster.tpl',$context);

    }

}