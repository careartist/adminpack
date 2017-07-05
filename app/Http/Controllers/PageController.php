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

        $articles_limit = \Config::get('settings.articles_per_page');
        $items_limit = \Config::get('settings.items_per_page');
        
        $articles = Article::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->take($articles_limit)->get();
        $items = Item::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->take($items_limit)->get();

        return view('pages.'.$page->template, $this->data)
                        ->with('news', $articles)
                        ->with('items', $items);
    }
}