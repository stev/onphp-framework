<?php

	/**
	 * @author stev
	 */
	class JSSource extends HtmlInjectBase
	{
		protected function rendering()
		{
			return '<script type="text/javascript">'.$this->source.'</script>';
		}
	}

