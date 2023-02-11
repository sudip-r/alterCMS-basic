<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
  /**
   * Show all category
   *
   * @return View
   */
  public function index()
  {
    echo "Hello Client User";
  }
}
