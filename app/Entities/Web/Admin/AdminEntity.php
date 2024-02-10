<?php

namespace App\Entities\Web\Admin;

class AdminEntity
{

    private $id;
    private $name;
    private $email;
    private $lang;
    private $image;

    private $role;

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

    // Getter for email
    public function getEmail()
    {
        return $this->email;
    }

    // Setter for email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Getter for lang
    public function getLang()
    {
        return $this->lang;
    }

    // Setter for lang
    public function setLang($lang)
    {
        $this->lang = $lang;
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

    public function getRole(){
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}
