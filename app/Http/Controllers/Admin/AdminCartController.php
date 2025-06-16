<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\TmpInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminCartController extends Controller
{
    public function getcartItem()
    {
        // $today = Carbon::now()->toDateString();
        $invoices = TmpInvoice::where('user_id', Auth::id())
            ->orWhere('lead_id', Auth::id())
            ->where('status', 0)
            ->orderByDesc('id')
            ->get();
// dd($invoices);
        $html = '';
        if ($invoices) {
            $html .= '<form action="' . route('admin.invoice.show') . '" method="POST" id="invoice_form_submit">';
            $html .= csrf_field();
            $html .= '<table class="table">';
            $html .= '<tbody>';

            foreach ($invoices as $invoice) {
                $user = User::find($invoice->user_id);
                $html .= '<tr style="">';

                if ($invoice->lead_id) {
                    $html .= '<td style="padding: 5px; font-size:14px"><h6><i class="fas fa-dollar-sign circle-icon"></i> ' . $user->name . ' membership &nbsp;&nbsp;&nbsp;</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1 X $' . $invoice->price . '</td>';
                    $html .= '<td style="padding: 5px"><input type="hidden" name="inventory_ids[]" value="' . $invoice->lead_id . '"></td>';
                    $html .= '<td style="padding: 5px"><input type="hidden" name="user_ids[]" value="' . $invoice->user_id . '"></td>';
                    $html .= '<td style="padding: 5px"><input type="hidden" name="price" value="' . $invoice->price . '"></td>';
                    $html .= '<td style="padding: 5px"><a href="#" class="deleteCartSingle" data-id="' . $invoice->id . '"><i class="fa fa-trash mt-2 text-danger"></i></a></td>';
                    // $html .= '<td style="padding: 5px"><a  href="#" class="deleteCart" data-id="' . $invoice->lead_id . '"><i  class="fa fa-trash btn btn-sm btn-danger"></i></a></td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';

            $html .= '<button class="btn btn-success checkInvoiceNull mb-2" type="submit" style="position:absolute; bottom:0; right:5px">Checkout</button>';
            $html .= '</form>';
            if (count($invoices) > 0) {
                $html .= '<button style="position:absolute; bottom:0; left:5px" class="btn btn-danger clearAllBtn mb-2" type="button" >Clear All</button>';
            }
        }
        //   echo $html
        return response()->json(['status' => 'success', 'data' => $html, 'count' => count($invoices)]);
    }

    public function deleteAllCartItem()
    {
        $deleteCartData = TmpInvoice::where('status', 0)->get();
        foreach ($deleteCartData as $cartItem) {
            $cartItem->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Clear all invoices']);
    }

    public function deleteCartItem(Request $request)
    {
        TmpInvoice::where('id', $request->id)->delete();
        return response()->json(['status' => 'success', 'message' => 'List Remove successfully']);
    }
}
