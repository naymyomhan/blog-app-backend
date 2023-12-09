<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SensitiveBookController extends Controller
{
    use ResponseTrait;
    public function getBooks(Request $request)
    {
        $query = Book::query();

        $currentDateTime = Carbon::now();

        $timestamp = $currentDateTime->timestamp;

        $totalDays = floor($timestamp / (60 * 60 * 24));


        $query->orderByRaw("RAND($totalDays)");

        $books = $query->where('sensitive', 1)->paginate(20);

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


    public function getRecommend(Request $request)
    {
        $randomNumber = rand(0, 999999);

        $books = Book::where('sensitive', 1)
        ->orderByRaw("RAND($randomNumber)")->take(10)->get();
        
        foreach ($books as $book) {
            $book->date = $book->upload_at->format('Y-m-d');
            $book->image = env('APP_URL') . "/storage/" . $book->image;

            unset($book->created_at);
            unset($book->updated_at);
            unset($book->file);
            unset($book->upload_at);
        }

        return $this->success("Book List", $books);
    }


    public function searchBook(Request $request)
    {
        if (!$request->q) {
            return $this->fail("Please provide search keyword", 400);
        }

        $books = Book::where('name', 'like', '%' . $request->q . '%')->where('sensitive', 1)->get();

        foreach ($books as $book) {
            $book->date = $book->upload_at->format('Y-m-d');
            $book->image = env('APP_URL') . "/storage/" . $book->image;

            unset($book->created_at);
            unset($book->updated_at);
            unset($book->file);
            unset($book->upload_at);
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
