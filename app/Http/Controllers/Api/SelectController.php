<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\SelectFilter;
use App\Http\Resources\SelectResource;
use App\Models\Admin;
use App\Models\Book;
use App\Models\Category;
use App\Models\Reference;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function categories(SelectFilter $filter)
    {
        $categories = Category::filter($filter)->paginate();

        return SelectResource::collection($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function references(SelectFilter $filter)
    {
        $references = Reference::filter($filter)->paginate();

        return SelectResource::collection($references);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function users(SelectFilter $filter)
    {
        $users = Admin::filter($filter)->paginate();

        return SelectResource::collection($users);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function books(SelectFilter $filter)
    {
        $books = Book::filter($filter)->paginate();

        return SelectResource::collection($books);
    }
}
