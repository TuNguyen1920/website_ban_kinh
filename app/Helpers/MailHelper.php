<?php

namespace App\Helpers;
use App\Http\Responses\Api;
use App\Mail\GeneralMail;
use App\Jobs\SendMailJob;
use Auth,DB;
use App\Models\Transaction;


class MailHelper
{
    /**
     * Send mail sign up
     * 
     * @param Transaction $transaction
     */
    public static function sendMail($account, $link)
    {
        $data['email'] = $account->email;
        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
                ->setView('emails.reset_password', $link)
                ->setSubject('Thay đổi mật khẩu')
                ->setTo($data['email']);
        dispatch(new SendMailJob($mailJob));
    }

}
