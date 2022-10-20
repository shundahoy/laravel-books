<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $books = Book::search($input)->orderBy('id', 'desc')->paginate(10);
        $publications = Book::select('publication')->groupBy('publication')->pluck('publication');
        $authors = Book::select('author')->groupBy('author')->pluck('author');

        return view(
            'book.index',
            [
                'books' => $books,
                // selectboxの値
                'publications' => $publications,
                'authors' => $authors,

                // 検索する値
                'name' => $input['name'] ?? '',
                'publication' => $input['publication'] ?? '',
                'author' => $input['author'] ?? '',
                'status' => $input['status'] ?? '',
                'note' => $input['note'] ?? '',
            ]
        );
    }

    public function detail($id)
    {
        // $books = Book::all();
        $book = Book::find($id);
        return view('book.detail', ['book' => $book]);
    }

    public function edit($id)
    {
        // $books = Book::all();
        $book = Book::find($id);
        return view('book.edit', ['book' => $book]);
    }

    public function update(BookRequest $request)
    {
        try {
            DB::beginTransaction();
            $book = Book::find($request->input('id'));
            $book->name = $request->input('name');
            $book->status = $request->input('status');
            $book->author = $request->input('author');
            $book->publication = $request->input('publication');
            $book->reade_at = $request->input('reade_at');
            $book->note = $request->input('note');
            $book->save();
            DB::commit();
            return redirect('book')->with('status', '本を更新しました。');
        } catch (\Exception $ex) {
            DB::rollback();
            logger($ex->getMessage());
            return redirect('book')->withErrors($ex->getMessage());
        }
    }
    public function new()
    {
        return view('book.new');
    }
    public function create(Request $request)
    {
        try {
            $book = Book::create($request->all());
            return redirect('book')->with('status', '本を作成しました');
        } catch (\Exception $ex) {
            DB::rollback();
            logger($ex->getMessage());
            return redirect('book')->withErrors($ex->getMessage());
        }
    }

    public function remove($id)
    {
        try {
            $book = Book::find($id)->delete();
            return redirect('book')->with('status', '本を消去');
        } catch (\Exception $ex) {
            DB::rollback();
            logger($ex->getMessage());
            return redirect('book')->withErrors($ex->getMessage());
        }
    }
}
