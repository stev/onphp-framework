<?php
/***************************************************************************
 *   Copyright (C) by Evgeny M. Stepanov                                   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 ***************************************************************************/
/* $Id: HtmlTable.class.php 365 2011-03-03 14:02:48Z andrew $ */



class HtmlTable extends WidgetTable
{
	/**
	 * @return HtmlTable
	 */
	public static function create()
	{
		$class = get_called_class();
		return new $class();
	}
}

