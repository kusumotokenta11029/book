<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        // dd($books);
        $categories = Category::all();

        return view('index', compact('books', 'categories'));

    }
    public function store(BookRequest $request)
    {
        $book = $request->only(['category_id', 'content']);
        Book::create($book);

        return redirect('/')->with('message','本を追加しました。');
    }

    public function update(BookRequest $request)
    {
        $book = $request->only(['title']);
        Book::find($request->id)->update($book);

        return redirect('/')->with('message', '本を更新しました');
    }

    public function destroy(Request $request)
    {
        Book::find($request->id)->delete();
        return redirect('/')->with('message', '本を削除しました');
    }
}
