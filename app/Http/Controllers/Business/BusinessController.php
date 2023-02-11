<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use App\AlterBase\Repositories\Category\CategoryRepository;
use App\AlterBase\Repositories\User\UserRepository;
use App\AlterBase\Repositories\User\ProfileRepository;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BusinessController extends Controller
{
  /**
   * CategoryRepository $category
   */
  private $category;
  /**
   * UserRepository $user
   */
  private $user;
  /**
   * ProfileRepository $profile
   */
  private $profile;
  /**
   * DatabaseManager $db
   */
  private $db;
  /**
   * LoggerInterface $log
   */
  private $log;

  /**
   * CategoryRepository $category
   */
  public function __construct(
    CategoryRepository $category,
    UserRepository $user,
    ProfileRepository $profile,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
    $this->category = $category;
    $this->user = $user;
    $this->profile = $profile;
    $this->db = $db;
    $this->log = $log;
  }
  /**
   * Show all category
   *
   * @return View
   */
  public function index()
  {
    return view('business.dashboard');
  }

  /**
   * Profile update page
   * 
   * @return View
   */
  public function profile()
  {
    $user = Auth::guard('business')->user();

    $profile = $user->profile();

    if ($profile == null) {
      try {
        $this->db->beginTransaction();

        $input = [
          'user_id' => $user->id,
          'business_name' => $user->name,
          'cover_image' => 'default.jpg'
        ];

        $profile = $this->profile->store($input);

        $this->db->commit();

       
      } catch (\Exception $e) {
        $this->log->error((string) $e);
        $this->db->rollBack();
  
        return redirect()->route('business::dashboard')
          ->with('error', "Sorry, something went wrong!");
      }
    }

    $categories = $this->category->getWithCondition(['publish' => 1], 'category', 'asc')->pluck('category', 'id');

    return view('business.pages.profile')
      ->with('user', $user)
      ->with('profile', $profile)
      ->with('categories', $categories);
  }

  /**
   * Update user information
   * 
   * @param $request
   * @return redirect
   */
  public function updateInformation(Request $request)
  {
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'business_name',
        'business_address',
        'contact',
        'mobile',
        'map'
      ]);

      $input['categories'] = $request->categories != null ? json_encode($request->categories) : null;

      $userId = Auth::guard('business')->user()->id;

      $this->profile->updateWith('user_id', $userId, $input);

      $this->db->commit();

      return redirect()->route('business::profile')
        ->with('success', "Updated successfully!");
    } catch (\Exception $e) {
      $this->log->error((string) $e);
      $this->db->rollBack();

      return redirect()->route('business::profile')
        ->with('success', "Sorry, something went wrong!");
    }
  }

  /**
   * Update user images
   * 
   * @param $request
   * @return redirect
   */
  public function updateImages(Request $request)
  {
    $user = Auth::guard('business')->user();

    $profile = $user->profile();
    try {
      $this->db->beginTransaction();
      if ($request->hasFile('profile_image')) {
        $userData['profile_image'] = $this->uploadImage($request, 'profile_image', 'images/business/', $user->profile_image);

        $this->user->update($user->id, $userData);
      }

      if ($request->hasFile('cover_image')) {
        $profileData['cover_image'] = $this->uploadImage($request, 'cover_image', 'images/business/cover/', $profile->cover_image, 1200, 400);

        $this->profile->update($profile->id, $profileData);
      }

      $this->db->commit();

      return redirect()->route('business::profile')
        ->with('success', "Updated successfully!");
    } catch (\Exception $e) {
      $this->log->error((string) $e);
      $this->db->rollBack();

      return redirect()->route('business::profile')
        ->with('success', "Sorry, something went wrong!");
    }
  }

  /**
   * Update user descriptions
   * 
   * @param $request
   * @return redirect
   */
  public function updateDescription(Request $request)
  {
    try {
      $this->db->beginTransaction();

      $input = $request->only([
        'summary',
        'description'
      ]);

      $userId = Auth::guard('business')->user()->id;

      $this->profile->updateWith('user_id', $userId, $input);

      $this->db->commit();

      return redirect()->route('business::profile')
        ->with('success', "Updated successfully!");
    } catch (\Exception $e) {
      $this->log->error((string) $e);
      $this->db->rollBack();

      return redirect()->route('business::profile')
        ->with('success', "Sorry, something went wrong!");
    }
  }

  /**
   * Upload image
   *
   * @param $request
   * @return string
   */
  private function uploadImage($request, $filename, $path, $oldFilename, $width = 240, $height = 240)
  {
    $image = $request->file($filename);

    $filename = time() . '.' . $image->getClientOriginalExtension();

    Image::make($image)
      ->fit($width, $height, function ($constraint) {
        $constraint->aspectRatio();
      })
      ->save($path . '/' . $filename);

    if (file_exists(public_path($path . $oldFilename)) && strpos($oldFilename, 'default') === false)
      unlink(public_path($path . $oldFilename));

    return $filename;
  }
}
