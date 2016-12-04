<?php


class DataObject {
    protected $_tableInfo;
    protected $_relationshipMap;

    protected $changedFields = array(); // list of updated fields
    protected $data = array(); // original row from PDOStatement

    // The properties above are private in this class, so even if in your subclass you define some properties named the same, or you associate a property of the same name with a field in your table, they will never influence these properties.
    function __get($property) {

        if (isset($this->_propertyList[$property])) {
            return $this->data[$this->_propertyList[$property]]; // access fields by PHP properties
        } else {
            return $this->$property; // throw the default PHP error
        }
    }
    function __set($property, $value) {

        if (isset($this->_propertyList[$property])) {
            $field = $this->_propertyList[$property];
            $this->data[$field] = $value; // update $data

            // take down changed fields
            if (!in_array($field, $this->changedFields)) {
                array_push($this->changedFields, $field);
            }
        } else {
            // For fetchObject
            $this->data[$property] = $value; // redirect to Array $data
        }
    }
    public function findByPk(){}
    public function delete() {}
    public function insert() {}
    public function update() {}


    public static function create($attributes, $validate=true)
    {
        $class_name = get_called_class();
        $model = new $class_name($attributes);
        $model->save($validate);
        return $model;
    }

}
?>