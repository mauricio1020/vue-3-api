<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return BookResource::collection(
            Book::filter(request()->only("search", "status"))
               ->orderByDesc("id")
               ->paginate(5)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookRequest $bookRequest
     * @return JsonResponse
     */
    public function store(BookRequest $bookRequest)
    {
        $book = Book::create($bookRequest->input());
        return response()->json([
            "cssClass" => "bg-green-500",
            "show" => true,
            "message" => "El libro {$book->name} ha sido creado correctamente"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return BookResource
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(BookRequest $bookRequest, int $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($bookRequest->input())->save();
        return response()->json([
            "cssClass" => "bg-green-500",
            "show" => true,
            "message" => "El libro {$book->name} ha sido actualizado correctamente"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $book = Book::find($id);
        if($book) {
            $book->delete();
            return response()->json([
                "cssClass" => "bg-orange-500",
                "show" => true,
                "message" => "El libro {$book->name} ha sido eliminado correctamente"
            ]);
        }
        return response()->json([
            "cssClass" => "bg-red-500",
            "show" => true,
            "message" => "No se ha encontrado el libro"
        ], 404);
    }
}
