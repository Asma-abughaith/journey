<?php

namespace App\Entities\Web\Admin;

class TripEntity
{

    private $id;
    private $name;
    private $description;
    private $creator;
    private $place;
    private $cost;
    private $min_age;
    private $max_age;
    private $sex;
    private $datetime;
    private $attendance_number;
    private $status;
    private $users_trip = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place): void
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getMinAge()
    {
        return $this->min_age;
    }

    /**
     * @param mixed $min_age
     */
    public function setMinAge($min_age): void
    {
        $this->min_age = $min_age;
    }

    /**
     * @return mixed
     */
    public function getMaxAge()
    {
        return $this->max_age;
    }

    /**
     * @param mixed $max_age
     */
    public function setMaxAge($max_age): void
    {
        $this->max_age = $max_age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getAttendanceNumber()
    {
        return $this->attendance_number;
    }

    /**
     * @param mixed $attendance_number
     */
    public function setAttendanceNumber($attendance_number): void
    {
        $this->attendance_number = $attendance_number;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUsersTrip()
    {
        return $this->users_trip;
    }

    /**
     * @param mixed $users_trip
     */
    public function setUsersTrip($users_trip): void
    {
        $this->users_trip = $users_trip;
    }





}
