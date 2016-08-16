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
     * /post
     */
    public function index()
    {
        $documents =  $this->postRepository->getAll();

        $response = [];

        foreach ($documents as $document) {
            $response[] = $this->postRepository->getMapper()->serialize($document);
        }

        return $response;
    }

    /**
     * POST
     * /post
     * @param Request $request
     * @return Post
     */
    public function store(Request $request)
    {
        $post = $this->postRepository->create([
            'text' => $request->get('text'),
        ]);

        return $this->postRepository->getMapper()->serialize($post);
    }

    /**
     * GET
     * /post/{id}
     */
    public function show($id)
    {
        return [];
    }


    /**
     * PUT/PATCH
     * /post/{id}
     */
    public function update($id)
    {
        return [];
    }

    /**
     * DELETE
     * /post/{id}
     */
    public function destroy($id)
    {
        return [];
    }
}