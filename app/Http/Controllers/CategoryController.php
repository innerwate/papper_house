<?php

namespace App\Http\Controllers;

use App\Category;
use App\Poem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }


    public function getCategories(Request $request)
    {
        $is_users = $request->is_users;
        if ($is_users == 'true') {
            if ($request->user_id) {
                $user_id = $request->user_id;
                $poems_query = Poem::whereHas('author', function (Builder $query) use ($user_id) {
                    $query->where('creator_type', 'App\User');
                    $query->where('creator_id', $user_id);
                });
            } else {
                $poems_query = Poem::whereHas('author', function (Builder $query) {
                    $query->where('creator_type', 'App\User');
                });
            }
        } else {
            $poems_query = Poem::whereHas('author', function (Builder $query) {
                $query->where('creator_type', 'App\HistoryPerson');
            });
        }
        $poems = $poems_query->get();
        $categories = Category::orderBy('title', 'ASC')->get();
        $categories = $categories->transform(function ($categoryItem) use ($poems) {
            $count_poems = $poems->whereIn('category_id', $categoryItem->id)->count();
            $categoryItem->count = $count_poems > 0 ? $count_poems : 0;
            return $categoryItem;
        });
        return response()->json($categories);
    }
}
