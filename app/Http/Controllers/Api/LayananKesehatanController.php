<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class LayananKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 5;
        if ($request->has('paginate')) {
            $paginate = $request->paginate;
        }

        $articles = Article::where('tipe', 'layanan-kesehatan')->where('publish', '1');

        if ($request->has('search')) {
            $articles = $articles->whereAny(['title', 'short_description', 'conten'], 'ilike', '%'.$request->search.'%');
        }
        $articles = $articles->orderBy('updated_at', 'desc')->paginate($paginate);

        return response()->json([
            'layanan_kesehatan' => $articles->select('id', 'title', 'short_description', 'publish', 'created_at', 'updated_at'),
            'success' => true
        ], 200);
    }

    public function detail($id)
    {
        $articles = Article::where('tipe', 'layanan-kesehatan')->where('publish', '1')
                            ->where('id', $id)
                            ->select('id', 'title', 'short_description', 'conten', 'publish', 'created_at', 'updated_at')
                            ->first();

        if (!empty($articles)) {
            $dataImages = [];
            foreach ($articles->article_image as $img) {
                $artImage = [
                    'title' => $img->title,
                    'image' => asset('storage/article-image/'.$img->image)
                ];
                array_push($dataImages, $artImage);
            }

            $articles['images'] = $dataImages;

            return response()->json([
                'detail_layanan_kesehatan' => $articles,
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'detail_layanan_kesehatan' => null,
                'message' => 'Detail layanan kesehatan tidak ditemukan',
                'success' => false
            ], 404);


        }

    }
}
