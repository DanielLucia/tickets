<?php

namespace App\Http\Controllers;

use App\Markets;
use App\Tickets;
use App\TicketsContent;
use Auth;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $markets = Markets::all();
        $tickets = Tickets::leftJoin('markets', 'markets.idMarket', '=', 'tickets.market')->get();

        return view('tickets', compact('markets', 'tickets'));
    }

    /**
     *
     */
    public function view($id)
    {
        $ticket = Tickets::leftJoin('markets', 'markets.idMarket', '=', 'tickets.market')->where(['tickets.idTicket' => intval($id)])->first();
        $products = TicketsContent::all();
        $contentTicket = TicketsContent::where(['ticket' => $id])->get();

        return view('tickets.new', compact('ticket', 'products', 'contentTicket'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        $market = Markets::updateOrCreate(['name' => $request->input('market')]);

        $request->merge([
            'user' => Auth::id(),
            'market' => $market->idMarket,
        ]);
        $ticket = Tickets::create($request->all());

        return redirect()->route('tickets.view', ['id' => $ticket->idTicket]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function remove($id)
    {
        if (intval($id) == 0) {
            flash('El ticket no ha sido borrado')->error();
            return redirect()->route('home');
        }

        $ticket = Tickets::find($id);
        if ($ticket) {
            $ticket->delete();

            $contents = TicketsContent::where(['ticket' => $id])->delete();
            flash('Ticket borrado')->success();
        }

        return redirect()->route('home');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
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

        return redirect()->route('tickets.view', ['id' => $request->input('ticket')]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function removeProduct($id)
    {

    }
}
