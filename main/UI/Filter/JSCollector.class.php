<?php

	/**
	 * @author stev
	 */
	class JSCollector implements ToString
	{
		protected $array;

		public function addLink($href)
		{
			$this->array[] = new JSLink($href);
			return $this;
		}

		public function addSource($source)
		{
			$this->array[] = new JSSource($source);
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

