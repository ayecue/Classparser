<?php

namespace Document\Tag;

use Document\Tag as DocumentTag;
use Classparser\Config as Config;
use Classparser\Install as Install;

class Classparser extends DocumentTag\Multihref {
    /**
     * @see Document_Tag_Classparser::getClassName
     * @return string
     */
    static public function getClassName(){
        return Config::getClassName();
    }

    /**
     * @see Document_Tag_Classparser::getClassType
     * @return Object_Class
     */
	static public function getClassType(){
		return Config::getClassType();
	}

    /**
     * @see Document_Tag_Classparser::getClassTagProperty
     * @return string
     */
    static public function getClassTagProperty(){
        return Config::getClassTagProperty();
    }

    /**
     * @see Document_Tag_Classparser::getType
     * @return string
     */
    public function getType() {
        return "classparser";
    }

    /**
     * @see Document_Tag_Classparser::admin
     * @return string
     */
    public function admin() {
        $options = $this->getOptions();

        if (!isset($options) || empty($options)) {
            $options = array();
        }

        $options = array_merge(
            $options,
            array(
                'title' => self::getClassName(),
                'allowedTypes' => array(
                    self::getClassTypeString()
                )
            )
        );

        $this->setOptions($options);

        return parent::admin();
    }

    /**
     * @see Document_Tag_Classparser::getClass
     * @param boolean $doPrintOutput
     * @return string
     */
    public function getClass($doPrintOutput = FALSE){
        $className = self::getClassName();

    	if (!Install::hasClass($className)) {
            \Logger::error("Class $className doesn't exist.");

    		return;
    	}

        $classType = self::getClassType();
        $classTagProperty = self::getClassTagProperty();
        $getClassTagPropertyMethod = "get" . ucfirst($classTagProperty);
    	$classStack = array();

    	foreach ($this as $class) {
    		if ($class instanceof $classType && method_exists($class,$getClassTagPropertyMethod)) {
    			$value = $class->$getClassTagPropertyMethod();

    			if (!empty($value)) {
    				$classStack[] = $value;
    			}
    		} else {
                \Logger::error("Invalid class " . get_class($class) . ".");
            }
    	}

    	$output = implode(" ",$classStack);

        if ($doPrintOutput) {
            echo $output;
        }

    	return $output;
    }
}