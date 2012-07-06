<?php

	/**
	 * @author stev
	 */
	abstract class HtmlInjectBase implements ToString
	{
		protected $source;
		
		public function __construct($source)
		{
			$this->source = $source;
		}

		public function __toString()
		{
			try {
				return $this->rendering();
			} catch (Exception $e) {
				return $e;
			}
		}

		abstract protected function rendering();
	}

