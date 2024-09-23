<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class LayananKesehatanImageController extends Controller
{
    public function index($id)
    {
        $article = Article::where('tipe', 'layanan-kesehatan')->where('id', $id)->firstOrFail();
        $articleImages = ArticleImage::where('article_id', $article->id)->get();
        return view('cms.admin.layanan-kesehatan.article-image.index', compact('article', 'articleImages'));
    }

    public function store(Request $request, $id)
    {
        $article = Article::where('tipe', 'layanan-kesehatan')->where('id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'add')
                ->withInput();
        }

        $dataImage = $request->only('title');
        $dataImage['article_id'] = $article->id;

        if ($request->hasFile('image')) {
            $dataImage['image'] = $this->saveImageArticle($request->file('image'), $request->title);
        }

        ArticleImage::create($dataImage);

        \Session::flash('notification', ['level' => 'success', 'message' => 'Article image telah ditambahkan']);
        return redirect()->route('layanan-kesehatan.article-image.index', $article->id);
    }

    public function edit($id)
    {
        $image = ArticleImage::where('id', $id)->firstOrFail();
        return view('cms.admin.layanan-kesehatan.article-image._edit', compact('image'))->render();
    }

    public function update(Request $request, $id)
    {
        $image = ArticleImage::where('id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            \Session::flash('edit_fails_id', $id);
            return redirect()->back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $dataImage = $request->only('title');

        if ($request->hasFile('image')) {
            $validator2 = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,png'
            ]);

            if ($validator2->fails()) {
                \Session::flash('edit_fails_id', $id);
                return redirect()->back()
                    ->withErrors($validator, 'edit')
                    ->withInput();
            }

            $dataImage['image'] = $this->saveImageArticle($request->file('image'), $request->title);
            if ('' !== $image->image) {
                $this->deleteImageArticle($image->image);
            }
        }

        $image->update($dataImage);
        \Session::flash('notification', ['level' => 'success', 'message' => 'Article image telah diupdate']);
        return redirect()->route('layanan-kesehatan.article-image.index', $image->article_id);
    }

    public function delete($id)
    {
        $image = ArticleImage::where('id', $id)->firstOrFail();
        $articleId = $image->article_id;

        if ('' !== $image->image) {
            $this->deleteImageArticle($image->image);
        }
        $image->delete();
        \Session::flash('notification', ['level' => 'success', 'message' => 'Article image telah diupdate']);
        return redirect()->route('layanan-kesehatan.article-image.index', $articleId);
    }

    protected function saveImageArticle(UploadedFile $photo, $nama)
    {
        $fileName = str_slug($nama).'-'.date('YmdHis').'.'.$photo->guessClientExtension();
        $destinationPath = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'article-image';
        Image::read($photo)->scale(651, 435)->save($destinationPath.DIRECTORY_SEPARATOR.$fileName);

        return $fileName;
    }

    protected function deleteImageArticle($filename)
    {
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'article-image'.DIRECTORY_SEPARATOR.$filename;

        return File::delete($path);
    }
}
