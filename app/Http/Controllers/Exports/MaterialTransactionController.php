<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use App\Models\Admin\MTransaction;
use Illuminate\Http\Request;
use PDF;

class MaterialTransactionController extends Controller
{
    public function downloadPdf()
    {
        $transactions = MTransaction::with([
            'users' => function ($query) {
                $query->select(['id', 'name', 'employee_id']);
            },
            'materials' => function ($query) {
                $query->select(['id', 'name', 'suppliers_id', 'm_metrics_id']);
            },
            'materials.suppliers' => function ($query) {
                $query->select(['id', 'name']);
            },
            'materials.metrics' => function ($query) {
                $query->select(['id', 'code']);
            },
            'users.employee' => function ($query) {
                $query->select(['id', 'name']);
            }
        ])->latest('created_at')
            ->select(
                [
                    'id',
                    'users_id',
                    'materials_id',
                    'total_count',
                    'item_price',
                    'total_price',
                    'created_at'
                ])->get();
        $pdf = PDF::loadView('reports.pdf.materialTransactions', compact('transactions'))->setPaper('a4', 'landscape');
        return $pdf->download('transactions.pdf');
    }

    public function downloadDateFilterPdf(Request $request){
        $transactions = MTransaction::with([
            'users' => function ($query) {
                $query->select(['id', 'name', 'employee_id']);
            },
            'materials' => function ($query) {
                $query->select(['id', 'name', 'suppliers_id', 'm_metrics_id']);
            },
            'materials.suppliers' => function ($query) {
                $query->select(['id', 'name']);
            },
            'materials.metrics' => function ($query) {
                $query->select(['id', 'code']);
            },
            'users.employee' => function ($query) {
                $query->select(['id', 'name']);
            }
        ])->latest('created_at')
            ->select(
                [
                    'id',
                    'users_id',
                    'materials_id',
                    'total_count',
                    'item_price',
                    'total_price',
                    'created_at'
                ])
            ->whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $pdf = PDF::loadView('reports.pdf.materialTransactions', compact('transactions'))->setPaper('a4', 'landscape');
        return $pdf->download('transactions.pdf');
    }
}
