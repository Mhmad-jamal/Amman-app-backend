<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Client;
use App\Models\CheckClient;
use App\Models\Order;
use App\Models\User;
use App\Models\Contract;

use App\Models\Subscription;





class Dashboard extends Component
{
    public  $Contract;
    public $countContract;
    public $admins;
public $clients;
public $checkClients;
public $orders;
public $users;
public $subscriptions;
public $adminsCount;
public $clientsCount;
public $checkClientsCount;
public $ordersCount;
public $usersCount;
public $subscriptionsCount;
public $paymentAmountSum;
public $lastClient;
public function render()
{
    $this->admins = Admin::latest()->take(5)->get();
    $this->adminsCount = $this->admins->count();
    $this->Contract = Contract::all();
    $this->countContract = $this->Contract->count();
    $this->clients = Client::all();
    $this->clientsCount = $this->clients->count();
    $this->lastClient = Client::latest()->take(5)->get();

    $this->checkClients = CheckClient::all();
    $this->checkClientsCount = $this->checkClients->count();

    $this->orders = Order::latest()->take(5)->get();
    $this->ordersCount = $this->orders->count();

    $this->users = User::all();
    $this->usersCount = $this->users->count();

    $this->subscriptions = Subscription::all();
    $this->subscriptionsCount = $this->subscriptions->count();
   $this->paymentAmountSum = DB::table('subscriptions')->sum('payment_amount');

    return view('dashboard');
}
}
