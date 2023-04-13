<?php

namespace App\Http\Controllers\alterCMS\Setting;

use App\AlterBase\Repositories\Setting\MessageRepository;
use App\AlterBase\Repositories\Setting\NoticeRepository;
use App\AlterBase\Repositories\User\UserRepository;
use App\AlterBase\Repositories\User\UserSettingRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSettingRequest;
use Illuminate\Database\DatabaseManager;
use Intervention\Image\Facades\Image;
use Psr\Log\LoggerInterface;

/**
 * Class UserController
 * @package App\Http\Controllers\CMS
 */
class SettingController extends Controller
{
    /**
     * @var UserSettingRepository
     */
    private $userSetting;
    /**
     * UserRepository $user
     */
    private $user;
    /**
     * @var MessageRepository
     */
    private $message;
    /**
     * @var NoticeRepository
     */
    private $notice;
    /**
     * @var LoggerInterface
     */
    private $log;
    /**
     * @var RoleRepository
     */
    private $role;
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * UserController constructor.
     * @param UserSettingRepository $userSetting
     * @param UserRepository $user,
     * @param MessageRepository $message
     * @param NoticeRepository $notice
     * @param LoggerInterface $log
     * @param DatabaseManager $db
     */
    public function __construct(
        UserSettingRepository $userSetting,
        UserRepository $user,
        MessageRepository $message,
        NoticeRepository $notice,
        LoggerInterface $log,
        DatabaseManager $db) {
        $this->userSetting = $userSetting;
        $this->user = $user;
        $this->message = $message;
        $this->notice = $notice;
        $this->log = $log;
        $this->db = $db;
    }

    /**
     * Get user settings page
     *
     * @return \Illuminate\View\View
     */
    public function setting()
    {
        $user = auth()->user();

        $setting = $this->userSetting->findBy('user_id', $user->id);

        return view('cms.setting.setting')
            ->with('setting', $setting)
            ->with('user', $user);
    }

    /**
     * Update user setting
     *
     * @param $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateSetting(UserSettingRequest $request, $id)
    {
        $user = auth()->user();

        try {
            $this->db->beginTransaction();

            $input = $request->only([
                'name',
            ]);

            if ($request->hasFile('profile_image')) {
                $input['profile_image'] = $this->uploadImage($request);

                $this->deleteOldProfileImage($user->profile_image);
            }

            if ($request->password) {
                $input['password'] = $request->password;
            }

            $this->user->update($user->id, $input);

            $settings['dark_mode'] = false;
            if ($request->dark_mode) {
                $settings['dark_mode'] = true;
            }
            $this->userSetting->update($id, $settings);

            $this->db->commit();

            return redirect()->route('cms::profile.setting')
                ->with('success', 'User settings updated successfully.');

        } catch (\Exception $e) {
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::profile.setting')
                ->with('error', 'Filed to update user setting.')
                ->withInput();
        }
    }

    /**
     * Get user messages
     *
     * @return \Illuminate\View\View
     */
    public function messages()
    {
        $user = auth()->user();

        $users = $this->user->getAllAdmin();

        $lastMessage = $this->message->findBy('user_id', $user->id);

        $lastSender = null;

        if ($lastMessage != null) {
            $lastSender = $lastMessage->message_from;
            if($lastMessage->message_from == $user->id)
                $lastSender = $lastMessage->message_to;
        }

        $latestThread = null;

        if ($lastSender != null) {
            $latestThread = $this->message->getMessageThread($user->id, $lastSender);
        }

        return view('cms.setting.message')
            ->with('user', $user)
            ->with('users', $users)
            ->with('lastMessage', $lastMessage)
            ->with('lastSender', $lastSender)
            ->with('latestThread', $latestThread);
    }

    /**
     * Upload image
     *
     * @param $request
     * @return string
     */
    private function uploadImage($request)
    {
        $image = $request->file('profile_image');
        $filename = rand(1, 1000000) . time() . '.' . $image->getClientOriginalExtension();

        $width = 256;
        $height = 256;

        $destinationPath = public_path('uploads/users/');

        $image->move($destinationPath, $filename);

        $filePath = $destinationPath . $filename;

        Image::make($filePath)
            ->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })
            ->save($destinationPath . $filename);

        return $filename;
    }

    /**
     * Delete old image
     *
     * @param $image
     * @return Boolean
     */
    private function deleteOldProfileImage($image)
    {
        $path = public_path('uploads/users/');

        if (file_exists($path . $image)) {
            unlink($path . $image);
        } else {
            return false;
        }
        return true;
    }

}
