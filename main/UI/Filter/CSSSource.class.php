<?php

	/**
	 * @author stev
	 */
	class CSSSource extends HtmlInjectBase
	{
		protected function rendering()
		{
			return '<style type="text/css">'. $this->source .'</style>';
		}
	}

