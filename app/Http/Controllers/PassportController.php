<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passport;
use Image;
use Storage;
class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $passports = Passport::all();
        return view('passports.index',compact('passports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('passports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      // if($request->hasfile('filename'))
      //    {
      //       $file = $request->file('filename');
      //       $name=time().$file->getClientOriginalName();
      //       $file->move(public_path().'/images/', $name);
      //    }
      //validation
      // $this->validate($request,array(
      //   'filename' => 'required | image'
      //
      // ));

        $passport= new Passport();
        $passport->name=$request->get('name');
        $passport->email=$request->get('email');
        $passport->number=$request->get('number');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $passport->date = strtotime($format);
        $passport->office=$request->get('office');

        if($request->hasFile('filename')){
          $image = $request->file(('filename'));
          $file_name_id = time(). ' .' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $file_name_id);
          Image::make($image)->resize(200,200)->save($location);

          //set default value filename for db
          $passport-> filename = $file_name_id;
        }

        // $passport->filename=$name;


        $passport->save();

        //redirect
        return redirect('passports')->with('success', 'Information has been added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $passport = Passport::find($id);
        return view('passports.edit',compact('passport','id'));
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
        //
         $passport= Passport::find($id);




         $passport->name=$request->get('name');
         $passport->email=$request->get('email');
         $passport->number=$request->get('number');
         $date=date_create($request->get('date'));
         $format = date_format($date,"Y-m-d");
         $passport->date = strtotime($format);
         $passport->office=$request->get('office');

         //photo updating
         if($request->hasFile('filename')){
           //add new pic
           $image = $request->file(('filename'));
           $file_name_id = time(). ' .' . $image->getClientOriginalExtension();
           $location = public_path('images/' . $file_name_id);
           Image::make($image)->resize(200,200)->save($location);

           $oldFilename = $passport->image;

           //update new image
           //file_name_id is a database field name u assign
           //file name is the actual database field
           $passport-> filename = $file_name_id;

           //selete old image
           Storage::delete($oldFilename);

         }

         $passport->save();
         return redirect('passports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $passport = Passport::find($id);
        $passport->delete();
        return redirect('passports')->with('success','Information deleted successfuly');
    }
}
