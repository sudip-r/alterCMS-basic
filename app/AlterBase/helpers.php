<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

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
    12 => "Dec"
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
  switch($guard)
  {
    case 'web': 
      return redirect()->intended('alter-admin');
    case 'business': 
      return redirect()->intended('business');
    case 'client': 
      return redirect()->intended('client');
  }
}
