<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\ItemsCRUD\app\Models\Item;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::findBySlug($slug);

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $articles = Article::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->take(5)->get();
        $items = Item::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('pages.'.$page->template, $this->data)
                        ->with('news', $articles)
                        ->with('items', $items);
    }
}