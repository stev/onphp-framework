<?php


/**
 * Description of DirInfo
 *
 * @author stev
 */
class DirInfo
{
	protected	$name;			// dir name
	protected	$path = './';	// path to dir
	protected	$mode = 0755;	
	
	protected	$parent;	
	protected	$childs=array();
	 
	
	public static function create($name)
	{
		return new self($name);
	}
	
	public function __construct($name) {
		$this->name = (string)$name;
	}
	
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
		if ($this->parent instanceof DirInfo) {
			return $this->parent->getFullPath().$this->name.DIRECTORY_SEPARATOR;
		}
		
		return $this->path.$this->name.DIRECTORY_SEPARATOR;
	}
	
	public function setChild(DirInfo $dir)
	{
		foreach (func_get_args() as $dir) {
//			Assert::isTrue($dir instanceof DirInfo);
			$this->childs[$dir->getName()] = $dir->setParent($this);
		}
		
		return $this;
	}
	/**
	 *
	 * @param type $name
	 * @return DirInfo
	 * @throws WrongArgumentException 
	 */
	public function getChild($name)
	{
		if (isset($this->childs[$name])) {
			return $this->childs[$name];
		}
		
		throw new WrongArgumentException();
	}
	
	public function getChilds()
	{
		return $this->childs;
	}

	
	/**
	 * @example 0775
	 * @param type $mode
	 * @return DirInfo
	 * @throws WrongArgumentException 
	 */
	public function setChmod($mode)
	{
		if(!preg_match('~^\d{4}$~', (string)$mode))
			throw new WrongArgumentException();
		
		$this->mode = $mode;
		
		return $this;
	}
		
	public function getMode()
	{
		return $this->mode;
	}
	
	/**
	 *
	 * @param DirInfo $dir
	 * @return DirInfo 
	 */
	public function setParent(DirInfo $dir = null)
	{
		$this->parent = $dir;
		
		return $this;
	}

	
	
//		/**
//	 * запросить у файловой системы информацию о диритории
//	 * @return DirInfo 
//	 */
//	public function init()
//	{
//		return $this;
//	}
}
