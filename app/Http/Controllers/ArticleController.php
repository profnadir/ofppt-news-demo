<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['image','user'])->get();
        // $articles = Article::get();
        // $articles = Article::orderBy('title')->take(5)->get();
        // $articles = Article::paginate(10);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' =>'required',
            'content' =>'required',
            'categories' => 'array', 
            'url' => 'url'
        ]);

        $article = $request->user()->articles()->create($validated);

        if ($request->has('url')) {
            $article->image()->create(
                [
                    'url' => 'https://picsum.photos/id/'.$article->id.'/200/300'
                ]
            );
        }
       

        $article->categories()->attach($validated['categories']);

        return redirect()->route('articles.index')->with('success','article created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if(auth()->user()->id !== $article->user_id){
            return redirect()->route('articles.index')->with('error','you are not authorized to edit this article');
        }

        $categories = Categorie::all();
        return view('articles.edit', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if($request->user()->id !== $article->user_id){
            return redirect()->route('articles.index')->with('error','you are not authorized to edit this article');
        }
 
        $validated = $this->validate($request, [
            'title' =>'required',
            'content' =>'required',
            'categories' => 'array'
        ]);

        $article->update($validated);

            // Mise à jour des catégories de l'article
            if (isset($validated['categories'])) {
                $article->categories()->sync($validated['categories']);
            } else {
                // Si aucune catégorie n'est sélectionnée, supprime toutes les catégories existantes
                $article->categories()->detach();
            }

        return redirect()->route('articles.index')->with('success','article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if(auth()->user()->id !== $article->user_id){
            return redirect()->route('articles.index')->with('error','you are not authorized to edit this article');
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success','article deleted successfully');
    }
}
