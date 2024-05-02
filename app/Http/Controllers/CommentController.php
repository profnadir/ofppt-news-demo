<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForArticle(Article $article, Request $request)
    {
        $validated = $request->validate([
            'content' =>'required',
            'author' =>'required',
        ]);

        /* $comment = new Comment($validated);
        $article->comments()->save($comment); */

        $comment = $article->comments()->create($validated);

        return redirect()->route('articles.show', $article)->with('success', 'Comment created successfully');
    }

    public function storeForProduct(Product $product, Request $request)
    {
        $validated = $request->validate([
            'content' =>'required',
            'author' =>'required',
        ]);

        $comment = $product->comments()->create($validated);

        return redirect()->route('products.show', $product)->with('success', 'Comment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
