<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

use Mail;
use App\Mail\WelcomeEmail;


use Illuminate\Support\Facades\DB;

use Session;

use App\Models\Country;
use App\Models\Forum;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {    

      $numberone = rand(1,100);
      $numbertwo = rand(1,100);

      $totalsum = $numberone + $numbertwo;

      Session::put('totalsum', $totalsum);


      return view('auth.register', [
        'numberone' => $numberone,
        'numbertwo' => $numbertwo
      ]);

    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {



      $request->validate([
        // 'username' => ['required', 'string', 'min:10', 'max:30', 'unique:'.User::class],
        'email' => ['required', 'string', 'email', 'min:8', 'max:35', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'password' => ['required','min:8', 'max:35'],
        'totalsum' => ['required'],
        'terms' => ['required'],
      ]);



      $user_email = $request->email;

      $username_start = substr($user_email, 0, 2);

      $username_final = 'user'.rand(1,100).$username_start;



      $emaillower = strtolower($request->email);

      $random_token = password_hash($request->email.rand(10,100),PASSWORD_BCRYPT);

      $ip_user = $_SERVER['REMOTE_ADDR'];

      $ip_country = Country::select('id')            
        // ->whereBetween('ip_min', [$ageFrom, $ageTo])
      ->whereBetween('ip_max', ['0', $ip_user])            
      ->first();




      $total1 = Session::get('totalsum');



      if ($total1 == $request->totalsum) {

        $adminuser = User::select('username')   
        ->where('role_id', 1) 
        ->first();

        if (empty($adminuser)) {

         $user = User::create([
          'img' => 'admin.png',
          'banner' => 'userbanner.png',        
          'username' => 'AdminForoworkers',       
          'email' => $emaillower,
          'email_verified_at' => now(),         
          'password' => Hash::make($request->password),
          'token' =>  $random_token,
          'role_id' => 1,
          'country_id' => 7, 
          'statu_id' => 1,
          'is_buyer' => 1,
          'theme_color' => 'white',
          'theme_color' => 'gray',
          'rank_id' => 1,
          'membership_start' => null,
          'membership_end' => null,
          'remember_token' => Str::random(10),
          'terms' => 1,
          'is_verified' => 1,       
          'is_banned' => 0,
          'reason_id' => 1,
          'url_profile' => 'https://www.upwork.com/freelancers/~016c272f36ca6d79ee',
          'url_patreon' => 'https://www.patreon.com/c/foroworkers',
          'ip_adress' => $_SERVER['REMOTE_ADDR'],
        ]);

         $reply = new Forum;
         $reply->forum_name = 'Foroworkers';
         $reply->forum_tittle = 'Foro de SEO, WebMasters en Español';
         $reply->forum_description = 'Foro de SEO en Español, Webmasters, Negocios, Emprendedores, Compra y Venta de Servicios Online, Ofertas, Promociones en foroworkers.com';
         $reply->user_id =  $user->id;             
         $reply->save();        

         event(new Registered($user));

         Auth::login($user);


         return redirect(RouteServiceProvider::HOME);

       }


       if (empty($ip_country)) {


        $user = User::create([
          'img' => 'user.png',
          'banner' => 'userbanner.png',
        // 'username' => $request->username,
          // 'username' => $usernamelower,
          'username' => $username_final,
        // 'email' => $request->email,
          'email' => $emaillower,
          'email_verified_at' => now(),         
          'password' => Hash::make($request->password),
          'token' =>  $random_token,
          'role_id' => 2,
          'country_id' => 1, 
          'statu_id' => 0,
          'is_buyer' => 0,
        // 'theme_color' => 'white',
          'theme_color' => 'gray',
          'rank_id' => 1,
          'membership_start' => null,
          'membership_end' => null,
          'remember_token' => Str::random(10),
          'terms' => 1,
          'is_verified' => 0,
        // 'is_ignored' => 0,
          'is_banned' => 0,
          'reason_id' => 1,
          'url_profile' => null,
          'url_patreon' => null,
          'ip_adress' => $_SERVER['REMOTE_ADDR'],
        ]);

      }else{

        $user = User::create([
          'img' => 'user.png',
          'banner' => 'userbanner.png',
        // 'username' => $request->username,
          // 'username' => $usernamelower,
          'username' => $username_final,
        // 'email' => $request->email,
          'email' => $emaillower,
          'email_verified_at' => now(),         
          'password' => Hash::make($request->password),
          'token' =>  $random_token,
          'role_id' => 2,
          'country_id' => $ip_country->id, 
          'statu_id' => 0,
          'is_buyer' => 0,
        // 'theme_color' => 'white',
          'theme_color' => 'gray',
          'rank_id' => 1,
          'membership_start' => null,
          'membership_end' => null,
          'remember_token' => Str::random(10),
          'terms' => 1,
          'is_verified' => 0,
        // 'is_ignored' => 0,
          'is_banned' => 0,
          'reason_id' => 1,
          'url_profile' => null,
          'url_patreon' => null,
          'ip_adress' => $_SERVER['REMOTE_ADDR'],
        ]);


      }

      



      event(new Registered($user));

      Auth::login($user);




      $mailData = [
        'title' => 'Verificar Email',
        'body' => 'Necesitamos asegurarnos de que seas humano. Verifique su correo electrónico y comience a utilizar su cuenta del sitio web.',
        'token' =>  $random_token
      ];



      Mail::to($request->email)->send(new WelcomeEmail($mailData));


      return redirect(RouteServiceProvider::HOME);

    }else{


     return back()->with('msg_exception', 'Realice la suma para verificar que no es un Robot!!');
   }


 }


 public function activation()
 {



  if (!empty($_GET['token']) && isset($_GET['token'])) {

    $token = $_GET['token'];

    $useremail = User::select('email')    
    ->where('token', $token)    
    ->first();


    $readmessages = DB::table('users')
    ->where('email', $useremail->email)
    ->update([
      'statu_id' => 1,
      'is_verified' => 1
    ]);
    

    return view('auth.msg_activation');




  }else{
    throw new \Exception('Page not Found');

  }


}
}
