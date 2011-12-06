<?php


/**
 * @method MetaDir create()
 * @method MetaDir setPath() setPath(string $pathToDir)
 * @method MetaDir setPath() setParent(MetaDir $dir = null)
 * @method MetaDir setMode() setParent($mode)
 * @method string getPath()
 * @method string getFullPath()
 * @method string getMode()
 *
 * @author stev
 */
class MetaDir extends AbstractMetaFile
{
	protected	$name;			// dir name
	protected	$path = './';	// path to dir
	protected	$mode = 0755;	
	protected	$type = 0755;	
	
	protected	$childs=array();
	 
	/**
	 *
	 * @param MetaDir $dir
	 * @return MetaDir 
	 */
	public function setChild(MetaDir $dir)
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
	 * @return MetaDir
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
}
