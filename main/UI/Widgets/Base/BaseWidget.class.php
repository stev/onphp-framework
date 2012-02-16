<?php
/***************************************************************************
 *   Copyright (C) by Evgeny M. Stepanov                                   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 ***************************************************************************/
/* $Id: BaseWidget.class.php 374 2011-04-21 14:38:38Z stev $ */



abstract class BaseWidget implements InterfaceWidget
{
	protected $name = null;
	protected $tplPrefix = null;
	protected $tplName = null;
	protected $model;

	/**
	 * @var InterfacePartViewer
	 */
	protected $viewer = null;

	public function __construct($name = null)
	{
		$this->name = $name;
		Assert::isInstance(Viewer::get(), 'InterfacePartViewer');
		$this->viewer = Viewer::get();
		$this->model = new Model();
	}

	/**
	 * @return BaseWidget
	 */
	public function setTplName($tplName)
	{
		$this->tplName = (string)$tplName;

		return $this;
	}

	/**
	 * @return BaseWidget
	 */
	public function setPrefix($prefix)
	{
		$this->tplPrefix = (string)$prefix;

		return $this;
	}

	public function getTplName()
	{
		return $this->tplName;
	}

	public function getTplPrefix()
	{
		return $this->tplPrefix 
			? $this->tplPrefix.DIRECTORY_SEPARATOR
			: null;
	}

	/**
	 * @return BaseWidget
	 */
	public function setViewer(InterfacePartViewer $viewer)
	{
		$this->viewer = $viewer;

		return $this;
	}

	/**
	 * @return BaseWidget
	 */
	public function setModel(Model $model)
	{
		$this->model = $model;
		return $this;
	}

	public function render()
	{
		$source = null;
		ob_start();
		
//		try {
			$this->getModel();

			$this->viewer->view(
				$this->getTplPrefix().$this->tplName,
				$this->model
			);

			$source = ob_get_contents();
//		}
//		catch (Exception $e) {
			// FIXME
//			echo($e->__toString());
//		}

		ob_end_clean();

		return $source;
	}

	/**
	 * @return InterfacePartViewer
	 */
	public function getViewer()
	{
		return $this->viewer;
	}

	public function out()
	{
		echo $this->render();
	}

	public function __toString()
	{
		return (string)$this->render();
	}

	/**
	 * @return Model
	 */
	protected function makeModel()
	{
		return $this->model->set('_widgetName', $this->name);
	}

	private function getModel()
	{
		$model = $this->viewer->getModel();

		$this->makeModel();

		return $this->model->
			set(
				'parentModel',
				$model->has('parentModel')
					? $model->get('parentModel')
					: null
			)->
			set(
				'rootModel',
				$model->has('rootModel')
					? $model->get('rootModel')
					: $this->model
			);
	}
}

