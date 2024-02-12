<?php

namespace App\Entities\Web\Admin;

class SubCategoryEntity
{

    private $id;
    private $name;

    private $name_en;

    private $name_ar;
    private $image;
    private $priority;

    private $category;

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


    // Getter for image
    public function getImage()
    {
        return $this->image;
    }

    // Setter for image
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPriority(){
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
