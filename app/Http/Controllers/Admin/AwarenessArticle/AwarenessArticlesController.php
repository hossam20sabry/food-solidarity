<?php

namespace App\Http\Controllers\Admin\AwarenessArticle;

use App\Http\Controllers\Controller;
use App\Models\AwarenessArticle;
use Illuminate\Http\Request;

class AwarenessArticlesController extends Controller
{
    public function index()
    {
        $articles = AwarenessArticle::all();
        return view('admin.awarenessArticle.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.awarenessArticle.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i',
            'img' => 'required',
        ]);

        $article = new AwarenessArticle();
        $article->text = $request->text;
        if($request->file('img')) {
            $img = $request->file('img');
            $img_name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $img_name);
            $article->img = $img_name;
        }
        else {
            $article->img = 'default.png';
        }
        $article->save();

        return redirect()->route('admin.awarenessArticles.index')->with('status', 'Article created successfully');
    }

    public function edit($id)
    {
        $article = AwarenessArticle::find($id);
        return view('admin.awarenessArticle.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
        ]);

        $article = AwarenessArticle::find($id);
        $article->text = $request->text;
        $img = $request->file('img');
        if($img) {
            $img_name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $img_name);
            $article->img = $img_name;
        }
        
        $article->save();

        return redirect()->back()->with('status', 'Article updated successfully');
    }

    public function destroy($id)
    {
        $article = AwarenessArticle::find($id);
        $article->delete();
        return redirect()->route('admin.awarenessArticles.index')->with('status', 'Article deleted successfully');
    }

    public function explore($id){
        $articles = AwarenessArticle::all();
        foreach($articles as $article){
            $article->explore = 0;
            $article->save();
        }

        $article = AwarenessArticle::find($id);
        $article->explore = 1;
        $article->save();

        return redirect()->route('admin.awarenessArticles.index')->with('status', 'Article explored successfully');
    }
}
