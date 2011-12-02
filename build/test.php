<?php


include 'DirInfo.class.php';
include 'DirUtils.class.php';


$tree
	= DirInfo::create('poject')->
		setChild(
			DirInfo::create('conf'),
			DirInfo::create('meta'),
			DirInfo::create('misc'),
			DirInfo::create('www'),
			DirInfo::create('src')->
				setChild(
					DirInfo::create('classes'),
					DirInfo::create('contollers'),
					DirInfo::create('templates')
				)
		);

DirUtils::mkdirs($tree);