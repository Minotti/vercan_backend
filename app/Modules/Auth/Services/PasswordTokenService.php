<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\PasswordResetTokens;

class PasswordTokenService
{
    public function __construct(private PasswordResetTokens $model)
    {}

    /**
     * Create a new token.
     *
     * @param string $email
     * @return PasswordResetTokens
     */
    public function create(string $email): PasswordResetTokens
    {
        // delete all token for given email
        $this->delete($email);

        // generate new token
        $hash = $this->generateToken($email);
        return PasswordResetTokens::create([
            'email' => $email,
            'token' => $hash,
            'created_at' => now()
        ]);
    }

    /**
     * Returns a token by given email.
     *
     * @param string $email
     * @return PasswordResetTokens|null
     */
    public function find(string $email): ?PasswordResetTokens
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Returns a token by given token.
     *
     * @param string $token
     * @return PasswordResetTokens|null
     */
    public function findByToken(string $token): ?PasswordResetTokens
    {
        return $this->model->where('token', $token)->first();
    }

    /**
     * Verify if the given token is expired.
     *
    * @param PasswordResetTokens $token
    * @return bool
    */
    public function isExpired(PasswordResetTokens $token): bool
    {
        $now = now();
        $tokenDate = $token->created_at;
        $diff = $now->diffInMinutes($tokenDate);

        return $diff > env('MAIL_TOKEN_EXPIRATION_IN_MINUTES', 30);
    }

    /**
     * Delete a token by given email.
     *
     * @param string $email
     */
    public function delete(string $email): void
    {
        $this->model->where('email', $email)->delete();
    }

    /**
     * Generate a token.
     * @param string $email
     *
     * @return string
     */
    private function generateToken(string $email): string
    {
        return md5($email . time());
    }
}
