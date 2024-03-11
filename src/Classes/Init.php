<?php

namespace src\Classes;

require "AccountPlanner.php";

class Init
{
	public static function init()
	{
        AccountPlanner::get_instance();
	
	}
}

