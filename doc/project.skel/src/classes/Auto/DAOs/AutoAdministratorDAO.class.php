<?php
/*****************************************************************************
 *   Copyright (C) 2006-2007, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-0.11.1.111 at 2007-05-08 17:47:09                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/
/* $Id$ */

	abstract class AutoAdministratorDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'administrator';
		}
		
		public function getObjectName()
		{
			return 'Administrator';
		}
		
		public function getSequence()
		{
			return 'administrator_id';
		}
	}
?>