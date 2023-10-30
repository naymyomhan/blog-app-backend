<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    use ResponseTrait;
    public function getBooks(Request $request)
    {
        $query = Book::query();

        if ($request->has('order_by')) {
            $orderParameter = $request->input('order_by');
            if ($orderParameter == 'view') {
                $query->orderBy('read_count', 'desc');
            }
        } else {
            $query->orderBy('id', 'desc');
        }

        $books = $query->paginate(20);

        foreach ($books as $book) {
            $book->date = $book->upload_at->format('Y-m-d');
            $book->image = env('APP_URL') . "/storage/" . $book->image;

            unset($book->created_at);
            unset($book->updated_at);
            unset($book->file);
            unset($book->upload_at);
        }

        return $this->success("Book List", [
            'current_page' => $books->currentPage(),
            'last_page' => $books->lastPage(),
            'per_page' => $books->perPage(),
            'data' => $books->items(),
        ]);
    }

    public function searchBook()
    {
        $books = Book::all();

        foreach ($books as $book) {
            $book->image = env('APP_URL') . "/storage/" . $book->image;
            unset($book->created_at);
            unset($book->updated_at);
            unset($book->file);
            unset($book->upload_at);
            unset($book->previous_id);
            unset($book->next_id);
        }

        return $this->success("Search result", $books);
    }

    public function getBookDetail($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->fail("Book not found", 404);
        }

        $book->date = $book->upload_at->format('Y-m-d');
        $book->image = env('APP_URL') . "/storage/" . $book->image;
        $book->file = env('APP_URL') . "/storage/" . $book->file;

        unset($book->created_at);
        unset($book->updated_at);
        unset($book->upload_at);

        $book->increment("read_count");

        return $this->success("Book Detail", $book);
    }
}