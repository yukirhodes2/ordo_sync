<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// You can remove this if you are confident that your PHP version is sufficient.
if (version_compare(PHP_VERSION, '5.6.0') < 0) {
    trigger_error('Your PHP version must be equal or higher than 5.6.0 to use CakePHP.', E_USER_ERROR);
}

/*
 *  You can remove this if you are confident you have intl installed.
 */
if (!extension_loaded('intl')) {
    trigger_error('You must enable the intl extension to use CakePHP.', E_USER_ERROR);
}

/*
 * You can remove this if you are confident you have mbstring installed.
 */
if (!extension_loaded('mbstring')) {
    trigger_error('You must enable the mbstring extension to use CakePHP.', E_USER_ERROR);
}

/*
 * Configure paths required to find CakePHP + general filepath
 * constants
 */
require __DIR__ . '/paths.php';

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Core\Plugin;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\Network\Request;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Security;

/*
 * Read configuration file and inject configuration into various
 * CakePHP classes.
 *
 * By default there is only one configuration file. It is often a good
 * idea to create multiple configuration files, and separate the configuration
 * that changes from configuration that does not. This makes deployment simpler.
 */
try {
    Configure::config('default', new PhpConfig());
    Configure::load('app', 'default', false);
} catch (\Exception $e) {
    exit($e->getMessage() . "\n");
}

/*
 * Load an environment local configuration file.
 * You can use a file like app_local.php to provide local overrides to your
 * shared configuration.
 */
//Configure::load('app_local', 'default');

/*
 * When debug = true the metadata cache should only last
 * for a short time.
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
}

/*
 * Set server timezone to UTC. You can change it to another timezone of your
 * choice but using UTC makes time calculations / conversions easier.
 */
date_default_timezone_set('Europe/Paris');

/*
 * Configure the mbstring extension to use the correct encoding.
 */
mb_internal_encoding(Configure::read('App.encoding'));

/*
 * Set the default locale. This controls how dates, number and currency is
 * formatted and sets the default language to use for translations.
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/*
 * Register application error and exception handlers.
 */
$isCli = PHP_SAPI === 'cli';
if ($isCli) {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();
} else {
    (new ErrorHandler(Configure::read('Error')))->register();
}

/*
 * Include the CLI bootstrap overrides.
 */
if ($isCli) {
    require __DIR__ . '/bootstrap_cli.php';
}

/*
 * Set the full base URL.
 * This URL is used as the base of all absolute links.
 *
 * If you define fullBaseUrl in your config file you can remove this.
 */
if (!Configure::read('App.fullBaseUrl')) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
    }
    unset($httpHost, $s);
}

Cache::config(Configure::consume('Cache'));
ConnectionManager::config(Configure::consume('Datasources'));
Email::configTransport(Configure::consume('EmailTransport'));
Email::config(Configure::consume('Email'));
Log::config(Configure::consume('Log'));
Security::salt(Configure::consume('Security.salt'));

/*
 * The default crypto extension in 3.0 is OpenSSL.
 * If you are migrating from 2.x uncomment this code to
 * use a more compatible Mcrypt based implementation
 */
//Security::engine(new \Cake\Utility\Crypto\Mcrypt());

/*
 * Setup detectors for mobile and tablet.
 */
Request::addDetector('mobile', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isMobile();
});
Request::addDetector('tablet', function ($request) {
    $detector = new \Detection\MobileDetect();

    return $detector->isTablet();
});

/*
 * Enable immutable time objects in the ORM.
 *
 * You can enable default locale format parsing by adding calls
 * to `useLocaleParser()`. This enables the automatic conversion of
 * locale specific date formats. For details see
 * @link http://book.cakephp.org/3.0/en/core-libraries/internationalization-and-localization.html#parsing-localized-datetime-data
 */
Type::build('time')
    ->useImmutable();
Type::build('date')
    ->useImmutable();
Type::build('datetime')
    ->useImmutable();
Type::build('timestamp')
    ->useImmutable();

/*
 * Custom Inflector rules, can be set to correctly pluralize or singularize
 * table, model, controller names or whatever other string is passed to the
 * inflection functions.
 */
//Inflector::rules('plural', ['/^(inflect)or$/i' => '\1ables']);
//Inflector::rules('irregular', ['red' => 'redlings']);
//Inflector::rules('uninflected', ['dontinflectme']);
//Inflector::rules('transliteration', ['/å/' => 'aa']);

/*
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on Plugin to use more
 * advanced ways of loading plugins
 *
 * Plugin::loadAll(); // Loads all plugins at once
 * Plugin::load('Migrations'); //Loads a single plugin named Migrations
 *
 */

/*
 * Only try to load DebugKit in development mode
 * Debug Kit should not be installed on a production system
 */
if (Configure::read('debug')) {
    Plugin::load('DebugKit', ['bootstrap' => true]);
}

function duration($seconds){
	$d = 0;
	$h = 0;
	$m = 0;
	$s = 0;
	if (!is_int($seconds)){
		echo 'Wrong type of argument for duration($var). Expected integer but '.h(gettype($seconds)).' found.<br/>';
	}
	else{
		$ox = $seconds;
		
		while ($ox > 0){
			if ($ox >= 86400){
				$d += 1;
				$ox -= 86400;
			}
			elseif ($ox >= 3600){
				$h += 1;
				$ox -= 3600;
			}
			elseif ($ox >= 60){
				$m += 1;
				$ox -= 60;
			}
			else{
				$s = $ox;
				$ox -= $ox;
			}
		}
		$str = '';
		if ($d != 0){
			$str .= $d.'j ';
		}
		if ($h != 0){
			$str .= $h.'h ';
		}
		if ($m != 0){
			$str .= $m.'m ';
		}
		if ($s != 0){
			$str .= $s.'s';
		}
		
		return $str;
	}
}

function minToSec($duration){
	if (!is_int($duration)){
		echo 'Wrong type of argument for minToSec($var). Expected integer but '.h(gettype($duration)).' found.<br/>';
	}
	else{
		return $duration*60;
	}
}

function showDefine($var){
	if (isset($var)){
		return(h($var));
	}
	return('<span class="error">'.__('A définir').'</span>');
}

function isOsmose($entity){
	$liberations = [];
			$countSet = 0;
			if ( isset($entity->train_set1) ){
				++$countSet;
				if (count($entity->train_set1->train_set_releases) > 0){
					if ( $entity->train_set1->train_set_releases[count($entity->train_set1->train_set_releases)-1]->active){
						array_push($liberations, $entity->train_set1->train_set_releases[count($entity->train_set1->train_set_releases)-1]->heure);
					}
				}
			} 
			if ( isset($entity->train_set2) ){
				++$countSet;
				if (count($entity->train_set2->train_set_releases) > 0){
					if ( $entity->train_set2->train_set_releases[count($entity->train_set2->train_set_releases)-1]->active){
						array_push($liberations, $entity->train_set2->train_set_releases[count($entity->train_set2->train_set_releases)-1]->heure);
					}
				}
			}
			if ( isset($entity->train_set3) ){
				++$countSet;
				if (count($entity->train_set3->train_set_releases) > 0){
					if ( $entity->train_set3->train_set_releases[count($entity->train_set3->train_set_releases)-1]->active){
						array_push($liberations, $entity->train_set3->train_set_releases[count($entity->train_set3->train_set_releases)-1]->heure);
					}
				}
			}
	if ((!empty($liberations) && !in_array(null, $liberations) && $countSet !== 0 && count($liberations) === $countSet && $countSet !== 0) || isset($entity->osmose)){
		return true;
	}
	return false;
}

function highlightClass($condition, $entity){
	switch($condition){
		case "Commande CRML":	case "CommandeCRML":	case "commandecrml":	case "COMMANDECRML":
			// si toutes les libérations de rame sont faites, si la restit est faite et le freinage a été réalisé
			if ( isset($entity->restit, $entity->brake_controls['0']->realisation_time) && isOsmose($departure) ){
				return 'class="green"';
			}
			if ( isset($entity->restit, $entity->brake_controls['0']->present_id) && ($entity->brake_controls['0']->present_id == 2 ||  $entity->brake_controls['0']->present_id == 3)){
				return 'class="orange"';
			}
			return 'class="red"';
			break;
		
		case "Freinage":	case "FREINAGE":	case "freinage":
		if ( (!empty($entity->brake_controls['0']->realisation_time) && !empty($entity->brake_controls['0']->present)) || 
			  $entity->brake_controls['0']->present_id == 4){ // si le freinage a été fait
						return 'class="green"';
					} else {
						if ( isset($entity->brake_controls['0']->present) ){
							if (($entity->brake_controls['0']->present->id === 2) || ($entity->brake_controls['0']->present->id === 3) /*|| ($entity->brake_controls['0']->present->id === 4)*/){
								return 'class="orange"';
							}
							else{
								return 'class="red"';
							}
						}
						else{
							return 'class="red"';
						}							
					} 
		
		default:
			return null;
	}
}

