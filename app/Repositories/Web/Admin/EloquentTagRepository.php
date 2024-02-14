<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\TagEntity;
use App\Interfaces\Gateways\Web\Admin\TagRepositoryInterface;
use App\Models\Tag;


class EloquentTagRepository implements TagRepositoryInterface
{
    public function getAllTags()
    {
        $eloquentTags = Tag::all();
        $tags = [];

        foreach ($eloquentTags as $eloquentTag) {
            $tags[] = $this->convertToEntity($eloquentTag);
        }

        return $tags;
    }

    public function getTag($tag)
    {
        return $this->convertToEntity($tag);
    }

    public function getTagById($tagId)
    {
        $eloquentTag = Tag::find($tagId);
        return $eloquentTag ? $this->convertToEntity($eloquentTag) : null;
    }

    public function createTag(array $tagData)
    {
        $eloquentTag = Tag::create($tagData);
        $eloquentTag->setTranslations('name', $tagData['name']);
        return $this->convertToEntity($eloquentTag);
    }

    public function updateTag($tag, array $tagData)
    {
        $tag->update($tagData);
        $tag->setTranslations('name', $tagData['name']);
        return $this->convertToEntity($tag);
    }


    public function deleteTag($tag)
    {
        if ($tag) {
            $tag->delete();
        }
        return;
    }

    protected function convertToEntity(Tag $eloquentTag)
    {
        $names =$eloquentTag->getTranslations('name');
        $tag = new TagEntity();
        $tag->setId($eloquentTag->id);
        $tag->setName($eloquentTag->name);
        $tag->setNameEn($names['en']);
        $tag->setNameAr($names['ar']);
        $tag->setIcon($eloquentTag->icon);
        return $tag;
    }
}
