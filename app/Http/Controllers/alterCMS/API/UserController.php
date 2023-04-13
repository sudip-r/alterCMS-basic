<?php

namespace App\Http\Controllers\alterCMS\API;

use App\AlterBase\Repositories\User\UserRepository;
use App\AlterBase\Repositories\Setting\MessageRepository;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

/**
 * Class UserController
 * @package App\Http\Controllers\CMS
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * MessageRepository $message
     */
    private $message;
    /**
     * @var LoggerInterface
     */
    private $log;
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * UserController constructor.
     * @param UserRepository $user
     * @param MessageRepository $message
     * @param LoggerInterface $log
     * @param DatabaseManager $db
     */
    public function __construct(
        UserRepository $user,
        MessageRepository $message,
        LoggerInterface $log,
        DatabaseManager $db) {
        $this->user = $user;
        $this->message = $message;
        $this->log = $log;
        $this->db = $db;
    }

    /**
     * Get message with user
     * 
     * @param $request
     * @return Response
     */
    public function getMessage(Request $request)
    {
        $myId = $request->_myId;
        $userId = $request->_userId;
        $page = $request->page ?? "1";

        $messages = $this->message->getMessageThread($myId, $userId);

        return response(['message' => $messages, 'page' => $page]);
    }

}
