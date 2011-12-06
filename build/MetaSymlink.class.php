<?php
include_once 'AbstractMetaFile.class.php';


/**
 * @method MetaLinkFile create()
 * @method MetaLinkFile setPathTo() setPathTo(string $pathToDir)
 * @method MetaLinkFile setPath() setParent(MetaDir $dir = null)
 * @method MetaLinkFile setMode() setParent(string $mode)
 * @author stev
 */
class MetaSymlink extends AbstractMetaFile
{
	protected $pathTo;
	
	public function setPathTo($path) 
	{
		// TODO: проверки пути
		if ($path instanceof AbstractMetaFile)
			$this->pathTo = $path->getFullPath();
		else
			$this->pathTo = (string) $path;
		
		return $this;
	}
	
	public function getPathTo()
	{
		return $this->pathTo;
	}
	
	public function getFullPath() 
	{
		return substr(parent::getFullPath(), 0, -1);
	}
}
