<?php

namespace App\Http\Controllers;

use App\Models\AdvanceBorrow;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\ProductServiceCategory;

class AdvanceBorrowController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('manage goal'))
        {
            $advanceBorrows = AdvanceBorrow::where('created_by', '=', \Auth::user()->creatorId())->with('bankAccount','category')->get();
            //echo '<pre>';print_r($advanceBorrows);exit;
            $paidTotal = AdvanceBorrow::where('status', 'Paid')->sum('amount');
            $unpaidTotal = AdvanceBorrow::where('status', 'Pending')->sum('amount');
            return view('advanceborrow.index', compact('advanceBorrows','paidTotal','unpaidTotal'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('create goal'))
        {
            $category = ProductServiceCategory::where('created_by', \Auth::user()->creatorId())->where('type', 'Advance or Borrow')->get()->pluck('name', 'id');
            $category->prepend('Select Category', '');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            return view('advanceborrow.create',compact('category','accounts'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('create goal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'date' => 'required',
                                   'amount' => 'required',
                                   'category_id' => 'required',
                                    'account_id' => 'required',
                                   'reference' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $AdvanceBorrow                  = new AdvanceBorrow();
            $AdvanceBorrow->date            = $request->date;
            $AdvanceBorrow->amount          = $request->amount;
            $AdvanceBorrow->account_id         = $request->account_id;
            $AdvanceBorrow->category_id        = $request->category_id;
            $AdvanceBorrow->reference       = $request->reference;
            $AdvanceBorrow->description     = $request->description;
            $AdvanceBorrow->created_by      = \Auth::user()->creatorId();
            $AdvanceBorrow->save();

            return redirect()->route('advanceborrow.index')->with('success', __('Record successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(AdvanceBorrow $advanceBorrow)
    {
        //
    }


    public function edit(AdvanceBorrow $advanceborrow)
    {
        //echo '<pre>';print_r($advanceborrow);exit;
        if(\Auth::user()->can('create goal'))
        {
            $category = ProductServiceCategory::where('created_by', \Auth::user()->creatorId())->where('type', 'Advance or Borrow')->get()->pluck('name', 'id');
            $category->prepend('Select Category', '');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('advanceborrow.edit', compact( 'advanceborrow', 'accounts', 'category'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, AdvanceBorrow $advanceborrow)
    {
        if(\Auth::user()->can('edit goal'))
        {
            if($advanceborrow->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                        'date' => 'required',
                        'amount' => 'required',
                        'category_id' => 'required',
                        'account_id' => 'required',
                        'reference' => 'required',
                    ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
               // echo '<pre>';print_r($request->all());exit;

                $advanceborrow->date            = $request->date;
                $advanceborrow->amount          = $request->amount;
                $advanceborrow->account_id         = $request->account_id;
                $advanceborrow->category_id        = $request->category_id;
                $advanceborrow->reference       = $request->reference;
                $advanceborrow->description     = $request->description;
                $advanceborrow->status      =   ($request->has('status') && $request->status == 'Paid')?'Paid':'Pending';
                $advanceborrow->save();

                return redirect()->route('advanceborrow.index')->with('success', __('Record successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(AdvanceBorrow $advanceborrow)
    {
        if(\Auth::user()->can('delete goal'))
        {
            if($advanceborrow->created_by == \Auth::user()->creatorId())
            {
                $advanceborrow->delete();

                return redirect()->route('advanceborrow.index')->with('success', __('Record successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
