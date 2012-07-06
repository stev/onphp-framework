<?php

/**
 * framework onPHP v.1.0
 * this is a plain "Front Controller"
 *
 * $Id$
**/

	define('TIMER_START', microtime(1));
	
	include '../../conf/conf.php';

	set_include_path(
		get_include_path()
		. PATH_SEPARATOR . PATH_CONTROLLERS . 'admin/'
	);

	try {
		Session::start();

		$request =
			HttpRequest::create()->
				setGet($_GET)->
				setPost($_POST)->
				setCookie($_COOKIE)->
				setServer($_SERVER)->
				setSession($_SESSION)->
				setFiles($_FILES);

		$controllerName = DEFAULT_CONTROLLER;
		$area = DEFAULT_CONTROLLER;

		if ($request->hasGetVar(AREA_NAME)) {
			$area = $request->getGetVar(AREA_NAME);
		} else if ($request->hasPostVar(AREA_NAME)) {
			$area = $request->getPostVar(AREA_NAME);
		}

		if (
			ClassUtils::isClassName($area)
			&& (
				(is_readable(PATH_CONTROLLERS . 'admin'. DIRECTORY_SEPARATOR . $area . EXT_CLASS))
				|| (is_readable(PATH_CONTROLLERS . 'common'. DIRECTORY_SEPARATOR . $area . EXT_CLASS))
			)
		) {
			$controllerName = $area;
		}
		
		
		$controller = new $controllerName;
		$mav = $controller->handleRequest($request);

		$view 	= $mav->getView();
		$model 	= $mav->getModel();

		$skinName = 'bootstrap';
		$prefix = PATH_WEB.'?'.AREA_NAME.'=';

		if (!$view)
			$view = $controllerName;
		elseif (is_string($view)) {
			// if non fatal error occured in controller,
			// you can return 'error'(special kind of view) or throw exception,
			// which should be handled here
			if ($view == 'error')
				$view = new RedirectView($prefix);
		} elseif ($view instanceof RedirectToView)
			$view->setPrefix($prefix);

		if (!$view instanceof View) {
			$viewName = $view;

			$model->set(AREA_NAME, $controllerName);

			$viewResolver =
				MultiPrefixPhpViewResolver::create()->
				setViewClassName('PhpView')->
				addPrefix(
					PATH_TEMPLATES.'admin'.DIRECTORY_SEPARATOR
				)->
				addPrefix(
					PATH_TEMPLATES.'admin'.DIRECTORY_SEPARATOR.'widget'.DIRECTORY_SEPARATOR
				)->
				addPrefix(
					PATH_TEMPLATES.'common'.DIRECTORY_SEPARATOR
				)->
				addPrefix(
					PATH_WWW.'admin'.DIRECTORY_SEPARATOR
				)->
				addPrefix(
					ONPHP_SOURCE_PATH.'template'.DIRECTORY_SEPARATOR.'widget'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR
				);

			$view = $viewResolver->resolveViewName($viewName);
		}

		if (!$view instanceof RedirectView) {
			$model->
				set('skinName', $skinName)->
				set('selfUrl', PATH_WEB.'?'.AREA_NAME.'='.$controllerName)->
				set('baseUrl', PATH_WEB)->
				set('controllerName', $controllerName);
			$model->set(
				'sidebarMenu',
				array(
					array(
						'title' => 'Главная',
						'url'	=> Href::create(),
					),
					array(
						'title' => 'Мониторинг',
						'url'	=> Href::create(),
						'sub'	=> array(
							array(
								'title' => 'Запас',
								'url'	=> Href::create(),
							)
						)
					)
				)
			);
		}

		$view->render($model);

	} catch (Exception $e) {

		echo "<pre>";
		echo
			"\n"
			.'class: ' . get_class($e) . "\n"
			.'code: ' . $e->getCode() . "\n"
			.'message: ' . $e->getMessage() . "\n\n"
			.'memory: ' . TextUtils::friendlyFileSize(memory_get_usage(TRUE))."\n"
			.'memory peak: '.(TextUtils::friendlyFileSize(memory_get_peak_usage(TRUE)))."\n\n"
			.$e->getTraceAsString()."\n\n"
			.'uri: '.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]."\n"
			."\n_POST=". var_export($_POST,1)
			."\n_GET=".  var_export($_GET,1);

		if(isset($_SERVER['HTTP_REFERER']))
				echo "\nREFERER=".var_export($_SERVER['HTTP_REFERER']);

		if (isset($_SESSION))
				echo "\n_SESSION=".print_r($_SESSION, 1);

		echo "</pre>";
	}
