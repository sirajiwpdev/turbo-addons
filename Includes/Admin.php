<?php

namespace DesignMonks\AkijCement;

use DesignMonks\AkijCement\Admin\Menu;
use DesignMonks\AkijCement\Admin\PostType\Footer;


class Admin {


	public function __construct() {

		if ( is_admin() ) {
//			new Menu();
		}
	}
}