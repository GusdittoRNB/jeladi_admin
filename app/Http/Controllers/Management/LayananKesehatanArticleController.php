<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class LayananKesehatanArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('tipe', 'layanan-kesehatan')->get();
        return view('cms.admin.layanan-kesehatan.article.index', compact('articles'));
    }

    public function create()
    {
        return view('cms.admin.layanan-kesehatan.article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'conten' => 'required',
            'publish' => 'required|in:1,0',
        ]);

        $dataArticle = $request->only('title', 'short_description', 'conten', 'publish');
        $dataArticle['tipe'] = 'layanan-kesehatan';

        Article::create($dataArticle);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Artikel layanan kesehatan telah ditambahkan']);
        return redirect()->route('layanan-kesehatan.article.index');
    }

    public function edit($id)
    {
        $article = Article::where('tipe', 'layanan-kesehatan')->where('id', $id)->firstOrFail();
        return view('cms.admin.layanan-kesehatan.article.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'conten' => 'required',
            'publish' => 'required|in:1,0',
        ]);

        $article = Article::where('tipe', 'layanan-kesehatan')->where('id', $id)->firstOrFail();

        $dataArticle = $request->only('title', 'short_description', 'conten', 'publish');

        $article->update($dataArticle);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Artikel layanan kesehatan telah diupdate']);
        return redirect()->route('layanan-kesehatan.article.index');
    }

    public function destroy(Request $request, $id)
    {
        $article = Article::where('tipe', 'layanan-kesehatan')->where('id', $id)->firstOrFail();
        $article->delete();

        \Session::flash('notification', ['level' => 'success', 'message' => 'Artikel layanan kesehatan telah dihapus']);
        return redirect()->route('layanan-kesehatan.article.index');
    }
}
