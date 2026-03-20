<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// usar clase
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Message;
use App\Models\Country;
use App\Models\PostFree;
use App\Models\StatisticsSearch;




use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     //  $categorylastnegocios = Post::select('posts.post_name','posts.url_name','mc.maincategory_name','u.id', 'u.username','posts.updated_at')    
     //  ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
     // // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
     //  ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
     //  ->join('users as u', 'u.id', '=', 'up.user_id')
     // // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
     // // ->where('mc.subcategory_id', 1)
     // // ->orderBy('mc.id', 'desc')
     // // ->orderBy('mc.id', 'asc')
     // // ->orderBy('posts.created_at', 'desc')
     //  ->orderBy('posts.updated_at', 'desc')   
     // // ->first();
     //  ->limit(10)
     //  ->get();

      $categorylastnegocios = Post::select('posts.post_name','posts.url_name','posts.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','t.type_name','posts.created_at','posts.updated_at','t.type_color')    
      ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
      ->join('types as t', 't.id', '=', 'posts.type_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
      ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
      ->join('users as u', 'u.id', '=', 'up.user_id')
      ->where('mc.subcategory_id', 1)
      ->where('posts.publish', null)
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      // ->where('mc.maincategory_url', 1)
      // ->where('u.is_buyer', 1)
      // ->where('posts.site_id', 1)
     // ->where('mc.id', 8)
      // ->orderBy('mc.id', 'asc')
      // ->orderBy('posts.created_at', 'desc')
      ->orderBy('posts.updated_at', 'desc')     
     // ->first();
      // ->get()
      // ->paginate(10);
      ->limit(5)
      ->get();

      // dd($categorylastnegocios);
      // exit;

      $categorylastservicios = Post::select('posts.post_name','posts.url_name','posts.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','t.type_name','posts.created_at','posts.updated_at','t.type_color')    
      ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
      ->join('types as t', 't.id', '=', 'posts.type_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
      ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
      ->join('users as u', 'u.id', '=', 'up.user_id')
      ->where('mc.subcategory_id', 2)
      ->where('posts.publish', null)
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      // ->where('mc.maincategory_url', 1)
      // ->where('u.is_buyer', 1)
      // ->where('posts.site_id', 1)
     // ->where('mc.id', 8)
      // ->orderBy('mc.id', 'asc')
      // ->orderBy('posts.created_at', 'desc')
      ->orderBy('posts.updated_at', 'desc')     
     // ->first();
      // ->get()
      // ->paginate(10);
      ->limit(5)
      ->get();


      $categorylastcomumidad = PostFree::select('posts_free.post_name','posts_free.url_name','posts_free.id as postid','mc.maincategory_name','mc.subcategory_id','u.id as userid', 'u.username','u.img','mc.id','mc.maincategory_url','posts_free.created_at','posts_free.updated_at','cont.content_name','cont.content_color')    
      ->join('maincategorys as mc', 'mc.id', '=', 'posts_free.maincategory_id')
      ->join('contents as cont', 'cont.id', '=', 'posts_free.content_id')
      // ->join('types as t', 't.id', '=', 'posts.type_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
      ->join('users_posts_free as up', 'up.post_id', '=', 'posts_free.id')
      ->join('users as u', 'u.id', '=', 'up.user_id')
      ->where('mc.subcategory_id', 3)
      ->where('posts_free.publish', null)
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      // ->where('mc.maincategory_url', 1)
      // ->where('u.is_buyer', 1)
      // ->where('posts.site_id', 1)
     // ->where('mc.id', 8)
      // ->orderBy('mc.id', 'asc')
      // ->orderBy('posts.created_at', 'desc')
      ->orderBy('posts_free.updated_at', 'desc')     
     // ->first();
      // ->get()
      // ->paginate(10);
      ->limit(5)
      ->get();

      // $tablelast = array_merge((array)$categorylastnegocios,(array)$categorylastservicios,(array)$categorylastcomumidad);

      $tablelast = array($categorylastnegocios,$categorylastservicios,$categorylastcomumidad );

      // dd($tablelast);
      // exit;







      // $id_user = Auth::user()->id;

      // $messagesnavbar = Message::select('messages.message')
      // ->join('messages_posts as mp', 'mp.message_id', '=', 'messages.id')
      // ->join('users as u', 'u.id', '=', 'mp.user_id')
      // ->join('posts as p', 'p.id', '=', 'mp.post_id')
      // ->where('u.id', $id_user)
      // ->orderBy('messages.created_at', 'desc')
      // ->limit(4)
      // ->get();

      //  $category = Category::select('*')
      // // ->join('users as u', 'u.id', '=', 'payments.memberId')
      // // ->where('payments.memberId', $userData->id)
      // ->get();

      // mejorar este query
      $category = Category::select('categorys.category_name','sc.subcategory_name','mc.maincategory_icon','mc.maincategory_name','mc.maincategory_url')
      ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
      ->join('maincategorys as mc', 'mc.subcategory_id', '=', 'sc.id')
      ->where('mc.subcategory_id', 1)
      ->get();
      // ->paginate(10);



     // $category = Category::select('categorys.category_name','sc.subcategory_name','mc.maincategory_name','mc.maincategory_url')
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys as mc', 'mc.subcategory_id', '=', 'sc.id')
     // ->join('users_posts as up', 'up.post_id', '=', 'mc.id')
     // ->join('users as u', 'u.id', '=', 'up.user_id')
     // ->where('mc.subcategory_id', 1)
     // ->get();


     //  dd($category);

     // exit;


     // falta mejorar son categorias el last
      $categorylast = Post::select('posts.post_name','posts.url_name','mc.maincategory_name','u.id', 'u.username','posts.updated_at','posts.id as postid','mc.id as maincategory_id')    
      ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
      ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
      ->join('users as u', 'u.id', '=', 'up.user_id')
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      ->where('mc.subcategory_id', 1)
      ->where('posts.publish', null)
     // ->orderBy('mc.id', 'desc')
     // ->orderBy('mc.id', 'asc')
     // ->orderBy('posts.created_at', 'desc')
      ->orderBy('posts.updated_at', 'desc')   
      ->first();
     // ->get();

      // falta mejorar son categorias el last
      $categorylastser = Post::select('posts.post_name','posts.url_name','mc.maincategory_name','u.id', 'u.username','posts.updated_at','posts.id as postid','mc.id as maincategory_id')    
      ->join('maincategorys as mc', 'mc.id', '=', 'posts.maincategory_id')
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
      ->join('users_posts as up', 'up.post_id', '=', 'posts.id')
      ->join('users as u', 'u.id', '=', 'up.user_id')
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      ->where('mc.subcategory_id', 2)
      ->where('posts.publish', null)
     // ->orderBy('mc.id', 'desc')
     // ->orderBy('mc.id', 'asc')
     // ->orderBy('posts.created_at', 'desc')
      ->orderBy('posts.updated_at', 'desc')   
      ->first();
     // ->get();


     //  dd($categorylast);

     // exit;

      $category1 = Category::select('categorys.category_name','sc.subcategory_name','mc.maincategory_name','mc.maincategory_url','mc.maincategory_icon')
      ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
      ->join('maincategorys as mc', 'mc.subcategory_id', '=', 'sc.id')
      ->where('mc.subcategory_id', 2)
      ->get();
      // ->paginate(10);


       // print_r($category);

     // dd($categorylast);

     // exit;

      // para la parte de conversar
      $category2 = Category::select('categorys.category_name','sc.subcategory_name','mc.maincategory_name','mc.maincategory_url','mc.maincategory_icon')
      ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
      ->join('maincategorys as mc', 'mc.subcategory_id', '=', 'sc.id')
      ->where('mc.subcategory_id', 3)
      ->get();
      // ->paginate(10);

      // falta mejorar son categorias el last
      $categorylastcom = PostFree::select('posts_free.post_name','posts_free.url_name','mc.maincategory_name','u.id', 'u.username','posts_free.updated_at','posts_free.id as postid','mc.id as maincategory_id','sc.subcategory_url','mc.maincategory_url')       
      ->join('maincategorys as mc', 'mc.id', '=', 'posts_free.maincategory_id')
      ->join('subcategorys as sc', 'sc.id', '=', 'mc.subcategory_id')   
     // ->join('users_posts as up', 'up.maincategory_id', '=', 'posts.maincategory_id')
      ->join('users_posts_free as up', 'up.post_id', '=', 'posts_free.id')
      ->join('users as u', 'u.id', '=', 'up.user_id')
     // ->join('subcategorys as sc', 'sc.category_id', '=', 'categorys.id')
     // ->join('maincategorys', 'mc.subcategory_id', '=', 'sc.id')
      ->where('mc.subcategory_id', 3)
      ->where('posts_free.publish', null)
     // ->orderBy('mc.id', 'desc')
     // ->orderBy('mc.id', 'asc')
     // ->orderBy('posts.created_at', 'desc')
      ->orderBy('posts_free.updated_at', 'desc')   
      ->first();

      // dd($categorylastcom);
      // exit;




     // merge collecion en array
     // $array = array_merge($category->toArray(), $categorylast->toArray());


     // dd($array);

     // exit;

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

 
  }
