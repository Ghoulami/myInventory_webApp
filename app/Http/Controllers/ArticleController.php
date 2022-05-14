<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        $category = new Category();

        return view('Articles.index', [
            'articles' =>  $article->allArticles()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('Articles.create', [
            'article' => new Article(),
            'categories' => $category->allCategories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            "name" => 'unique:App\Article,name',
        ]);
        $this->validateArticle($request);

        $path = 'storage/images/noImage.png';

        if ($request->hasFile('image'))
        {
            $path = 'storage/'.$request->file('image')->store('images');
        }

        Article::create([
            "name" => $request->name,
            "price" => $request->price,
            "taxes" => $request->taxes,
            "weight" => $request->weight,
            "volume" => $request->volume,
            "qteInStock"=> $request->qteInStock,
            "description"=> $request->description,
            "image_path"=> $path,
            "category_id" => $request->category,
            "stock_id" => 1
        ]);

        Artisan::call('storage:link');
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $category = new Category();
        return view('articles.edit', [
            'article'=> $article,
            'categories' => $category->allCategories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validateArticle($request);

        $path = $request->hideImage;

        if ($request->hasFile('image_path'))
        {
            $path = 'storage/'.$request->file('image_path')->store('images');
        }

        $article->fill([
                "name" => $request->name,
                "price" => $request->price,
                "taxes" => $request->taxes,
                "weight" => $request->weight,
                "volume" => $request->volume,
                "qteInStock"=> $request->qteInStock,
                "description"=> $request->description,
                "image_path"=> $path,
                "category_id" => $request->category,
                "stock_id" => 1
        ]);

        $article->save();
        Artisan::call('storage:link');
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function validateArticle(Request $request)
    {
        return $request->validate([
            "name" => 'required',
            "price" => 'required',
            "taxes" => 'required',
            "qteInStock"=> 'required',
            "image_path"=> 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);
    }
}
