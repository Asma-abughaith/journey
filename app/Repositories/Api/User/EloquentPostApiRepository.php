<?php

namespace App\Repositories\Api\User;


use App\Interfaces\Gateways\Api\User\PostApiRepositoryInterface;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EloquentPostApiRepository implements PostApiRepositoryInterface
{
    public function allPosts()
    {

    }

    public function createPost($validatedData,$media)
    {
        $eloquentPost = Post::create($validatedData);
        if ($media !== null) {
            foreach ($media as $image) {
                $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = Str::random(10) . '_' . time() . '.' . $extension;
                $eloquentPost->addMedia($image)->usingFileName($filename)->toMediaCollection('post');
            }
        }

    }

    public function updatePost($validatedData,$media)
    {

    }


    public function deletePost($id)
    {

    }


}
