<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\TagEntity;

class TagPresenter
{
    public function presentAllTags($tags)
    {
        $formattedTags = [];

        foreach ($tags as $tag) {
            $formattedTags[] = $this->formatTag($tag);
        }
        return $formattedTags;
    }


    public function presentTag($tag)
    {
        return $this->formatTag($tag);
    }

    protected function formatTag(TagEntity $tag)
    {
        return [
            'id' => $tag->getId(),
            'name' => $tag->getName(),
            'name_en' => $tag->getNameEn(),
            'name_ar' => $tag->getNameAr(),
            'icon'=>$tag->getIcon(),
        ];
    }

}
