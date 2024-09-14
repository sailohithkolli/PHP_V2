<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Inventory;
use App\Status;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

use App\Jobs\TestComputeJob;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$inventories = Inventory::all();
		$statuses = Status::all();
		$users = User::all();

		Session::put('inventory', $inventories->pluck('description')->toArray());

		if(Cache::has('transactions'))
		{
			$transactions =  Cache::get('transactions');
		}
		else
		{
			$transactions = Transaction::with(['inventory.status', 'user'])->get();
			Cache::add('transactions', $transactions);
		}

		TestComputeJob::dispatch(100)->onConnection('redis')->onQueue('default');


		return view('transaction.index')->with('inventories', $inventories)->with('statuses', $statuses)->with('transactions', $transactions)->with('users', $users);
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function show(Transaction $transaction)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Transaction $transaction)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Transaction $transaction)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Transaction $transaction)
	{
		//
	}
}
