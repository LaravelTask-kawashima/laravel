<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getMyPosts();
    public function getSearchPosts($request);
}