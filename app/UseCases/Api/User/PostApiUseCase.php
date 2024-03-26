<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\PostApiRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostApiUseCase
{
    protected $postRepository;

    public function __construct(PostApiRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost($validatedData)
    {
        return $this->postRepository->createPost([
            'user_id'=>Auth::guard('api')->user()->id,
            'visitable_type'=>$validatedData['visitable_type'],
            'visitable_id'=>$validatedData['visitable_id'],
            'content'=>$validatedData['content'],
            'privacy'=>$validatedData['privacy'],
            ],
            isset($validatedData['media']) ? $validatedData['media'] : null,
        );
    }

    public function updatePost($validatedData)
    {
        return $this->postRepository->updatePost($validatedData,[]);
    }

    public function deletePost($id)
    {
        return $this->postRepository->deletePost($id);
    }

    public function allPosts()
    {
        return $this->postRepository->allPosts();
    }


}
