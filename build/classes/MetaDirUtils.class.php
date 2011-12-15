<?php



/**
 * Description of MetaDirUtils
 *
 * @author stev
 */
class MetaDirUtils
{
	public static function mkdirs(AbstractMetaFile $metaFile)
	{
		if ($metaFile instanceof MetaSymlink) {
			self::makeSymlink($metaFile->getFullPath(), $metaFile->getPathTo());
		}
		else
		if ($metaFile instanceof MetaDir) {
			self::mkdir($metaFile->getFullPath(), $metaFile->getMode());

			foreach ($metaFile->getChilds() as $subDir) {
				self::mkdirs($subDir);
			}
		}
	}
	
	public static function mkdir($fullPath, $mode = 0755)
	{	
		// TODO: учесть OC, вывод сообщений в консоль через MetaOutput
		
		if (!is_dir($fullPath)) {
			if (mkdir($fullPath, $mode, true)) {
				echo " +  {$fullPath}\n"; //directory is created
			} else {
//				throw new ErrorException("Не удалось создать директорию: $fullPath\n");
			}
		} else {
			echo " =  {$fullPath}\n";
			chmod($fullPath, $mode);
		}
	}
	
	public static function makeSymlink($fullPath, $pathTo, $mode = 0755)
	{	
		// TODO: учесть OC, вывод сообщений в консоль через MetaOutput
		
		if (!file_exists($fullPath)) {
			if (symlink($pathTo, $fullPath)) {
				// TODO
//				chmod($fullPath, $mode);
				echo " +  $fullPath -> $pathTo\n";
			} else {
//				throw new ErrorException("Не удалось создать директорию: $fullPath\n");
			}
		} else {
			echo " =  $fullPath -> $pathTo\n";
		}
	}
}
