<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function BookPage()
    {
        return view('pages.books-page');
    }

    public function BookDetails()
    {
        return view('pages.bookdetails-page');
    }

    public function BookList()
    {
        try
        {
            $book = Book::with(['category', 'subcategory'])->get();
            return ResponseHelper::Out('success', $book, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('failed', $exception->getMessage(), 401);
        }
    }

    public function CreateBook(Request $request)
    {
        try
        {
            $user_id = $request->header('id');

            $img = $request->file('img');
            $time = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$time}-{$file_name}";
            $img_url = "uploads/{$img_name}";

            $img->move(public_path('uploads'), $img_name);


            // Validate the request data
            $validatedData = $request->validate([
                'title'         => 'required|string|max:255',
                'author'        => 'required|string|max:255',
                'publisher'     => 'nullable|string|max:255',
                'description'   => 'nullable|string',
                'image'         => 'nullable|string|max:255',
                'quantity'      => 'required|integer',
                'category_id'   => 'required|exists:categories,id',
                'subcategory_id'=> 'required|exists:subcategories,id',
            ]);

            // Create the book
            $book = Book::create([
                'title'         => $validatedData['title'],
                'author'        => $validatedData['author'],
                'publisher'     => $validatedData['publisher'],
                'description'   => $validatedData['description'],
                'image'         => $img_url,
                'quantity'      => $validatedData['quantity'],
                'category_id'   => $validatedData['category_id'],
                'subcategory_id'=> $validatedData['subcategory_id'],
            ]);

            return ResponseHelper::Out('Book created successfully', $book, 200);
        }
        catch (Exception $exception)
        {
            return ResponseHelper::Out('Book creation failed', $exception->getMessage(), 401);
        }
    }

    public function BookById(Request $request)
    {
        try
        {
            $book_id = $request->id;
            $book = Book::with(['category', 'subcategory'])->findOrFail($book_id);
            return ResponseHelper::Out('Success', $book, 200);
        }
        catch (Exception $exception)
        {
            return ResponseHelper::Out('Failed', $exception->getMessage(), 401);
        }
    }

    public function UpdateBook(Request $request)
    {
        try
        {
            $user_id = $request->header('id');

            // Validate the request data
            $validatedData = $request->validate([
                'title'         => 'required|string|max:255',
                'author'        => 'required|string|max:255',
                'publisher'     => 'nullable|string|max:255',
                'description'   => 'nullable|string',
                'image'         => 'nullable|string|max:255',
                'quantity'      => 'required|integer',
                'category_id'   => 'required|exists:categories,id',
                'subcategory_id'=> 'required|exists:subcategories,id',
            ]);

            // Find the book by ID
            $book_id    = $request->id;
            $book       = Book::findOrFail($book_id);

            $updateData = [
                'title'         => $validatedData['title'],
                'author'        => $validatedData['author'],
                'publisher'     => $validatedData['publisher'],
                'description'   => $validatedData['description'],
                'quantity'      => $validatedData['quantity'],
                'category_id'   => $validatedData['category_id'],
                'subcategory_id'=> $validatedData['subcategory_id'],
            ];

            if ($request->hasFile('img')) {
                $img        = $request->file('img');
                $time       = time();
                $file_name  = $img->getClientOriginalName();
                $img_name   = "{$user_id}-{$time}-{$file_name}";
                $img_url    = "uploads/{$img_name}";
                $img->move(public_path('uploads'), $img_name);

                // Delete the old image file if it exists
                if ($book->image) {
                    File::delete(public_path($book->image));
                }

                $updateData['image'] = $img_url;
            }

            // Update the book with the validated data
            $book->update($updateData);

            return ResponseHelper::Out('Book updated successfully', $book, 200);
        }
        catch (Exception $exception)
        {
            return ResponseHelper::Out('Book update failed', $exception->getMessage(), 401);
        }
    }

    public function DeleteBook(Request $request)
    {
        try
        {
            $book_id = $request->id;
            $file_path = $request->image;

            File::delete($file_path);
            $book = Book::findOrFail($book_id);
            $book->delete();

            return ResponseHelper::Out('Book deleted successfully',$book, 200);
        }
        catch (Exception $exception)
        {
            return ResponseHelper::Out('Book deletion failed', $exception->getMessage(), 401);
        }
    }

    public function QuantityUpdate(Request $request)
    {
        try
        {
            $updateQuantity = $request->quantity;
            $bookId         = $request->book_id;

            $book = Book::findOrFail($bookId);

            $book->update(['quantity'=> $updateQuantity]);

            return ResponseHelper::Out('success', $book, 200);
        }
        catch(Exception $exception)
        {
            return ResponseHelper::Out('fail', $exception->getMessage(), 401);
        }
    }

    public function Search(Request $request)
    {
        $query = $request->searchWord;

        $books = Book::where('title', 'like', "%{$query}%")
                    ->orWhere('author', 'like', "%{$query}%")
                    ->orWhere('publisher', 'like', "%{$query}%")
                    ->with(['category', 'subcategory'])
                    ->get();

        return response()->json($books);
    }
}
