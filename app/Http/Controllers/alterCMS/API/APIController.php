<?php

namespace App\Http\Controllers\alterCMS\API;

use App\AlterBase\Repositories\User\UserSettingRepository;
use App\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

/**
 * Class UserController
 * @package App\Http\Controllers\CMS
 */
class APIController extends Controller
{
    /**
     * @var UserSettingRepository
     */
    private $setting;
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
     * @param UserSettingRepository $user
     * @param LoggerInterface $log
     * @param DatabaseManager $db
     */
    public function __construct(
        UserSettingRepository $setting,
        LoggerInterface $log,
        DatabaseManager $db) {
        $this->setting = $setting;
        $this->log = $log;
        $this->db = $db;
    }

    /**
     * Toggle dark mode
     * 
     * @param $request
     * @return Response
     */
    public function toggleDarkMode(Request $request)
    {
        try {
            $this->db->beginTransaction();

            $input = $request->only([
                'dark_mode'
            ]);

            $id = auth()->user()->setting->id;

            $this->setting->update($id, $input);

            $this->db->commit();

            return response(['message' => 'success']);

        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);

            return response(['message' => 'failed', 'error' => $e->getMessage()]);
        }
    }

}
