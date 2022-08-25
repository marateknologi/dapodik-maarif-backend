<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Validator;
// use Log;


class BookController extends Controller
{
    // default books::get()
    public function index()
    {
        $books = Book::all();
        $BookResources = BookResource::collection($books);
        return $this->sendResponse($BookResources, "Successful Get Books");
    }

    // book::post($value)
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            // following what payload does
            'name' => "required|min:4|max:255",
            'price' => "required",
            'description' => "required|min:10|max:255"

        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Uncompleted", $validator->errors());
        }

        $book = Book::create($input);
        // Log::info($input);
        return $this->sendResponse(new BookResource($book), "Book Created Successful");
    }

    public function show($id){
        $book = Book::find($id);
        return $this->sendResponse(new BookResource($book), "Book Get Successful");
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required|min:4|max:255",
            'price' => "required",
            'description' => "required|min:10|max:255"

        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Uncompleted", $validator->errors());
        }

        $book = Book::find($id);

        $book->name = $input['name'];
        $book->price = $input['price'];
        $book->description = $input['description'];
        $book->save();
        return $this->sendResponse(new BookResource($book), "Book Update Successful");
    }

    public function destroy($id){
        $book = Book::find($id);
        $book->delete();
        return $this->sendResponse([], "Book Deleted Successful");
    }
}
