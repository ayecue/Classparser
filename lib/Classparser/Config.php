<?php

namespace Classparser;

use Object\ClassDefinition as ClassDefinition;

class Config {
	
	/**
     * @see Classparser_Config::getClassJsonPath
     * @return string
     */
	static public function getClassJsonPath() {
        return PIMCORE_PLUGINS_PATH . "/Classparser/install/class_Classhelper.json";
    }

    /**
     * @see Classparser_Config::getClassName
     * @return string
     */
    static public function getClassName(){
        return "Classhelper";
    }

    /**
     * @see Classparser_Config::getClassType
     * @return Object_Classhelper
     */
	static public function getClassType(){
		return ClassDefinition::getByName(self::getClassName());
	}

	/**
     * @see Classparser_Config::getClassJsonPath
     * @return string
     */
    static public function getClassTagProperty(){
        return "classtag";
    }
    
}

