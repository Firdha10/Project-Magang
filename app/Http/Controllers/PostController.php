<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tema;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $title = 'Post';
    public function index()
    {
        $items = Post::get();
        $temas = Tema::get();
        $title = $this->title;

        return view('post.index', compact('items', 'temas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temas = Tema::get();
        $title = $this->title;
        return view('post.create', compact('temas', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required',
            'foto'  => 'required|mimes:png,jpg,jpeg|max:2048',
            'tema_id' => 'required'
        ]);

        $file = $request->file('foto');
        $get_name = $file->getClientOriginalName();
        $file->move(public_path('post/'), $get_name);

        $item = Post::insert([
            'judul' => $request->judul,
            'isi'   => $request->isi,
            'foto'  => $get_name,
            'tema_id' => $request->tema_id
        ]);

        if($item){
            return response()->json();
        } else {
            return redirect()->route('post.index')->with('error','Gagal Menambah Post');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Post::where('id', $id)->first();
        return view('post.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $file = $request->file('foto');
        // $get_name = $file->getClientOriginalName();
        // $file->move(public_path('post/'), $get_name);

        $item = Post::where('id', $id)->update([
            'judul' => $request->judul,
            'isi'   => $request->isi,
            'tema_id' => $request->tema_id
        ]);

        if($item){
            return response()->json();
        } else {
            return response()->json();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Post::where('id', $id)->delete();

        if($item){
            return response()->json();
        } else {
            return response()->json();
        }
    }

    public function getBlogById($id) {
        return response()->json([Post::where('id', $id)->get()]);
    }
}
