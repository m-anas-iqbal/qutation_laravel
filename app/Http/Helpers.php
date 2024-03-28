<?php

use App\Setting;

function my_asset($path, $secure = null)
{
    return app('url')->asset('public/' . $path, $secure);
}

function postStatus($status)
{
    switch ($status) {
    case 1:
        $txt = '<span class="badge badge-success">Active</span>';
        break;
    default:
        $txt = '<span class="badge badge-warning">Inactive</span>';
        break;
    }

    return $txt;
}

function applicantStatus($status)
{
    switch ($status) {
    case 1:
        $txt = '<span class="badge badge-warning">Pending</span>';
        break;
    case 2:
        $txt = '<span class="badge badge-warning">Seen</span>';
        break;
    case 3:
        $txt = '<span class="badge badge-success">Approved</span>';
        break;
    case 4:
        $txt = '<span class="badge badge-danger">Rejected</span>';
        break;
    }

    return $txt;
}

function sendEmailNotification($array)
{
    if (!in_array($array['type'], array('apply_now'))) {
        $emails = $array['email'];
    } else {
        $users = \App\User::select('email')->where('is_get_email', 1)->get();
        foreach ($users as $user) {
            $emails[] = $user->email;
        }
    }

    try {
        \Illuminate\Support\Facades\Mail::to($emails)->send(new \App\Mail\EmailsManager($array));
    } catch (\Exception $e) {
        dd($e);
    }
}

function setting(){
    return Setting::first();
}