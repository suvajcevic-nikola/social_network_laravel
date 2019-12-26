<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;   // ukljucuje se model
use Auth; // klasa za logovanog korisnika
use App\User;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        //var_dump($posts);
        $user = Auth::user();
        $events = Event::get();
        $following = $user->following; // following je metoda iako se pise kao polje, moze i following()->get()
        $followers = $user->followers;

        // odredjujemo zajednicke i posebne prijatelje, mutual, folowing, followers, others
        $following_id = $user->following->pluck('id')->toArray(); // id svih korisnika koje pratim
        $followers_id = $user->followers->pluck('id')->toArray(); // id onih koje ja pratim
        $mutual_id = array_intersect($following_id, $followers_id); // pravi presek, id uzazjamnih prijatelja

        $following_id = array_diff($following_id, $mutual_id);
        $followers_id = array_diff($followers_id, $mutual_id);

        $mutuals = User::whereIn('id', $mutual_id)->orderBy('name')->get();
        $followers = User::whereIn('id', $followers_id)->orderBy('name')->get();
        $following = User::whereIn('id', $following_id)->orderBy('name')->get();

        $others = User::whereNotIn('id', array_merge($mutual_id, $followers_id, $following_id, array($user->id)))->orderBy('name')->get();


        return view('home', array(
            'posts' => $posts,
            'following'=>$following,
            'followers'=>$followers,
            'mutuals'=>$mutuals,
            'others' =>$others,
            'events'=>$events
        ));
    }

    public function publish()
    {
        $content = request('content');
        // echo Auth::user();
        $id = Auth::user()->id;

        if (empty($content))
        {
            return redirect('\home')->with('error' , 'Post is empty');
        }
        else
        {
            // ubaciti novi red u tabelu posts
            // - kreirati novi objekat klase posts
            // - popunimo polja ovom objektu
            // pozvati metodu save()

            $post = new Post;
            $post->user_id = $id;
            $post->content = $content;
            $post->save();

            // redirekacija na homepage
            return redirect('\home')->with('success' , 'Post published!');

        }

    }
}
