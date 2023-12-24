<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SongController extends Controller
{
    use ResponseTrait;
    //Upload Songs

    //Get Songs
    public function getSongs(Request $request)
    {
        $query = Song::query();
        $query->orderBy('id', 'desc');

        $songs = $query->paginate(20);

        foreach ($songs as $song) {
            $song->date = $song->created_at->format('Y-m-d');
            $song->lyrics_image = env('APP_URL') . "/storage/" . $song->lyrics_image;

            unset($song->created_at);
            unset($song->updated_at);
            unset($song->lyrics_image);
        }

        return $this->success("Get Song List Successful", [
            'current_page' => $songs->currentPage(),
            'last_page' => $songs->lastPage(),
            'per_page' => $songs->perPage(),
            'data' => $songs->items(),
        ]);
    }


    //Recommdend Songs

    //Get Artists

    public function getArtists(Request $request)
    {
        $query = Artist::query();
        $query->orderBy('id', 'desc');

        $artists = $query->get();

        return $this->success("Get artists successful", $artists);
    }
}
