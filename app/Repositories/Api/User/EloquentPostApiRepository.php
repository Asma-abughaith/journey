<?php

namespace App\Repositories\Api\User;


use App\Helpers\ApiResponse;
use App\Http\Resources\SinglePostResource;
use App\Interfaces\Gateways\Api\User\PostApiRepositoryInterface;

use App\Models\Post;
use App\Rules\CheckUserTripExistsRule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EloquentPostApiRepository implements PostApiRepositoryInterface
{
    public function allPosts()
    {
    }

    public function createPost($validatedData, $media)
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

    public function updatePost($validatedData, $media)
    {
        $eloquentPost = Post::findOrFail($validatedData['post_id']);
        unset($validatedData['post_id']);
        $eloquentPost->update($validatedData);
        if ($media !== null) {
            foreach ($media as $image) {
                $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = Str::random(10) . '_' . time() . '.' . $extension;
                $eloquentPost->addMedia($image)->usingFileName($filename)->toMediaCollection('post');
            }
        }
    }

    public function showPost($id)
    {
        $eloquentPost = Post::findOrFail($id);
        return new SinglePostResource($eloquentPost);


    }

    public function deleteImage($id)
    {
        if ($id) {
            Media::find($id)->delete();
        }
        return;


    }


    public function delete($id)
    {
        Post::find($id)->delete();
    }
}
