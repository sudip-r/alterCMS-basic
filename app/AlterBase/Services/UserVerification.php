<?php

namespace App\AlterBase\Services;


use App\AlterBase\Models\User\User;
use App\Mail\UserVerificationToken;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Str;

/**
 * Class UserVerification
 * @package App\AlterBase\Services
 */
class UserVerification
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var UserVerificationToken
     */
    private $emailVerificationToken;
    /**
     * @var User
     */
    private $user;

    /**
     * UserVerification constructor.
     * @param Mailer $mailer
     * @param UserVerificationToken $emailVerificationToken
     * @param User $user
     */
    public function __construct(Mailer $mailer, UserVerificationToken $emailVerificationToken,User $user)
    {
        $this->mailer = $mailer;
        $this->emailVerificationToken = $emailVerificationToken;
        $this->user = $user;
    }

    /**
     * Send user verification email
     *
     * @param User $user
     * @param null $subject
     * @param null $from
     * @param null $name
     * @return mixed
     */
    public function sendVerificationEmail(User $user, $subject = null, $from =null, $name= null)
    {
        $this->saveToken($user,$this->generateToken());

        return $this->emailVerificationToken($user,$subject,$from,$name);
    }

    /**
     * Save verification token
     *
     * @param $user
     * @param $token
     * @return mixed
     */
    private function saveToken($user, $token)
    {
        $user->verification_token = $token;
        $user->verified = false;

        return $user->save();
    }

    /**
     * Generate token
     *
     * @return string
     */
    private function generateToken()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

    /**
     * Verify token
     *
     * @param $email
     * @param $token
     * @return mixed
     */
    public function verifyToken($email, $token)
    {
        $user = $this->findUserByEmail($email);

        return $this->verifyUser($user,$token);

    }

    /**
     * Find user by user email
     *
     * @param $email
     * @return Object
     * @throws \Exception
     */
    private function findUserByEmail($email)
    {
        $user = $this->user->where('email',$email)->first();

        if($user == null){
            throw new \Exception("User not found.");
        }

        return $user;
    }

    /**
     * Verify the user with verification token
     *
     * @param $user
     * @param $token
     * @return mixed
     * @throws \Exception
     */
    private function verifyUser($user, $token)
    {
        if($user->verified){
            throw new \Exception("User is already verified.");
        }

        if($user->verification_token != $token){
            throw new \Exception("Verification token mismatch");
        }

        $user->verified = true;

        return $user->save();
    }

    /**
     * Send verification token to given user
     *
     * @param $user
     * @param $subject
     * @param $from
     * @param $name
     * @return mixed
     */
    private function emailVerificationToken($user, $subject, $from, $name)
    {
        return $this->mailer
            ->to($user->email)
            ->send(new UserVerificationToken($user, $subject, $from, $name));
    }

}
