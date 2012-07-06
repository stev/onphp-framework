<?php

	/**
	 * @author stev
	 */
	class WidgetSubNav extends BaseWidget
	{
		protected $tplName = 'subnav';
		
		public static function create($name = null)
		{
			return new static($name);
		}
	}

