<?php

namespace App\Models;

use App\Notifications\VerifyEmail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail as Email;

class Subscription extends Model implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = ['email', 'email_verified_at'];

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }

    /**
     * Determine if the user's email has been verified.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Mark the email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the email verification notification.
     *
     * This method is typically triggered automatically by Laravel
     * during the user registration process.
     */
   public function  sendEmailVerificationNotification(){
     $this->notify(new Email);
   }
}
