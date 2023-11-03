<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('source_name', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%");
            });
        }

        // Filter by date range
        if ($dateFrom = $request->input('date_from')) {
            $query->where('published_at', '>=', Carbon::parse($dateFrom)->startOfDay());
        }

        if ($dateTo = $request->input('date_to')) {
            $query->where('published_at', '<=', Carbon::parse($dateTo)->endOfDay());
        }

        $articles = $query->paginate(10);

        return response()->json($articles);
    }

}
