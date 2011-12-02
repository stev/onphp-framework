<?php

/**
 * Description of DirUtils
 *
 * @author stev
 */
class DirUtils
{
	public static function mkdirs(DirInfo $dir)
	{
		echo "\n{$dir->getChild('src')->getChild('classes')->getFullPath()}\n";
		
//		print_r($dir);
	}
}
