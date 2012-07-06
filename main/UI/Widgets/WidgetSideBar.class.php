<?php

	/**
	 * @author stev
	 */
	class WidgetSideBar extends BaseWidget
	{
		protected $tplName = 'sidebar';
		
		public static function create($name = null)
		{
			return new static($name);
		}
	}

