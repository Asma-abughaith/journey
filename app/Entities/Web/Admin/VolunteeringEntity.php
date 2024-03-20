<?php

namespace App\Entities\Web\Admin;

class VolunteeringEntity
{

    private $id;
    private $name;
    private $name_en;
    private $name_ar;
    private $description;
    private $description_en;
    private $description_ar;
    private $address;
    private $address_en;
    private $address_ar;
    private $link;
    private $hours_worked;
    private $region;
    private $image;
    private $status;
    private $start_datetime;
    private $end_datetime;
    private $organizers =[];
    private $attendance_number;

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
    public function getOrganizers()
    {
        return $this->organizers;
    }

    /**
     * @param mixed $organizers
     */
    public function setOrganizers($organizers): void
    {
        foreach ($organizers as $organizer) {
            $this->organizers[] = [
                'id' => $organizer->id,
                'name' => $organizer->name,
            ];
        }
    }

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
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @param mixed $name_en
     */
    public function setNameEn($name_en): void
    {
        $this->name_en = $name_en;
    }

    /**
     * @return mixed
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * @param mixed $name_ar
     */
    public function setNameAr($name_ar): void
    {
        $this->name_ar = $name_ar;
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
    public function getDescriptionEn()
    {
        return $this->description_en;
    }

    /**
     * @param mixed $description_en
     */
    public function setDescriptionEn($description_en): void
    {
        $this->description_en = $description_en;
    }

    /**
     * @return mixed
     */
    public function getDescriptionAr()
    {
        return $this->description_ar;
    }

    /**
     * @param mixed $description_ar
     */
    public function setDescriptionAr($description_ar): void
    {
        $this->description_ar = $description_ar;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddressEn()
    {
        return $this->address_en;
    }

    /**
     * @param mixed $address_en
     */
    public function setAddressEn($address_en): void
    {
        $this->address_en = $address_en;
    }

    /**
     * @return mixed
     */
    public function getAddressAr()
    {
        return $this->address_ar;
    }

    /**
     * @param mixed $address_ar
     */
    public function setAddressAr($address_ar): void
    {
        $this->address_ar = $address_ar;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getHoursWorked()
    {
        return $this->hours_worked;
    }

    /**
     * @param mixed $hours_worked
     */
    public function setHoursWorked($hours_worked): void
    {
        $this->hours_worked = $hours_worked;
    }



    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
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
    public function getStartDatetime()
    {
        return $this->start_datetime;
    }

    /**
     * @param mixed $start_datetime
     */
    public function setStartDatetime($start_datetime): void
    {
        $this->start_datetime = $start_datetime;
    }

    /**
     * @return mixed
     */
    public function getEndDatetime()
    {
        return $this->end_datetime;
    }

    /**
     * @param mixed $end_datetime
     */
    public function setEndDatetime($end_datetime): void
    {
        $this->end_datetime = $end_datetime;
    }





}
