<?php
/***************************************************************************
 *   Copyright (C) by Evgeny M. Stepanov                                   *
 *   from.stev@gmail.com                                                   *
 ***************************************************************************
 * $Id$ */



class WPropertiesElement extends BaseWidget
{
	protected $params = array();
	protected $value;

	/**
	 *
	 * @param type $name
	 * @param type $value
	 * @param array $params
	 * @return WPropertiesElement
	 */
	static public function create($name=null, $value=null, array $params=array())
	{
		$widget = new static($name);

		if ($value)
			$widget->setValue($value);

		if ($params)
			$widget->setParams($params);

		return $widget;
	}
	
	public function __construct($name = null)
	{
		parent::__construct($name);
	}

	/**
	 * @param array $params
	 * @return WPropertiesElement
	 */
	public function setParams(array $params)
	{
		$this->params = $params;
		return $this;
	}

	/**
	 * получить все параметры, или один - указав какой
	 *
	 * @param array $params
	 * @return WPropertiesElement
	 */
	public function getParams($name=null)
	{
		if ((string)$name && isset($this->params[(string)$name])) {
			return $this->params[(string)$name];
		} else
			return $this->params;
	}

	/**
	 * @param  $value
	 * @return WPropertiesElement
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 *
	 * @return Model
	 */
	protected function makeModel()
	{
		$model = parent::makeModel();

		// изврат - из массива делать другой массив %(
		// всмысле изначально почему бы не передавать массив вместо модели.. ?
		foreach($this->params as $key=>$value) {
			$model->set($key, $value);
		}

		$model->set('_value', $this->value);

		return $model;
	}

}
