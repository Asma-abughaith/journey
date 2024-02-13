<?php

namespace App\Entities\Web\Admin;

class RegionEntity
{

    private $id;
    private $name;

    private $name_en;

    private $name_ar;


    public function getId()
    {
        return $this->id;
    }

    // Setter for id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter for name
    public function getName()
    {
        return $this->name;
    }

    // Setter for name
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNameEn()
    {
        return $this->name_en;
    }

    // Setter for name
    public function setNameEn($name)
    {
        $this->name_en = $name;
    }

    public function getNameAr()
    {
        return $this->name_ar;
    }

    // Setter for name
    public function setNameAr($name)
    {
        $this->name_ar = $name;
    }

}
