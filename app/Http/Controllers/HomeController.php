<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// usar clase
use Illuminate\Support\Facades\Auth;

// use App\Services\SeoService;

use App\Http\Services\ModuleService;
// use App\Http\Services\SeoService;
// use App\Http\Services\HomeService;

use App\Repository\Post\PostRepository; 


use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Message;
use App\Models\Country;
use App\Models\PostFree;
use App\Models\StatisticsSearch;
use App\Models\Forum;
use App\Models\Course;

// use App\Traits\CheckTutorial;

use App\Interfaces\TutorialInterface;

// use App\Services\CheckTutorial;


use Illuminate\Support\Facades\DB;

// use App\Http\Controllers\GuzzleHttp\Client;

// use GuzzleHttp\Client;

// class HomeController extends Controller implements TutorialInterface
class HomeController extends Controller
{


  // use CheckTutorial;

 protected $moduleService;
 // protected $seoService;
 // protected $homeService;
 protected $posts;
 protected $postsfree;
 protected $categorys;

  // protected $userService;

 public function __construct(ModuleService $moduleService, PostRepository $post, Post $posts, PostFree $postsfree, Category $categorys){

  $this->moduleService = $moduleService;
  // $this->seoService = $seoService;
  // $this->homeService = $homeService;
  $this->post = $post;

  $this->posts = $posts;
  $this->postsfree = $postsfree;
  $this->categorys = $categorys;


}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(TutorialInterface $tutorial, CheckTutorial $tuto)
    // public function index(TutorialInterface $tutorial)
    public function index()
    {


      // print_r($_SERVER['HTTP_HOST']);

      // print($_SERVER['SERVER_NAME']);

      // exit;



      $forum = Forum::select('forums.forum_name','forums.forum_tittle','forums.forum_description','forums.forum_content','forums.is_digitalp','forums.is_services','forums.is_community','forums.user_id','forums.id')
      ->where('id', 1)
      ->first();

      $website = $_SERVER['HTTP_HOST'];


        // print_r($forum);
        // exit;

      if (empty($forum)) {

       return redirect('/course/foroworkers/installatton-tutorial-step-by-step');

     }

     $user = user::select('users.id','users.api_key_factory')
     ->where('id', $forum->user_id)
     ->firstOrFail();


     


     // $ms_contents = $this->seoService->getModuleSeo($user->api_key_factory, $website, $forum->user_id, $forum->id);

      $ms_contents = $this->moduleService->responseGet('/api/modules/seo',$user->api_key_factory, $website, $forum->user_id, $forum->id);

     $m_seo = $ms_contents;

      // print_r($m_seo);

      // exit;






      // if (empty($forum) || env('APP_ENV') == 'local') {

      //   return redirect('/course/foroworkers/installatton-tutorial-step-by-step');

      // }


      // if (empty($forum)) {

      //   return redirect('/register');

      // }





     // echo __('messages.welcome');

     // $mh_contents = $this->homeService->getModuleHome($user->api_key_factory, $website, $forum->user_id, $forum->id);

      $mh_contents = $this->moduleService->responseGet('/api/modules/home',$user->api_key_factory, $website, $forum->user_id, $forum->id);

     // $m_seo = $ms_contents;

      // print_r($mh_contents);
      // no reconoce la variable
      // print_r($mh_contents->script_controller);

      // exit;



     $categorylastnegocios = $this->post->getLastPosts(1);

     $categorylastservicios =  $this->post->getLastPosts(2);   

     $categorylastcomumidad =  $this->postsfree->getLastPosts(3);


     $tablelast = array($categorylastnegocios,$categorylastservicios,$categorylastcomumidad);

        // mejorar este query  
     $category =  $this->categorys->getCategorys(1);

     $category1 =  $this->categorys->getCategorys(2);

     $category2 =  $this->categorys->getCategorys(3);

     $categorylast =  $this->posts->getOneLastPosts(1);

     $categorylastser =  $this->posts->getOneLastPosts(2);

     $categorylastcom =  $this->postsfree->getOneLastPosts(3);
     

     if (Auth::user()) {

      $id_user = Auth::user()->id;

 // $messages = Message::select('messages.message','messages.id','mp.user_id_message','u.username','p.post_name','mp.message_id')

      $replys = Message::select('messages.message','messages.id','u.username','u.img','r.reply','p.post_name','mp.user_id_message','mp.message_id','mp.user_id')
      ->join('replys as r', 'messages.id', '=', 'r.message_id')
      ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
      // ->join('users as u', 'u.id', '=', 'mp.user_id')
      ->join('posts as p', 'p.id', '=', 'mp.post_id')
      ->join('users as u', 'u.id', '=', 'r.user_id')
      // ->where('u.id', $id_user)
        // ->where('r.user_id', $id_user)
      ->where('mp.user_id_message', $id_user)
      ->orderBy('r.created_at', 'desc')
      ->get();

      // dd($replys);
      // exit;

      // $replys = Message::select('u.id as userid', 'u.username','u.img','r.reply')        
     // ->join('replys as r', 'messages.id', '=', 'r.message_id')
     // ->join('users as u', 'u.id', '=', 'r.user_id')
     // // ->join('ranks as r', 'u.rank_id', '=', 'r.id')       
     // // ->where('posts.id', $postid)
     // // ->where('r.message_id', 1)
     // ->where('r.message_id', $message_id)
     //    // ->where('u.user_id', $postid)
     // // ->where('mc.id', 8)
     //    // ->orderBy('posts.id', 'asc')
     // // ->first();
     // // ->first();
     // ->get();

      // ->orWhere('campoA','=','2')

      $replysnavbar = Message::select('r.reply')
      ->join('replys as r', 'messages.id', '=', 'r.message_id')
      ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')    
      ->join('posts as p', 'p.id', '=', 'mp.post_id')
      ->join('users as u', 'u.id', '=', 'r.user_id')   
      ->where('mp.user_id_message', $id_user)  
      // ->where('u.id', $id_user)
      ->orWhere('mp.user_id','=',$id_user)
      ->orderBy('r.created_at', 'desc')
      ->limit(4)
      ->get();

      // dd($replysnavbar);

      // exit;
      $replysall = Message::select('r.reply')
      // ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
      // ->join('users as u', 'u.id', '=', 'mp.user_id')
      // ->join('posts as p', 'p.id', '=', 'mp.post_id')
      // ->where('u.id', $id_user)
      ->join('replys as r', 'messages.id', '=', 'r.message_id')
      ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')    
      ->join('posts as p', 'p.id', '=', 'mp.post_id')
      ->join('users as u', 'u.id', '=', 'r.user_id')   
      ->where('mp.user_id_message', $id_user) 
      // ->where('messages.read', 0)
      ->orWhere('mp.user_id','=',$id_user)         
      ->get();


      $sumreplys = count($replysall);

      // dd($sumreplys);

      // exit;

      // area mensajes 


      $messagesnavbar = Message::select('messages.message')
      ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
      ->join('users as u', 'u.id', '=', 'mp.user_id')
      ->join('posts as p', 'p.id', '=', 'mp.post_id')
      ->where('u.id', $id_user)
      ->where('mp.is_ignored', 0)
      ->orderBy('messages.created_at', 'desc')
      ->limit(4)
      ->get();

      $messages = Message::select('messages.message','messages.id','mp.user_id_message','u.username','p.post_name','u.img','mp.user_id')
      ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
      ->join('users as u', 'u.id', '=', 'mp.user_id')
      ->join('posts as p', 'p.id', '=', 'mp.post_id')
      ->where('u.id', $id_user)
      ->where('mp.is_ignored', 0)
      ->orderBy('messages.created_at', 'desc')
      ->get();

     // dd($messages[0]['user_id_message']);

     // exit;


      $mmessagesall = Message::select('messages.message')
      ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
      ->join('users as u', 'u.id', '=', 'mp.user_id')
      ->join('posts as p', 'p.id', '=', 'mp.post_id')
      ->where('u.id', $id_user)
      ->where('mp.is_ignored', 0)
      ->where('messages.read', 0)         
      ->get();


      $summessages = count($mmessagesall);


       // $id_user = Auth::user()->id;

       // $messagesnavbar = Message::select('messages.message')
       // ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
       // ->join('users as u', 'u.id', '=', 'mp.user_id')
       // ->join('posts as p', 'p.id', '=', 'mp.post_id')
       // ->where('u.id', $id_user)
       // ->orderBy('messages.created_at', 'desc')
       // ->limit(4)
       // ->get();

       // $mmessages = Message::select('messages.message')
       // ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
       // ->join('users as u', 'u.id', '=', 'mp.user_id')
       // ->join('posts as p', 'p.id', '=', 'mp.post_id')
       // ->where('u.id', $id_user)
       // ->where('messages.read', 0)         
       // ->get();


       // $summessages = count($mmessages);

       // comentarios
     // $comments = Post::select('posts.post_name','posts.url_name','posts.id as postid','posts.post_content','u.id as userid', 'u.username','u.img','c.comment')
     // $replys = Message::select('u.id as userid', 'u.username','u.img','r.reply')        
     // ->join('replys as r', 'messages.id', '=', 'r.message_id')
     // ->join('users as u', 'u.id', '=', 'r.user_id')
     // // ->join('ranks as r', 'u.rank_id', '=', 'r.id')       
     // // ->where('posts.id', $postid)
     // // ->where('r.message_id', 1)
     // ->where('r.message_id', $message_id)
     //    // ->where('u.user_id', $postid)
     // // ->where('mc.id', 8)
     //    // ->orderBy('posts.id', 'asc')
     // // ->first();
     // // ->first();
     // ->get();

     // // dd($replys);

     // // exit;

     // // dd($postid);

     // $replysnavbar = Message::select('r.reply')
     // ->join('replys as r', 'messages.id', '=', 'r.message_id')
     // ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')    
     // ->join('posts as p', 'p.id', '=', 'mp.post_id')
     // ->join('users as u', 'u.id', '=', 'r.user_id')   
     // ->where('mp.user_id_message', $id_user)  
     //  // ->where('u.id', $id_user)
     // ->orWhere('mp.user_id','=',$id_user)
     // ->orderBy('r.created_at', 'desc')
     // ->limit(4)
     // ->get();

     // $replysall = Message::select('r.reply')  
     // ->join('replys as r', 'messages.id', '=', 'r.message_id')
     // ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')    
     // ->join('posts as p', 'p.id', '=', 'mp.post_id')
     // ->join('users as u', 'u.id', '=', 'r.user_id')   
     // ->where('mp.user_id_message', $id_user) 
     //  // ->where('messages.read', 0)
     // ->orWhere('mp.user_id','=',$id_user)         
     // ->get();


     // $sumreplys = count($replysall);


      return view('home', [
        'forums' =>  $forum,
        'websites' =>  $website,
        'users' =>  $user,
        'm_seos' =>  $ms_contents,
        'categorylastnegocios' =>  $categorylastnegocios,
        'categorylastservicios' =>   $categorylastservicios,              
        // 'categorys' => $array,
        'categorys' => $category,
        'categoryslast' =>  $categorylast,
        'categoryslastser' =>  $categorylastser,
        'categorys1' => $category1,
        'messagesnavbar' => $messagesnavbar,
        'summessages' => $summessages,
        'replys' => $replys,
        'replysnavbar' => $replysnavbar,
        'sumreplys' => $sumreplys,
        'categorys2' => $category2,
        'categoryslastcom' =>  $categorylastcom,
        'tablelast' =>  $tablelast 


      // 'subcategorys' => $subcategory,
      ]);

    } else {

     return view('home', [
       'forums' =>  $forum,
       'websites' =>  $website,
       'users' =>  $user,
       'm_seos' =>  $ms_contents,
       'categorylastnegocios' =>  $categorylastnegocios,
       'categorylastservicios' =>   $categorylastservicios,     
        // 'categorys' => $array,
       'categorys' => $category,
       'categoryslast' =>  $categorylast,
       'categoryslastser' =>  $categorylastser,
       'categorys1' => $category1,
       'categorys2' => $category2,
       'categoryslastcom' =>  $categorylastcom,
       'tablelast' =>  $tablelast       
      // 'subcategorys' => $subcategory,
     ]);
   }   


    //  return view('home', [
    //     // 'categorys' => $array,
    //   'categorys' => $category,
    //   'categoryslast' =>  $categorylast,
    //   'categorys1' => $category1,
    //   'messagesnavbar' => $messagesnavbar
    //   // 'subcategorys' => $subcategory,
    // ]);
 }

 public function rules()
 {

  return view('rules');

}




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function courses()
    {
     return view('courses');
   }

   public function contact()
   {
     return view('contact');
   }

   public function about()
   {
     return view('about');
   }

   public function priva()
   {
     return view('priva');
   }

   public function guestpost()
   {
     return view('guestpost');
   }

   public function mapall()
   {


    // $usermap = User::select('c.country_name, c.lat, c.long')
    // ->join('countrys as c', 'c.id', '=', 'users.country_id')           
    // ->get();

    // $usermap = User::select('*')
     // $usermap = User::select('countrys.country_name as countryname, countrys.lat as latitude, countrys.long as longitude')
     // $usermap = Country::select('countrys.country_name, countrys.latitude, countrys.longitude')
     // // ->join('countrys', 'countrys.id', '=', 'users.country_id')
     // ->join('users', 'countrys.id', '=', 'users.country_id')             
     // ->get();

    // tube que hacer join de esta manera tiene problema con latitude y longitude
     $usermap = DB::table('countrys as c')
     // ->leftJoin('users as u', 'u.country_id', '=', 'c.id')
     // ->select('u.username, c.country_name')
     // ->where('p.id', $id)        
     ->get();
     // ->first();

     // dd($usermap);

     // exit;

     return response()->json($usermap);

    // return response()->json("ok");

   }

   public function findPost(Request $request)
   {

     $findpost = Post::select('posts.post_name','posts.url_name','posts.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','t.type_name','posts.created_at','posts.updated_at','t.type_color','posts.views')    
     ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
     ->join('types as t', 't.id', '=', 'posts.type_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
     ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
     ->join('users as u', 'u.id', '=', 'up.user_id')
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      // ->where('mc.maincategory_url', $subcategory)
      // ->where('posts.post_name','like','%'.'negocio'.'%')
     ->where('posts.post_name','like','%'.$request->post.'%')      
      // ->where('u.is_buyer', 1)
     ->where('posts.site_id', 1)
      // ->orWhere('posts.site_id', 2)
     ->where('posts.publish', null)
     // ->where('mc.id', 8)
      // ->orderBy('mc.id', 'asc')
      // ->orderBy('posts.created_at', 'desc')
     ->orderBy('posts.updated_at', 'desc')
     ->limit(10)     
     // ->first();
     ->get();
      // ->paginate(10);


     $findpostfree = PostFree::select('posts_free.post_name','posts_free.url_name','posts_free.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','posts_free.created_at','posts_free.updated_at','posts_free.views')    
     ->join('maincategorys as mc', 'mc.id', '=', 'posts_free.maincategory_id')
      // ->join('types as t', 't.id', '=', 'posts.type_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
     ->join('users_posts_free as up', 'up.post_id', '=', 'posts_free.id')
      // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts_free.maincategory_id')
     ->join('users as u', 'u.id', '=', 'up.user_id')
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
     ->where('posts_free.post_name','like','%'.$request->post.'%')  
      // ->where('mc.maincategory_url', $subcategory)
       // ->where('mc.id', 41)
      // ->where('u.is_buyer', 1)
      // ->where('posts.site_id', 1)
     ->where('posts_free.publish', null)
      // asi es mejorar pero cambiaria las url amigables
       // ->where('up.maincategory_id', 42)
     // ->where('mc.id', 8)
      // ->orderBy('mc.id', 'asc')
      // ->orderBy('posts.created_at', 'desc')
     ->orderBy('posts_free.updated_at', 'desc')
     ->limit(10)       
     // ->first();
     ->get();
      // ->paginate(10);

     // return response()->json($findpost);

      // return response()->json($findpostfree);

     


     if (!empty($request->post)) {

      $search = new StatisticsSearch;

      $search->keyword = $request->post;            

      $search->save();

    }

    return response()->json(
      [
       'findpost' => $findpost,
       'findpostfree' => $findpostfree
     ]
   );

    // return response()->json("ok");

  }

  public function coursesall($coursename)
  {


    $course = Course::select('courses.id','courses.course_url','courses.course_name','pensums.pensum_name','pensums.pensum_video','pensums.id as pensum_id','courses.course_img','courses.course_icon','courses.course_body','courses.course_content')
    ->join('pensums', 'pensums.course_id', '=', 'courses.id')
    ->join('users_califications_courses', 'users_califications_courses.course_id', '=', 'courses.id')   
    ->where('courses.course_url', $coursename)    
    ->firstOrFail();

    $pensum = Course::select('courses.id','courses.course_url','courses.course_name','pensums.pensum_name','pensums.pensum_url','pensums.pensum_video','pensums.id as pensum_id','courses.course_img','courses.course_icon','courses.course_body')
    ->join('pensums', 'pensums.course_id', '=', 'courses.id')
    ->join('users_califications_courses', 'users_califications_courses.course_id', '=', 'courses.id') 
    ->where('courses.course_url', $coursename)
    ->where('courses.id', $course->id)         
    ->get();



    return view('coursesall', [
      'courses' => $course,
      'pensums' => $pensum
    ]);
  }

  public function coursespensum($coursename,$pensunname)
  {

   $course = Course::select('courses.id','courses.course_url','courses.course_name','pensums.pensum_name','pensums.pensum_video','pensums.id as pensum_id','courses.course_img','courses.course_icon','courses.course_body','pensums.pensum_kwone','pensums.pensum_kwtwo','pensums.pensum_kwthree','pensums.pensum_url','pensums.pensum_img','courses.promo_url')
   ->join('pensums', 'pensums.course_id', '=', 'courses.id')
   ->join('users_califications_courses', 'users_califications_courses.course_id', '=', 'courses.id')  
   ->where('courses.course_url', $coursename)
   ->where('pensums.pensum_url', $pensunname)        
   ->firstOrFail();

   $course_end = Course::select('courses.id','courses.course_url','courses.course_name','pensums.pensum_name','pensums.pensum_video','pensums.id as pensum_id','courses.course_img','courses.course_icon','courses.course_body','pensums.pensum_kwone','pensums.pensum_kwtwo','pensums.pensum_kwthree','pensums.pensum_url','pensums.pensum_img','courses.promo_url','pensums.created_at','pensums.id as pemsumid')
   ->join('pensums', 'pensums.course_id', '=', 'courses.id')
   ->join('users_califications_courses', 'users_califications_courses.course_id', '=', 'courses.id')  
   ->where('courses.course_url', $coursename)
   ->where('pensums.pensum_url', $pensunname)        
   ->oldest()
   ->first();

   // print_r($course_end->pemsumid);

   if ($course_end->pemsumid == 3) {

     return redirect('/register');

   }

   $pensum = Course::select('courses.id','courses.course_url','courses.course_name','pensums.pensum_name','pensums.pensum_url','pensums.pensum_video','pensums.id as pensum_id','courses.course_img','courses.course_icon','courses.course_body','pensums.course_id')
   ->join('pensums', 'pensums.course_id', '=', 'courses.id')
   ->join('users_califications_courses', 'users_califications_courses.course_id', '=', 'courses.id') 
   ->where('courses.course_url', $coursename)
   ->where('courses.id', $course->id)
   ->orderBy('pensums.updated_at', 'asc')           
   ->get();

   return view('coursespensum', [
    'courses' => $course,
    'pensums' => $pensum
  ]);

 }

 public function getTuto(TutorialInterface $tutorial)
 { 

  $tutorial->getTutorial(); 

     // $forum = Forum::select('forums.forum_name','forums.forum_tittle','forums.forum_description')
     //  ->where('id', 1)
     //  ->first();  

     //   if (empty($forum) || env('APP_ENV') == 'local') {

     //    return redirect('/course/foroworkers/post-questions-and-answers');        

     //  }


}

// public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
// public function getTutorial(TutorialInterface $request): TutorialInterfaceInterface
public function getTutorial()
{

  return exit;

}


}
