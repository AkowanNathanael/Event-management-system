<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Podcast;
use App\Models\Post;
use App\Models\Quiz;
use App\Models\Resource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function events(){
        $events = Event::paginate(15); // Removed `all()`
        return view('user.events.index', ["events" => $events]);
    }
    public function showevent(Event $event){
           return view("user.events.show",["event"=>$event]);
    }
    public function podcasts(){
        $podcasts = Podcast::paginate(15); // Removed `all()`
        return view('user.podcasts.index', ["podcasts" => $podcasts]);
    }
    public function showpodcast(Podcast $podcast){
        return view("user.podcasts.show",["podcast"=>$podcast]);
    }
    public function posts(){
        $posts = Post::paginate(5); // Removed `all()`
        return view('user.posts.index', ["posts" => $posts]);
    }

    public function showpost(Post $post){
        return view("user.posts.show",["post"=>$post]);
    }
    public function resources(){
        $resources = Resource::paginate(15); // Removed `all()`
        return view('user.resources.index', ["resources" => $resources]);
    }
    public function showresource(Resource $resource){
        return view("user.resources.show",["resource"=>$resource]);
    }
    public function profile(){
        return view('user.profile.profile');
    }
    public function quizzes(){
        $quizzes = Quiz::paginate(15); // Removed `all()`
        return view('user.quiz.index', ["quizzes" => $quizzes]);       
    }
    public function showquiz(Quiz $quiz){
            $quiz=Quiz::all();
        return view('user.quiz.index',["quiz"=>$quiz]);
    }
    public function showquestions(Quiz $quiz){
        return view("user.question.show",['quiz'=>$quiz]);
    }
}

