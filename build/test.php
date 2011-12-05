#!/usr/bin/env php
<?php


include 'MetaDirInfo.class.php';
include 'MetaDirUtils.class.php';


$tree
	= MetaDir::create('project')->
		setChild(
			MetaDir::create('conf'),
			MetaDir::create('meta'),
			MetaDir::create('misc'),
			MetaDir::create('www'),
			MetaDir::create('src')->
				setChild(
					MetaDir::create('classes'),
					MetaDir::create('contollers'),
					MetaDir::create('templates')
				)
		);

MetaDirUtils::mkdirs($tree);