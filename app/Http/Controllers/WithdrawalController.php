<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('withdrawal-view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);

        $d = new DateTime();
        $day = $d->format('l');
        // dd($day);
        $per = 0;
        $user = User::find(Auth::user()->id);
        $count_1k = Transaction::where('user_id', $user->id)->where('transaction_type', 0)->sum('amount');
        // $count_5k = Transaction::where('user_id', $user->id)->where('account_type', 1)->where('transaction_type', 0)->sum('amount');

        if ($count_1k == 1000) {


            if ($day == 'Friday') {
                $curr_bal = $user->balance - $request->amount;
                $user->balance = $curr_bal;
                $user->save();
                Transaction::create([
                    'amount' => $request->amount,
                    'transaction_type' => 0,
                    'fee' => 0,
                    'user_id' => Auth::user()->id,
                    'date' => Carbon::now()
                ]);
                return redirect()->back()->with(['msg' => 'Withdrawal succeded']);
            }  else {
                if ($user->account_type == 0) {
                    $per = .015 / 100;
                    $curr_bal = $user->balance - ($request->amount + $per);
                    $user->balance = $curr_bal;
                    $user->save();
                    Transaction::create([
                        'amount' => $request->amount + $per,
                        'transaction_type' => 0,
                        'fee' => $per,
                        'user_id' => Auth::user()->id,
                        'date' => Carbon::now()
                    ]);
                    return redirect()->back()->with(['msg' => 'Withdrawal succeded']);
                } else {
                    $per = .025 / 100;
                    $curr_bal = $user->balance - ($request->amount + $per);
                    $user->balance = $curr_bal;
                    $user->save();
                    Transaction::create([
                        'amount' => $request->amount + $per,
                        'transaction_type' => 0,
                        'fee' => $per,
                        'user_id' => Auth::user()->id,
                        'date' => Carbon::now()
                    ]);
                    return redirect()->back()->with(['msg' => 'Withdrawal succeded']);
                }
            }
        } else {
            $curr_bal = $user->balance - $request->amount;
            $user->balance = $curr_bal;
            $user->save();
            Transaction::create([
                'amount' => $request->amount,
                'transaction_type' => 0,
                'fee' => 0,
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()
            ]);
            return redirect()->back()->with(['msg' => 'Withdrawal succeded']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
