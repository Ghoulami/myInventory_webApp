<?php

namespace App\Http\Controllers;

use App\Article;
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
        return view('Articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            "qteInStock"=> $request->qte,
            "description"=> $request->description,
            "image_path"=> $path,
            "category_id" => $request->category,
            "stock_id" => 1
        ]);

        Artisan::call('storage:link');
        return redirect()->route('Articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function validateArticle(){
        return request()->validate([
            "name" => 'required|unique:App\Article,name',
            "price" => 'required',
            "taxes" => 'required',
            "qteInStock"=> 'required',
            "image_path"=> 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);
    }
}
