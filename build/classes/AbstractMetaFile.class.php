<?php


/**
 * Description of AbstractMetaFile
 *
 * @author stev
 */
abstract class AbstractMetaFile
{
	protected	$parent = null;	// parent dir

	public static function create($name)
	{
		$class = get_called_class();
		return new $class($name);
	}
	
	public function __construct($name) {
		$this->name = (string)$name;
	}
	
	/**
	 *
	 * @param type $pathToDir
	 * @return AbstractMetaFile 
	 */
	public function setPath($pathToDir)
	{
		$this->path = $pathToDir;
		return $this;
	}
	
	public function getPath()
	{
		return $this->path;
	}
	
	public function getName()
	{
		return $this->name;
	}

	public function getFullPath()
	{
		if ($this->parent instanceof AbstractMetaFile) {
			return $this->parent->getFullPath().$this->name.DIRECTORY_SEPARATOR;
		}
		
		return $this->path.$this->name.DIRECTORY_SEPARATOR;
	}
	
	public function getMode()
	{
		return $this->mode;
	}
	
		/**
	 * @example 0775
	 * @param type $mode
	 * @return AbstractMetaFile
	 * @throws WrongArgumentException 
	 */
	public function setMode($mode)
	{
		if(!preg_match('~^\d{4}$~', (string)$mode))
			throw new WrongArgumentException();
		
		$this->mode = $mode;
		
		return $this;
	}
	
	/**
	 *
	 * @param MetaDir $dir
	 * @return AbstractMetaFile 
	 */
	public function setParent(MetaDir $dir = null)
	{
		$this->parent = $dir;
		
		return $this;
	}
	
	// TODO : относительный путь
	public function getRelativePath()
	{
		return;
	}
}
