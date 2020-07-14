<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // rendera list
    public function show($id){

        $article = Article::find($id);
        return view('articles.show', ['article' => $article]);
    }

// sow a list
    public function index(){
        $articles = Article::latest('created_at')->get();
        // dd($articles);
        return view('articles', ['articles' => $articles]);
    }

// show a view to create a new resource
    public function create(){
        return view('articles.create');
    }
// persist the create form
    public function store(){

        //validation
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
        //clean up
        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();
        return redirect('/articles');
    }

    // show a view to edit an existing resuoruce
    public function edit($id){
        $article = Article::find($id);

        return view('articles.edit', ['article' => $article]);

    }

    // persist the edited form
    public function update($id){

        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
        $article = Article::find($id);
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();
        return redirect('/articles');

    }

    // delete the resource
    public function destroy(){

    }


}
