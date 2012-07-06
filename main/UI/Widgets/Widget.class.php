<?php

	/**
	 * factory 
	 * @author stev
	 */
	class Widget
	{
		// mixed widgets
		/**
		 *
		 * @param type $name
		 * @return WNavBar
		 */
		static public function navBar($name=null)
		{
			return WNavBar::create($name);
		}
		/**
		 *
		 * @param type $name
		 * @return WidgetSubNav
		 */
		static public function subNav($name=null)
		{
			return WidgetSubNav::create($name);
		}

		/**
		 *
		 * @param type $name
		 * @return WidgetSideBar
		 */
		static public function sideBar($name=null)
		{
			return WidgetSideBar::create($name);
		}

		/**
		 *
		 * @param type $name
		 * @return WEditForm
		 */
		static public function gorizontalMenu($name=null)
		{
			return;
		}

		/**
		 *
		 * @param type $name
		 * @return WEditForm
		 */
		static public function paginator($name=null)
		{
			return ;
		}
		
		// tables
		/**
		 *
		 * @param type $name
		 * @return WidgetTable
		 */
		static public function table($name=null)
		{
			return WidgetTable::create($name);
		}

		//~~~~~~~~ form widgets ~~~~~~~~~~
		/**
		 *
		 * @param type $name
		 * @return WEditForm
		 */
		static public function editForm($name=null)
		{
			return WEditForm::create($name);
		}

		/**
		 *
		 * @param type $name
		 * @return WSelect
		 */
		static public function select($name=null)
		{
			return WSelect::create($name);
		}
		/**
		 *
		 * @param type $name
		 * @return WMultiSelect
		 */
		static public function multiSelect($name=null)
		{
			return WMultiSelect::create($name);
		}
		/**
		 *
		 * @param type $name
		 * @return WTextField
		 */
		static public function textField($name=null)
		{
			return WTextField::create($name);
		}
		/**
		 *
		 * @param type $name
		 * @return WTextArea
		 */
		static public function textArea($name=null)
		{
			return WTextArea::create($name);
		}
		/**
		 *
		 * @param type $name
		 * @return WCalendar
		 */
		static public function calendar($name=null)
		{
			return WCalendar::create();
		}
		/**
		 *
		 * @param type $name
		 * @return WBoolean
		 */
		static public function boolean($name=null)
		{
			return WBoolean::create($name);
		}
		/**
		 *
		 * @param type $name
		 * @return WTernary
		 */
		static public function ternary($name=null)
		{
			return WTernary::create($name);
		}

		// primitive widgets
		/**
		 *
		 * @param type $name
		 * @return WLink
		 */
		static public function link($name)
		{
			return WLink::create();
		}
		/**
		 *
		 * @param type $name
		 * @return WEditForm
		 */
		static public function button($name)
		{
			return ;
		}
	}

