<?php
/***************************************************************************
 *   Copyright (C) by Evgeny M. Stepanov                                   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 ***************************************************************************/
/* $Id: Viewer.class.php 337 2011-02-02 14:17:00Z stev $ */




class Viewer extends Singleton
{
	protected static $partViewers = array();

	/**
	 * открыть темплейт указывая относительный путь
	 *
	 * @param string $path
	 * @return InterfacePartViewer
	 */
	static public function load($path=null, $model=null)
	{
		if (self::get() instanceof InterfacePartViewer)
			return self::get()->view($path, $model);

		throw new WrongArgumentException('PartViewer is not defined');
	}

	/**
	 * получить текущий
	 * @return	InterfacePartViewer
	 */
	static public function get()
	{
		return current(self::$partViewers);
	}

	/**
	 * помещаем в стек
	 * @return	InterfacePartViewer
	 */
	static public function push(InterfacePartViewer $partViewer)
	{
		array_push(self::$partViewers, $partViewer);

		return $partViewer;
	}

	/**
	 * извлекаем из стека
	 * @return InterfacePartViewer | null
	 */
	static public function pop()
	{
		return array_pop(self::$partViewers);
	}

}

