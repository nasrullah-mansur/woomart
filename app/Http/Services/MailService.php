<?php

namespace App\Http\Services;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailService
{
    protected $defaultEmail;
    protected $defaultName;

    public function __construct()
    {
        $default = $data['adm_setting'] = allsettings();
        $this->defaultEmail = 'contact@noziae.be';
        $this->defaultName = allSettings()['app_title'];
    }

    public function send($template, $data = [], $to = '', $name = '', $subject = '')
    {
        try {
            Mail::send($template, $data, function ($message) use ($name, $to, $subject) {
                $message->to($to, $name)->subject($subject)->replyTo(
                    $this->defaultEmail, $this->defaultName
                );
                $message->from($this->defaultEmail, $this->defaultName);

            });
            return true;
        }catch (\Exception $e){
//          dd($e->getMessage());
// Session::flash('dismiss', 'Unavailable email service!');
        }
    }

}
