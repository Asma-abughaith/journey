<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\TagRepositoryInterface;

class TagUseCase
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function allTags()
    {
        return $this->tagRepository->getAllTags();
    }

    public function getTag($tag)
    {
        return $this->tagRepository->getTag($tag);
    }

    public function getTagById($tagId)
    {
        return $this->tagRepository->getTagById($tagId);
    }

    public function createTag($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->tagRepository->createTag(
            [
                'name' => $translator,
                'icon'=>$request['icon']
            ],
        );
    }

    public function updateTag($tag, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->tagRepository->updateTag(
            $tag,
            [
                'name' => $translator,
                'icon'=>$request['icon']
            ],
        );
    }

    public function deleteTag($tag)
    {
        return $this->tagRepository->deleteTag($tag);
    }

}
