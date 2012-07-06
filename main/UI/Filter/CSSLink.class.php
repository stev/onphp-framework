<?php

	/**
	 * @author stev
	 */
	class CSSLink extends HtmlInjectBase
	{
		protected function rendering()
		{
			return '<link rel="stylesheet" href="'. $this->source .'" type="text/css" />';
		}
	}

