<?php
	
	function createUserTable(){		
		mysql_query("CREATE TABLE userData (
			uid int(10) unsigned NOT NULL auto_increment,
			registrationTime timestamp NOT NULL default CURRENT_TIMESTAMP,
			email text collate utf8_unicode_ci,
			firstName text collate utf8_unicode_ci NOT NULL,
			lastName text collate utf8_unicode_ci NOT NULL,			
			locale text collate utf8_unicode_ci NOT NULL,			
			ip text collate utf8_unicode_ci NOT NULL,						
			ipTag int(10) unsigned NOT NULL default '0',
			PRIMARY KEY  (uid,ipTag)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
	}

	function insertUser($arr){
		if(NULL != mysql_fetch_array(searchUserBymail($arr['email']))){
			return;
		}
		mysql_query("INSERT INTO userData (email,firstName,lastName,locale,ip,ipTag,nickName) VALUES ('"
  		.$arr['email']."',
  		'".$arr['first_name']."',
  		'".$arr['last_name']."',
  		'".$arr['locale']."',
  		'".$arr['ip']."',
  		'".sprintf('%u',ip2long($arr['ip']))."'
  		'".$arr['last_name']."'
  		)");
	}

	function searchUserBymail($mail){
		return mysql_query("SELECT * FROM userData WHERE email='".$mail."'");
	}

	function isLogin()
	{
		if(isset($_SESSION['login'])){
			return $_SESSION['login'] === true;
		}else{
			return false;
		}
	}


?>