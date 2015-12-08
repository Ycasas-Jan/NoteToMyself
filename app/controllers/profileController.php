<?php

class profileController extends \BaseController
{

    public function index()
    {
        if (Auth::check()) {
            Session::regenerate();

            $notesTable = Notes::select('notes')->where('email',Auth::user()->email)->first()->toArray();
            $notes = $notesTable["notes"];

            $tbdTable = TBD::select('tbd')->where('email',Auth::user()->email)->first()->toArray();
            $tbd = $tbdTable["tbd"];

            $linksTable = Links::select('links')->where('email',Auth::user()->email)->get()->toArray();
            $linksArray = array();
            foreach ($linksTable as $link) {
                array_push($linksArray,$link["links"]);
            }

            $imagesTable = Image::select('image')->where('email',Auth::user()->email)->get()->toArray();
            $imageArray = array();
            foreach ($imagesTable as $image) {
                array_push($imageArray,$image["image"]);
            }
            $profile = array(
                "notes" => $notes,
                "tbd" => $tbd,
                "links" => $linksArray,
                "image" => $imageArray,
                "email" => Auth::user()->email
            );
            return View::make('profile')->with('profile',$profile);
        } else {
            echo "NOT LOGGED IN!<br />";
            return Redirect::to('/');
        }
    }


    public function store()
    {
        Notes::where('email', Auth::user()->email)
            ->update(array('notes' => Input::get('notes')));

        TBD::where('email', Auth::user()->email)
            ->update(array('tbd' => Input::get('tbd')));

        $input = Input::all();
        for($i = 0; $i < count($input); $i++){
            if (!(Links::where('links', '=', Input::get("link$i"))->exists())){
                if(Input::get("link$i") != "")
                    Links::insert(array(
                        'email' => Auth::user()->email,
                        'links' => Input::get("link$i")
                    ));
            }
        }

        if (Input::hasFile('photo')) {
            $count = Image::where('email',Auth::user()->email)->count();
            if($count >= 4){
                echo "USER CAN ONLY HAVE 4 PHOTOS MAX";
                return Redirect::back();
            }
            $extension = Input::file('photo')->getClientOriginalExtension();
            if($extension == "gif" || $extension == "jpeg"){
                Image::insert(array(
                    'email' => Auth::user()->email,
                    'image' => file_get_contents(Input::file('photo'))
                ));
            } else {
                echo "CAN ONLY DO GIF OR JPEG";
            }
        }

        $imageCount = Image::where('email',Auth::user()->email)->count();
        for($i = 0; $i < $imageCount - 1; $i++){
            if(Input::get("delete$i") != null){
                $imageTable = Image::where('email',Auth::user()->email)->get();
                //echo $imageTable[$i+1]["id"];
                Image::where('id',$imageTable[$i]["id"])->delete();
            }

        }


        return Redirect::to('profile');
    }

    public function show()
    {
        echo "LOGGING OUT";
        Auth::logout();
        return Redirect::to('/');
    }

}
