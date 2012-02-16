<?php
/***************************************************************************
 *   Copyright (C) by Stepanov Evgeny                                      *
 *   from.stev@gmail.com                                                   *
 * **************************************************************************
 * $Id$ */



class GuiUtils
{
	public static function ObjectToString($object)
	{
		if (is_object($object)) {

			if ($object instanceof Stringable)
				return $object->toString();

			elseif ($object instanceof ToString)
				return (string)$object;

			elseif ($object instanceof Date)
				return (string)$object->toDate();

			elseif ($object instanceof Named)
				return $object->getName();

			elseif ($object instanceof Titled)
				return $object->getTitle();

			elseif ($object instanceof Identifiable)
				return get_class($object).'['.$object->getId().']';
		} else
			return (string)$object;
	}
}
