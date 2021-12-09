<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;


class SongsController extends Controller
{
    //
    public function index(Request $request){

        $search = '';
        if($request->has('search')){
            $search = $request->query('search');
        }
        $songs = Song::
                where('artist_id', '!=' , auth()->id())
                ->where('song_name', 'like', '%'.$request->query('search').'%')
                ->with('artist')
                ->orderBy('id','DESC')
                ->paginate(3);
                 
        //dd($songs);
        return view('songs.otherartist',[
            'songs' => $songs,
            'search'=> $search
        ]);
    }

    public function mysongs(Request $request){
        $search = '';
        if($request->has('search')){
            $search = $request->query('search');
        }
        $songs = Song::
                where('artist_id', auth()->id())
                ->where('song_name', 'like', '%'.$request->query('search').'%')
                ->with('artist')
                ->orderBy('id','DESC')
                ->paginate(3);
        //$songs = Song::where(['artist_id'=>auth()->id()])->orderBy('id','DESC')->paginate(3)->toArray();
        
        return view('songs.index',[
            'songs' => $songs,
            'search'=> $search
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
            'artist_id' => auth()->id(),
            'tags' => !empty($request->tags) ? implode(',',$request->tags) : 'songs, poems'
        ]);

        return redirect()->route('my.songs')
                ->withSuccess(__('Song added successfully.'));
    }

    public function edit(Song $song, $id)
    {   
        $song = Song::find($id);
        $song['tags'] = explode(',',$song['tags']);
        
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

        Song::where('id', $request->id)
        ->update([
            'song_name' => $request->song_name,
            'song_lyrics' => $request->song_lyrics,
            'song_description' => $request->song_description,
            'artist_id' => auth()->id(),
            'tags' => !empty($request->tags) ? implode(',',$request->tags) : 'songs, poems'
        ]);

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
