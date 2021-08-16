<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReturnProductInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'returnproductinventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command return products inventory to products table if order payment/transaction was unsuccessful';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('created_at', '<', Carbon::now()->subMinutes(3)->toDateTimeString())->where('status', '0')->get();
        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order->orderItems as $orderItem) {
                    Product::where('id', $orderItem->product_id)->increment('quantity', $orderItem->quantity);
                }
                Order::where('id', $order->id)->update(['status' => 2, 'description' => 'سفارش به دلیل عدم پرداخت لغو گردید']);
                Payment::where('order_id', $order->id)->update(['status' => 3, 'description' => 'پرداختی صورت نگرفت و عملیات پرداخت لغو شد']);
            }
        }
    }
}
