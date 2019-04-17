<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;
use App\Markets;
use App\TicketsContent;
use Auth;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $markets = Markets::all();
        $tickets = Tickets::leftJoin('markets', 'markets.id', '=', 'tickets.market')->get();

        return view('tickets', compact('markets', 'tickets'));
    }

    public function view($id)
    {
        $ticket = Tickets::leftJoin('markets', 'markets.id', '=', 'tickets.market')->where(['tickets.id' => intval($id)])->first();
        $products = TicketsContent::all();
        $contentTicket = TicketsContent::where(['ticket' => $id])->get();

        return view('tickets.new', compact('ticket', 'products', 'contentTicket'));
    }

    public function save(Request $request)
    {
        $market = Markets::updateOrCreate(['name' => $request->input('market')]);

        $request->merge(['user' => Auth::id()]);
        $ticket = Tickets::create($request->all());

        return redirect()->route('tickets.view', ['id' => $ticket->id]);
    }

    public function saveProduct(Request $request)
    {
        $product = TicketsContent::where(['product' => $request->input('product')])->first();
        if (!$product) {
            $request->merge(['user' => Auth::id()]);
            TicketsContent::create($request->all());
        } else {
            $product->quantity += intval($request->input('quantity'));
            $product->save();
        }

        $ticket = Tickets::find(intval($request->input('ticket')));
        $ticket->total += (floatval($request->input('price')) * intval($request->input('quantity')));
        $ticket->save();

        return redirect()->route('tickets.view', ['id' => $request->input('ticket')]);
    }
}
