<?php

namespace App\Entities\Web\Admin;

class RoleEntity{

    private $id;
    private $name;
    private $name_i18n;
    private $guard_name;


    // Constructor when make instance of class we should put those in side it..... we will see if we will make it or not

//    public function __construct($id, $name, $name_i18n, $guard_name) {
//        $this->id = $id;
//        $this->name = $name;
//        $this->name_i18n = $name_i18n;
//        $this->guard_name = $guard_name;
//    }

    public function getId() {
        return $this->id;
    }

    // Setter for id
    public function setId($id) {
        $this->id = $id;
    }

    // Getter for name
    public function getName() {
        return $this->name;
    }

    // Setter for name
    public function setName($name) {
        $this->name = $name;
    }

    // Getter for name_i18n
    public function getNameI18n() {
        return $this->name_i18n;
    }

    // Setter for name_i18n
    public function setNameI18n($name_i18n) {
        $this->name_i18n = $name_i18n;
    }

    // Getter for guard_name
    public function getGuardName() {
        return $this->guard_name;
    }

    // Setter for guard_name
    public function setGuardName($guard_name) {
        $this->guard_name = $guard_name;
    }


}
