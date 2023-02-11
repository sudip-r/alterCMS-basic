<?php

namespace App\Mail;

use App\AlterBase\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class UserVerificationToken
 * @package App\Mail
 */
class UserVerificationToken extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $user;
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $subject;

    /**
     * @var
     */
    public $from;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $subject
     * @param $from
     * @param $name
     */
    public function __construct(User $user,$subject = null,$from = null,$name = null)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->from = $from;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (! empty($this->from)) {
            $this->from($this->from, $this->name);
        }

        $this->subject(is_null($this->subject)
            ? trans('user.verification_email_subject')
            : $this->subject);

        return $this->view('cms.users.verification');
    }
}
