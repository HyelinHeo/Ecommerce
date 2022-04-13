<?php
/**
 * File name: PaymentDataTable.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

class PaymentDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('price', function ($payment) {
                return getPriceColumn($payment);
            })
            ->editColumn('orderno', function ($payment) {
                return getRouteColumn($payment, 'orderno', 'payments.show');
            })
            ->addColumn('action', 'payments.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {
        return $model->newQuery()->with("user")->select('payments.*')->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            ['data' => 'orderno','title' => trans('lang.payment_orderno'),],
            ['data' => 'user.email','title' => trans('lang.payment_user_id'),],
            ['data' => 'resultCode','title' => trans('lang.payment_resultCode'),],
            ['data' => 'payType','title' => trans('lang.payment_payType'),],
            ['data' => 'authDate','title' => trans('lang.payment_authDate'),],
            ['data' => 'price','title' => trans('lang.payment_price'),],
            ['data' => 'userName','title' => trans('lang.payment_userName'),],
            ['data' => 'cancelResultCode','title' => trans('lang.payment_cancelResultCode'),],
            ['data' => 'cancelResultMsg','title' => trans('lang.payment_cancelResultMsg'),],
            ['data' => 'prtcResultCode','title' => trans('lang.payment_prtcResultCode'),],
            ['data' => 'prtcResultMsg','title' => trans('lang.payment_prtcResultMsg'),],
            ['data' => 'updated_at','title' => trans('lang.payment_updated_at'),],
            // (auth()->check() && auth()->user()->hasAnyRole(['admin','manager'])) ? ['data' => 'user.name','title' => trans('lang.payment_user_id'),] : null,
            // ['data' => 'method','title' => trans('lang.payment_method'),],
            // ['data' => 'status','title' => trans('lang.payment_status'),],
            // ['data' => 'updated_at','title' => trans('lang.payment_updated_at'),'searchable' => false,]
        ];
        $columns = array_filter($columns);
        $hasCustomField = in_array(Payment::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Payment::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.payment_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'paymentsdatatable_' . time();
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }
}