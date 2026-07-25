<?php

namespace App\Services;

use App\Models\User;
use App\Models\ApiSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OtpDispatcherService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Dispatch OTP through all active, user-selected channels.
     */
    public function dispatchOtp(User $user, string $otp): array
    {
        // 1. Fetch all globally active gateways from the new table
        // Keyed by api_type for easy lookup (e.g., ['telegram' => ApiSetting Model, ...])
        $activeGateways = ApiSetting::where('is_active', true)
            ->get()
            ->keyBy('api_type');

        $dispatchedChannels = [];

        // 2. Route to Telegram
        if ($activeGateways->has('telegram') && $user->two_factor_telegram && $user->chat_id_telegram) {
            $this->sendTelegram($activeGateways->get('telegram'), $user->chat_id_telegram, $otp);
            $dispatchedChannels[] = 'Telegram';
        }

        // 3. Route to Viber
        if ($activeGateways->has('viber') && $user->two_factor_viber && $user->chat_id_viber) {
            $this->sendViber($activeGateways->get('viber'), $user->chat_id_viber, $otp);
            $dispatchedChannels[] = 'Viber';
        }

        // 4. Route to SMS
        if ($activeGateways->has('sms') && $user->two_factor_sms && $user->phone_number) {
            $this->sendSms($activeGateways->get('sms'), $user->phone_number, $otp);
            $dispatchedChannels[] = 'SMS';
        }

        // 5. Emergency Fallback (If no channels matched, find the fallback gateway)
        if (empty($dispatchedChannels) && $user->email) {
            $fallbackGateway = ApiSetting::where('is_fallback', true)->first();

            if ($fallbackGateway) {
                // Assuming email is the fallback mechanism
                $this->sendEmail($fallbackGateway, $user->email, $otp);
                $dispatchedChannels[] = 'Email (Fallback)';
            }
        }

        return $dispatchedChannels;
    }

    /**
     * Handle the Telegram API Request & Telemetry
     */
    protected function sendTelegram(ApiSetting $gateway, string $chatId, string $otp): void
    {
        // The api_key is automatically decrypted by the Model cast
        $botToken = $gateway->api_key;

        // Use the base_url from the DB, or default to standard Telegram API
        $baseUrl = rtrim($gateway->base_url ?? 'https://api.telegram.org', '/');

        try {
            $response = Http::timeout(5)->post("{$baseUrl}/bot{$botToken}/sendMessage", [
                'chat_id'    => $chatId,
                'text'       => "🔐 <b>Your Pawnshop 2FA Code</b>\n\nYour code is: <code>{$otp}</code>\n\nValid for 5 minutes.",
                'parse_mode' => 'HTML',
            ]);

            if ($response->successful()) {
                $this->updateTelemetry($gateway, 'success');
            } else {
                // E.g., User blocked the bot, or token is invalid
                $errorDetails = $response->json('description') ?? 'Unknown API Error';
                $this->updateTelemetry($gateway, 'failed', "HTTP {$response->status()}: {$errorDetails}");
            }

        } catch (\Exception $e) {
            // Catches timeouts or network failures
            $this->updateTelemetry($gateway, 'failed', $e->getMessage());
            Log::error("Telegram Dispatch Failed: " . $e->getMessage());
        }
    }

    protected function sendViber(ApiSetting $gateway, string $viberId, string $otp): void
    {
        // Implement using $gateway->api_key / $gateway->config_payload
    }

    protected function sendSms(ApiSetting $gateway, string $phoneNumber, string $otp): void
    {
        // Implement using $gateway->api_key / $gateway->config_payload
    }

    protected function sendEmail(ApiSetting $gateway, string $email, string $otp): void
    {
        // Implement fallback email logic
    }

    /**
     * Helper to update gateway health status seamlessly.
     */
    protected function updateTelemetry(ApiSetting $gateway, string $status, string $errorMessage = null): void
    {
        $gateway->update([
            'last_used_at'       => now(),
            'last_status'        => $status,
            'last_error_message' => $errorMessage,
        ]);
    }

}
