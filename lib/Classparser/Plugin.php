<?php

namespace Classparser;

use Pimcore\API\Plugin as PluginLib;
use Classparser\Config as Config;
use Classparser\Install as Install;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface {
    
	/**
     * @see Classparser_Plugin::install
     * @return string
     */
    public static function install(){
    	$classname = Config::getClassName();
    	$pathToJson = Config::getClassJsonPath();
    	$success = Install::createClassByJson($classname,$pathToJson);

    	if ($success && self::isInstalled()) {
			return "Plugin successfully installed.";
		} else {
			return "Plugin failed to install.";
		}
	}

	/**
     * @see Classparser_Plugin::uninstall
     * @return string
     */
	public static function uninstall() {
		$classname = Config::getClassName();
        $success = Install::removeClass($classname);

        if ($success && !self::isInstalled()) {
        	return "Plugin successfully uninstalled.";
        } else {
			return "Plugin failed to uninstall.";
		}
    }

    /**
     * @see Classparser_Plugin::isInstalled
     * @return boolean
     */
	public static function isInstalled(){
		$classname = Config::getClassName();

		return Install::hasClass($classname);
	}
}

