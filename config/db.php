<?php

class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'usuariogen', 'mN2018AR', 'blog_master');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}

