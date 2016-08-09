<?php

namespace App\Interfaces\Http\Controllers\Posts;

use App\Domain\Service\PostService;
use App\Interfaces\Http\Controllers\AbstractController;
use App\Domain\Model\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends AbstractController
{
    /**
     * @var PostService
     */
    private $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * GET
     * /posts
     */
    public function index()
    {
        return [];
    }

    /**
     * POST
     * /posts
     * @param Request $request
     * @return Post
     */
    public function store(Request $request)
    {
        $post = $this->postService->create([
            'text' => $request->get('text'),
        ]);

        return $post;
    }

    /**
     * GET
     * /posts/{id}
     */
    public function show($id)
    {
        return [];
    }


    /**
     * PUT/PATCH
     * /posts/{id}
     */
    public function update($id)
    {
        return [];
    }

    /**
     * DELETE
     * /posts/{id}
     */
    public function destroy($id)
    {
        return [];
    }
}