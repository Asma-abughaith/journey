<?php

namespace App\Interfaces\Gateways\Api\User;


interface PostApiRepositoryInterface
{
    public function allPosts();
    public function createPost($validatedData,$media);
    public function updatePost($validatedData,$media);
    public function deletePost($id);
}
