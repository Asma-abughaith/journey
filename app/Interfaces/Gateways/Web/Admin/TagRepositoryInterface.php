<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface TagRepositoryInterface
{
    public function getAllTags();

    public function getTagById($tagId);

    public function getTag($tag);

    public function createTag(array $tagData);

    public function updateTag($tag, array $tagData);

    public function deleteTag($tag);
}
