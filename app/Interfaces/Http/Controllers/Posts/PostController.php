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
    private $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * GET
     * /posts
     */
    public function index()
    {
        return $this->postRepository->getAll();
    }

    /**
     * POST
     * /posts
     * @param Request $request
     * @return Post
     */
    public function store(Request $request)
    {
        $post = $this->postRepository->create([
            'text' => $request->get('text'),
        ]);

        $this->postRepository->save();

        return $this->postRepository->getMapper()->serialize($post);
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