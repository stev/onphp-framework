<?php

	/**
	 * @author stev
	 */
	class CSSCollector implements ToString
	{
		protected $array;

		public function addLink($href)
		{
			$this->array[] = new CSSLink($href);
			return $this;
		}

		public function addSource($source)
		{
			$this->array[] = new CSSSource($source);
			return $this;
		}

		public function __toString()
		{
			return (string) $this->rendering();
		}

		protected function rendering()
		{
			$source = null;
			ob_start();
			try {
				return
					"\n\t"
					.join("\t\n", $this->array)
					."\n";
			} catch (Exception $e) {
				return $e->__toString();
			}
		}
	}

