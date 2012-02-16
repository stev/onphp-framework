<?php
/***************************************************************************
 *   Copyright (C) by Evgeny M. Stepanov                                   *
 *   from.stev@gmail.com                                                   *
 ***************************************************************************
 * $Id$ */


/**
 * @method WCalendar create()
 * @method WCalendar setTplName()
 * @method WCalendar setViewer()
 * @method WCalendar setModel()
 */
class WCalendar extends WPropertiesElement
{
	protected $tplName = 'calendar';
	protected $format = 'd.m.Y';
	
	/**
	 * формат вывода, например: d.m.Y
	 *
	 * @param type $format
	 * @return WCalendar 
	 */
	public function setFormat($format)
	{
		$this->format = $format;
		return $this;
	}
	
	protected function makeModel()
	{
		return parent::makeModel()->set('_format', $this->format);
	}
}
