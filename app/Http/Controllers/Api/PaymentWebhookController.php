<?php

namespace App\Http\Controllers\Api;

use App\Enum\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Orders;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Event;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Webhook;

class PaymentWebhookController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function webhookAction(Request $request)
    {
        $webhookSecret = config('app.stripe_webhook_secret_key');
        $signature = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = Webhook::constructEvent($request->getContent(), $signature, $webhookSecret);
        } catch (UnexpectedValueException $e) {
            return response()->json([], 400);
        } catch (SignatureVerificationException $e) {
            return response()->json([], 400);
        }

        /** @var Session $session */
        $session = $event->data->object;
        $orderId = $session->metadata->offsetGet('order_id');
        if ($orderId === null) {
            return response()->json([], 400);
        }
        $order = Orders::find($orderId);
        if ($order === null) {
            return response()->json([], 400);
        }

        switch ($event->type) {
            case Event::CHECKOUT_SESSION_COMPLETED:
                if ($session->payment_status == Session::PAYMENT_STATUS_PAID) {
                    $this->updateOrderStatus($order, OrderStatusEnum::PAID);
                    $this->sendEmail($order);
                }

                break;

            case Event::CHECKOUT_SESSION_ASYNC_PAYMENT_SUCCEEDED:
                $this->updateOrderStatus($order, OrderStatusEnum::PAID);
                $this->sendEmail($order);

                break;

            case Event::CHECKOUT_SESSION_ASYNC_PAYMENT_FAILED:
                $this->updateOrderStatus($order, OrderStatusEnum::PAYMENT_FAILED);

                break;
        }

        return response()->json();
    }

    /**
     * @param Orders $order
     * @param string $status
     * @return void
     */
    private function updateOrderStatus(Orders $order, string $status): void
    {
        $order->status = $status;
        $order->save();
    }

    /**
     * @param Orders $order
     * @return void
     */
    private function sendEmail(Orders $order): void
    {
        $user = $order->user()->first();
        $subject = 'Willkommen bei der Last-Mile-Community';
        $body = 'Hallo (Herr / Frau) ' . $user->name . '<br> herzlich willkommen in der Last Mile Community. Sie sind nun Teil des lokalen Netzwerks von
                    Geschäften und Dienstleistungen, das für den nachhaltigen Einkauf aufgebaut wurde. <br> Shoppen Sie jetzt als registriertes Mitglied oder werden Sie Premium-Mitglied für kostenlose
                    Lieferungen, erweiterte Lieferoptionen und Premium-Vorteile ausgewählter Shops. <br> Jetzt einkaufen- (' . config('app.url') . ') <br> Vielen Dank - mit freundlichen Grüßen, <br> Die Last Mile Community';
        $mail = new MailController($subject, $body, $user->email);
        $mail->basic_email();
    }
}
