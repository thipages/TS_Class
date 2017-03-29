<?php
/**
 * Created by IntelliJ IDEA.
 * User: tit
 * Date: 27/03/2017
 * Time: 14:02
 */

/**
 * Class TS_Class
 */
abstract class TS_Class {
    private $_properties=null;
    private $_propertiesDefinitions;
    /**
     * TS_Class constructor.
     */
    function __construct() {
        $this->_buildPropertiesContainer();
    }

    /**
     * @return array
     */
    public function getProperties() {
        return array_keys($this->_properties);
    }

    /**
     * @param string $propertyName
     * @return mixed|null
     */
    public function get($propertyName) {
        if (array_key_exists($propertyName,$this->_properties))
            return $this->_properties[$propertyName];
        else
            return null;
    }
    /**
     * @param string $propertyName
     * @param mixed $value
     */
    public function set($propertyName,$value) {
        if (array_key_exists($propertyName,$this->_properties)) {
            $this->_properties[$propertyName] = $value;
            $this->_propertiesDefinitions[$propertyName]->isDefined = true;
        }
    }
    /**
     * @param array $associativeArray
     */
    public function arraySet($associativeArray) {
        if ($this->_isAssociativeArray($associativeArray)){
            $this->_properties=$associativeArray;
        }
    }
    private function _buildPropertiesContainer() {
        $propertyNameList=$this->_getProperties(get_class($this));
        $this->_properties=array();
        $this->_propertiesDefinitions=array();
        foreach ($propertyNameList as $propertyName) {
            $this->_properties[$propertyName]=null;
            $this->_propertiesDefinitions[$propertyName]=new TS_PropertyDefinition();
            $this->_propertiesDefinitions[$propertyName]->isDefined=false;
        }
    }

    /**
     * @param string $className
     * @return array
     */
    private static function _getProperties($className) {
        $class = new ReflectionClass($className);
        $staticProperties= $class->getStaticProperties();
        // sorting allows to have an property order that can be used in compression/data transfers
        sort($staticProperties);
        return $staticProperties;
    }

    /**
     * @param array $arr
     * @return bool
     */
    private static function _isAssociativeArray(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}

/**
 * Class TS_PropertyDefinition
 */
class TS_PropertyDefinition {
    /**
     * @var bool
     */
    public $isDefined;
}