<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SubscriptionController extends Controller
{
    public function show()
    {
        return view('subscription.payment');
    }

    public function createCheckoutSession(Request $request)
    {
        \Log::info('Starting checkout session creation');
        
        try {
            Stripe::setApiKey(config('stripe.sk'));

            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => 999, // $9.99
                        'product_data' => [
                            'name' => 'Team Creation Subscription',
                            'description' => 'Subscribe to create unlimited teams',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment', // Changed from subscription to one-time payment for simplicity
                'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('team.index'),
                'metadata' => [
                    'user_id' => auth()->id(),
                    'team_name' => session('pending_team.name'),
                    'team_description' => session('pending_team.description'),
                ],
            ]);

            \Log::info('Checkout session created successfully', ['session_id' => $checkout_session->id]);
            
            return response()->json(['url' => $checkout_session->url]);
        } catch (\Exception $e) {
            \Log::error('Error creating checkout session: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        try {
            Stripe::setApiKey(config('stripe.sk'));
            
            $session = Session::retrieve($request->get('session_id'));
            $user = auth()->user();

            // Update user subscription status
            $user->update([
                'is_subscribed' => true,
            ]);

            // Create the pending team
            $pendingTeam = session('pending_team');
            if ($pendingTeam) {
                $team = Team::create([
                    'name' => $pendingTeam['name'],
                    'description' => $pendingTeam['description'],
                    'owner_id' => $user->id,
                ]);

                $team->users()->attach($user, ["role" => "owner"]);
                session()->forget('pending_team');
            }

            return redirect()->route('team.index')
                ->with('success', 'Payment successful! You can now create unlimited teams.');
        } catch (\Exception $e) {
            \Log::error('Error in success callback: ' . $e->getMessage());
            return redirect()->route('team.index')
                ->with('error', 'Something went wrong with the payment process.');
        }
    }
}