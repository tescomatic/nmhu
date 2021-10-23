<?php

namespace App\Http\Livewire\Inc;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LogSign extends Component
{
    use WithFileUploads;

    public $honeyInputs,$who;
    public $email;
    public $phone;
    public $login_email;
    public $login_password;
    public $stage_name;
    public $password;
    public $url;
    public $email_verified = 0;
    public $tempImage;
    public $poll = false;
    public $avatar;
    public $captcha = 0;
    public $listeners = ['socialDetail' => 'social', 'refresh' => '$refresh'];
    public $rules = [
        'email' => "required|email|unique:users|string",
        'phone' => "required|unique:users|string",
        'stage_name' => "required|string|max:30|regex:/^[\s\w-]*$/",
        'password' => "required|string|min:6",
        'avatar' => "nullable",
        'who' => "required|string",
        'email_verified' => "nullable",
        'url' => 'required|unique:users|regex:/^[\s\w-]*$/'
    ];


public function login(){
$this->validate([
    'login_email'=>'email|required|string',
    'login_password' => 'required|string'
]);
$user=Auth::attempt(['email'=>$this->login_email,'password'=>$this->login_password]);
if (!$user) {
   return $this->emit('snack',['Invalid email or password']);
}
else{
            $this->emit('close-login', ["Close Login", ""]);
            $this->emit('snack', ["Login successful !", ""]);
            $this->emit('refresh');
            $this->reset();
}
}
    public function signup()
    {


        $this->url = Str::slug( $this->url);
        $all = $this->validate();

        $all['password'] = Hash::make($this->password);
        $img = 'avatar/' .  time() . mt_rand(1000, 9000) . '.png';
        $this->avatar ? $this->avatar = Storage::disk('s3')->put($img, file_get_contents($this->avatar), 'public'):  $img=null;



        $all['avatar']= $img;
        $all['email_verified_at'] = time();
       try {

            $user = User::create($all);

            $this->emit('snack', ["Your account has been created successfully !!!", ""]);
            session()->remove('socials');
            Auth::loginUsingId($user->id);
            $this->reset();
            $this->emit('close-login', ["Close Login", ""]);
            $this->emit('refresh');
            session()->forget('socials');
       } catch (\Exception $e) {

            $this->emit('snack', ["Something went wrong", ""]);
        }
    }
    public function social()
    {
        if (session()->has('socials')) {
            $user = session('socials');
            if (!$user['user']->email) {
                return;
            }
            $found = User::where('email', $user['user']->email)->first();
            if ($found) {
                Auth::loginUsingId($found->id);
                $this->emit('close-login', ["CLose Login", ""]);
                $this->emit('snack', ["Login successful !!", ""]);
                $this->emit('refresh');
                $this->poll = false;
                session()->remove('socials');
                return;
            } else {
                $this->email = $user['user']->email;
                $this->phone = "";
                $this->stage_name = $user['user']->nickname ?? $user['user']->name;
                $this->url = str_replace(' ', '_', $this->stage_name);
                $this->avatar =  $user['user']->avatar_original;
                $this->email_verified = 1;
                $this->poll = false;
            }

            //dd ($user['user']->given_name);

        }
    }

    public function render()
    {
        return view('livewire.inc.log-sign');
    }
    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . env('RECAPTCHA_SECRET_KEY') . '&response=' . $token);
        $this->captcha = $response->json()['score'];

        if ($this->captcha < .3) {
            return session()->flash('error', 'Google thinks you are a bot, please refresh and try again');

        }
    }
}
