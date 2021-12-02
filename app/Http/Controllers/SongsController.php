<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongsController extends Controller
{
    //
    public function index(){
        $songs = Song::where('artist_id', '!=' , auth()->id())->with('artist')->orderBy('id','DESC')->paginate(3)->toArray();        
        return view('songs.otherartist',[
            'songs' => $songs
        ]);
    }

    public function mysongs(){
        $songs = Song::where(['artist_id'=>auth()->id()])->orderBy('id','DESC')->paginate(3)->toArray();
        
        return view('songs.index',[
            'songs' => $songs
        ]);
    }

    public function add(){
        return view('songs.add');
    }

    public function store(Request $request){
        $this->validate($request,[
            'song_name' => 'required',
            'song_lyrics' => 'required',
            'song_description' => 'required'
        ]);

        Song::create([
            'song_name' => $request->song_name,
            'song_lyrics' => $request->song_lyrics,
            'song_description' => $request->song_description,
            'artist_id' => auth()->id()
        ]);

        return redirect()->route('my.songs')
                ->withSuccess(__('Song added successfully.'));
    }

    public function edit(Song $song, $id)
    {   
        $song = Song::find($id);
        return view('songs.edit',[
            'song' => $song
        ]);
    }

    public function view($id)
    {   
        $song = Song::where('id',$id)->with('artist')->first()->toArray();
        //echo '<pre>'; print_r($song); exit;
        return view('songs.view',[
            'song' => $song
        ]);
    }

    public function update(Request $request, $id = 0)
    {
        $this->validate($request,[
            'song_name' => 'required',
            'song_lyrics' => 'required',
            'song_description' => 'required'
        ]);

        $Song = Song::findOrNew($id);
        $Song->fill($request->all());
        $Song->save();

        return redirect()->route('my.songs')
                ->withSuccess(__('Song edited successfully.'));
    }

    public function destroy(Song $song, $id)
    {   
        $song = Song::find($id);
        if ($song) {
            if($song->delete()){
                return redirect()->route('my.songs')
                ->withSuccess(__('Song delete successfully.'));
            }
        }
    }
}
