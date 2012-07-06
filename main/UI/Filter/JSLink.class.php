<?php

	/**
	 * @author stev
	 */
	class JSLink extends HtmlInjectBase
	{
		protected function rendering()
		{
			return '<script type="text/javascript" src="'. $this->source .'"></script>';
		}
	}

