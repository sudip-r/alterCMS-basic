<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use App\AlterBase\Repositories\User\UserRepository;
use App\AlterBase\Repositories\User\ProfileRepository;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BusinessController extends Controller
{

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
   *
   */
  public function __construct(
    UserRepository $user,
    ProfileRepository $profile,
    DatabaseManager $db,
    LoggerInterface $log
  ) {
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

}
