<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment as PaymentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

use App\Traits\OrderTrait;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    use OrderTrait;

    
    // display user Transactions Page
    public function index()
    {
        $userId =  Auth::user()->id;
        $user = User::find($userId);
        $transactions = $user->payments()->get();
        return view('front.transactions.index', compact('transactions'));
    }



    public function pay_test(Request $request)
    {
        $this->SaveOrdersTemporary();
        $total = $this->ordersTotalAmount();

        // request to the payment gateway for making transaction id and load transaction page for user
        $invoice = (new Invoice)->amount(intval($total));

        return Payment::purchase(
            $invoice,
            function ($driver, $transactionId) use ($total) {
                $payment = new PaymentModel();
                $payment->user_id = $this->order_user_id;
                $payment->order_id = $this->order_id;
                $payment->payment_type = 'zarinpal';
                $payment->description = 'در انتظار پرداخت';
                $payment->transaction_id = $transactionId;
                $payment->amount = $total;
                $payment->save();
            }
        )->pay()->render();
    }


    public function verify()
    {
        $transaction_id = $_GET['Authority'];
        $payment = PaymentModel::where('transaction_id', '=', $transaction_id)->firstOrFail();
        $paymentAmount = intval($payment->amount);

        try {
            $receipt = Payment::amount($paymentAmount)->transactionId($transaction_id)->verify();
            $payment->reference_id = $receipt->getReferenceId();
            $orderId = $payment->order_id;

            $order = Order::where('id', '=', $orderId)->firstOrFail();
            $order->status = 1;
            $order->description = ' سفارش با موفقیت انجام شده است';
            $order->update();

            $this->setOrdersCoupon($orderId);

            $payment->status = 1;
            $payment->description = 'پرداخت انجام شد';
            $payment->update();
            Session::pull('cart');
            return redirect()->route('orderDetails', [$payment,$order]);

        } catch (InvalidPaymentException $exception) {
            $payment->status = 2;
            $payment->description = $exception->getMessage();
            $payment->update();
            return redirect()->back()->withErrors("پرداخت ناموفق");
        }
    }





    //admin

    public function allTransactions()
    {
        $transactions = PaymentModel::get();
        return view('back.transactions.index', compact('transactions'));
    }



}
