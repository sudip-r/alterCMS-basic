<?php

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

/**
 * Get list of months
 *
 * @return array
 */
function getMonths()
{
    return [
        1 => "Jan",
        2 => "Feb",
        3 => "Mar",
        4 => "Apr",
        5 => "May",
        6 => "Jun",
        7 => "Jul",
        8 => "Aug",
        9 => "Sep",
        10 => "Oct",
        11 => "Nov",
        12 => "Dec",
    ];
}

/**
 * Get list of days
 *
 * @return array
 */
function getDays()
{
    $days = [];

    for ($day = 1; $day <= 32; $day++) {
        $days[$day] = $day;
    }

    return $days;
}

/**
 * Upload image
 *
 * @param $request
 * @return string
 */
function uploadImage($request, $imageName, $path)
{
    $image = $request->file($imageName);
    $imageName = rand(1, 999999) . time() . '.' . $image->getClientOriginalExtension();

    $destinationPath = public_path($path);
    $image->move($destinationPath, $imageName);

    return $imageName;
}

/**
 * Get authentication guard
 *
 * @return String
 */
function getGuard()
{
    if (Auth::guard('web')->check()) {
        return "web";
    } elseif (Auth::guard('business')->check()) {
        return "business";
    } elseif (Auth::guard('client')->check()) {
        return "client";
    }
}

/**
 * Redirect users according to guard
 *
 * @param $guard
 * @return Illuminate\Support\Facades\Redirect
 */
function redirectToGuard($guard)
{
    switch ($guard) {
        case 'web':
            return redirect()->intended('alter-admin');
        case 'business':
            return redirect()->intended('business');
        case 'client':
            return redirect()->intended('client');
    }
}

/**
 * Image path filter for custom file uploads
 *
 * @param $str
 * @return String
 */
function mpath($str)
{
    if(isUrl($str))
      return $str;

    if (env('APP_ENV') == 'local') {
        return asset($str);
    }

    return env('IMG_URL', asset('')) . '/' . $str;
}

/**
 * Check if string is a url
 * 
 * @param $str
 * @return Boolean
 */
function isUrl($str)
{
  if (filter_var($str, FILTER_VALIDATE_URL)) {
    return true;
  } 
  return false;
}
