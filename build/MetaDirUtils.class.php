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
		$fullPath = $dir->getFullPath();
		$mode = $dir->getMode();
		self::mkdir($fullPath, $mode);
		
		foreach ($dir->getChilds() as $subDir) {
			self::mkdirs($subDir);
		}
	}
	
	public static function mkdir($fullPath, $mode)
	{	$temp = $mode;
		if (!is_dir($fullPath)) {
			if (!mkdir($fullPath, $mode, true)) {
//				throw new ErrorException("Не удалось создать директорию: $fullPath\n");
			} else {
				echo " создана дириктория: ".$temp." \t{$fullPath}\n";
			}
		} else {
			echo "дириктория уже есть: {$fullPath}\n";
			chmod($fullPath, $mode);
		}
	}
}
