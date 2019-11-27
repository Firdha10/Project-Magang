<?php

namespace App\Http\Controllers;
use App\Tema;

use Illuminate\Http\Request;

class TemaController extends Controller
{
    private $title = "Tema";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $items = Tema::get();
        $title = $this->title;

        return view('tema.index', compact('items','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title;
        return view('tema.create', compact('title'));
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
            'tema' => 'required'
        ]);

        $item = Tema::insert([
            'tema' => $request->tema
        ]);

        if($item) {
            return response()->json();
        } else {
            return redirect()->route('tema.index')->with('error', 'Gagal Menambah Tema');
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
        $item = Tema::where('id', $id)->first();

        return view('tema.edit', compact('item'));
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
        $request->validate([
            'tema' => 'required'
            ]);

            $item = Tema::where('id', $id)->update([
                'tema' => $request->tema
                ]);

                if($item) {
                    return response()->json();
                } else {
                    return response()->json();
            // return redirect()->route('tema.index')->with('error', 'Gagal Mengubah Tema');
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
        $item = Tema::where('id', $id)->delete();

        if($item) {
            return response()->json();
        } else {
            return response()->json();
        }
    }
}
