#!/usr/bin/env php
<?php
define('DEFAULT_ENCODING', 'UTF8');
setlocale(LC_CTYPE, 'ru_RU.UTF-8');
setlocale(LC_TIME, 'ru_RU.UTF-8');
date_default_timezone_set('Europe/Moscow');

mb_internal_encoding(DEFAULT_ENCODING);
mb_regex_encoding(DEFAULT_ENCODING);

date_default_timezone_set('Europe/Moscow');

include 'AbstractMetaFile.class.php';
include 'MetaDir.class.php';
include 'MetaSymlink.class.php';
include 'MetaDirUtils.class.php';

function help () {
	echo <<<OUT
параметры:
	 name:значение	-навание диритории проекта.
	[path:значение]	-полный путь к будующей диритории проекта.

 по умолчанию путь берется текущий, тот в котором сейчас находитесь. see pwd
 пример:
	# Создать проект my-project
	stev@mac:~/workspace$ onphp-framework/build/test.php name:my-project
 или
	# Создать в текущей дириктории
	stev@mac:~/workspace/myProject$ ./../github/onphp-framework/build/test.php name:.
	
 обозначения:
	(+) create a new directory/symlink
	(-) delete directory/symlink
	(~) change directory/symlink
	(=) directory/symlink already exists


OUT;
}

define('COMMANDLINE_DELIMITER', ':');

$pathOnPHP = realpath(dirname(dirname(reset($_SERVER['argv']))));

$path = $name = $varName = $value = null;
$args = $_SERVER['argv'];
array_shift($args);

foreach($args as $arg) {

	if (preg_match('~^\w+'.COMMANDLINE_DELIMITER.'[\w\d]+$~', $arg)) {
		
		list($varName, $value) = split(COMMANDLINE_DELIMITER, $arg);

		switch ($varName) {
			case 'path': $path = $value; break;
			case 'name': $name = $value; break;
		}
	}
}
// TODO : validation name, path
// TODO : relative path

if (strlen($name)) {
	$projectDir = MetaDir::create($name);
	
	if (strlen($path)) {
		$projectDir->setPath($path);
	}
} else {
	help();
	exit();
}


$tree
	= $projectDir->
		setChild(
			MetaDir::create('conf'),
			MetaDir::create('meta'),
			MetaDir::create('misc'),
			MetaSymlink::create('onphp')->
				setPathTo($pathOnPHP),
			MetaDir::create('www'),
			MetaDir::create('src')->
				setChild(
					MetaDir::create('classes'),
					MetaDir::create('contollers'),
					MetaDir::create('templates')
				)
		);

MetaDirUtils::mkdirs($tree);