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
        switch ($validatedData['visitable_type']){
            case "place":
                $validatedData['visitable_type']='App\Models\Place';
                break;
            case "plan":
                $validatedData['visitable_type']='App\Models\Plan';
                break;
            case "trip":
                $validatedData['visitable_type']='App\Models\Trip';
                break;
        }
        return $this->postRepository->createPost(
            [
                'user_id' => Auth::guard('api')->user()->id,
                'visitable_type' => $validatedData['visitable_type'],
                'visitable_id' => $validatedData['visitable_id'],
                'content' => $validatedData['content'],
                'privacy' => $validatedData['privacy'],
            ],
            isset($validatedData['media']) ? $validatedData['media'] : null,
        );
    }

    public function updatePost($validatedData)
    {
        switch ($validatedData['visitable_type']){
            case "place":
                $validatedData['visitable_type']='App\Models\Place';
                break;
            case "plan":
                $validatedData['visitable_type']='App\Models\Plan';
                break;
            case "trip":
                $validatedData['visitable_type']='App\Models\Trip';
                break;
        }
        return $this->postRepository->updatePost(
            [
                'user_id' => Auth::guard('api')->user()->id,
                'visitable_type' => $validatedData['visitable_type'],
                'visitable_id' => $validatedData['visitable_id'],
                'content' => $validatedData['content'],
                'privacy' => $validatedData['privacy'],
                'post_id' => $validatedData['post_id']
            ],
            isset($validatedData['media']) ? $validatedData['media'] : null,
        );
    }

    public function showPost($id)
    {
        return $this->postRepository->showPost($id);
    }

    public function deletePost($id)
    {
        return $this->postRepository->deletePost($id);
    }

    public function deleteImage($id)
    {
        return $this->postRepository->deleteImage($id);
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }

    public function allPosts()
    {
        return $this->postRepository->allPosts();
    }
}
