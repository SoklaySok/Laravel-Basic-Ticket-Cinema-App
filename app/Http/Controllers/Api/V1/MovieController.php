<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Get all movies.
     */
    public function index(Request $request)
    {
        $movies = Movie::query()
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where(
                        'title',
                        'ILIKE',
                        "%{$search}%"
                    );
                }
            )
            ->when(
                $request->status,
                function ($query, $status) {
                    $query->where('status', $status);
                }
            )
            ->latest()
            ->paginate(10);

        return MovieResource::collection($movies);
    }

    /**
     * Get one movie.
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    /**
     * Create movie.
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Movie created successfully',
            'data' => new MovieResource($movie),
        ], 201);
    }

    /**
     * Update movie.
     */
    public function update(
        UpdateMovieRequest $request,
        Movie $movie
    ) {
        $movie->update(
            $request->validated()
        );

        return response()->json([
            'message' => 'Movie updated successfully',
            'data' => new MovieResource($movie),
        ]);
    }

    /**
     * Delete movie.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json([
            'message' => 'Movie deleted successfully',
        ]);
    }

    public function restore(int $id)
    {
        $movie = Movie::withTrashed()->findOrFail($id);

        $movie->restore();

        return response()->json([
            'message' => 'Movie restored successfully',
            'data' => new MovieResource($movie),
        ]);
    }
}