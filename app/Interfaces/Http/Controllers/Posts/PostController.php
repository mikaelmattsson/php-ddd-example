<?php

namespace App\Interfaces\Http\Controllers\Posts;

use App\Domain\Model\Post\PostRepository;
use App\Interfaces\Http\Controllers\AbstractController;
use App\Domain\Model\Post\Post;
use Illuminate\Http\Request;

class PostController extends AbstractController
{
    /**
     * @var PostRepository
     */
    private $postService;

    /**
     * @param PostRepository $postService
     */
    public function __construct(PostRepository $postService)
    {
        $this->postService = $postService;
    }

    /**
     * GET
     * /posts
     */
    public function index()
    {
        return $this->postService->getAll();
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

        return $post->toArray();
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