<?php
/**
 * File name: OrderDataTable.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

class OrderDataTable extends DataTable
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
            ->editColumn('orderno', function ($product) {
                return getRouteColumn($product, 'orderno', 'orders.show');
            })
            // ->addColumn('action', 'orders.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));
        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            ['data' => 'orderno','title' => trans('lang.order_orderno'),],
            ['data' => 'user.email','name' => 'user.name','title' => trans('lang.order_user_id'),],
            ['data' => 'order_status.status','name' => 'orderStatus.status','title' => trans('lang.order_order_status_id'),],
            ['data' => 'accident_code','title' => trans('lang.order_accident_code'),],
            ['data' => 'cancel_code','title' => trans('lang.order_cancel_code'),],
            ['data' => 'nation_code','title' => trans('lang.order_nation_code'),],
            ['data' => 'regno','title' => trans('lang.order_regno'),],
            ['data' => 'pickupOrderNo','title' => trans('lang.order_pickupOrderNo'),],
            ['data' => 'updated_at','title' => trans('lang.order_updated_at'),],
        ];

        // $hasCustomField = in_array(Order::class, setting('custom_field_models', []));
        // if ($hasCustomField) {
        //     $customFieldsCollection = CustomField::where('custom_field_model', Order::class)->where('in_table', '=', true)->get();
        //     foreach ($customFieldsCollection as $key => $field) {
        //         array_splice($columns, $field->order - 1, 0, [[
        //             'data' => 'custom_fields.' . $field->name . '.view',
        //             'title' => trans('lang.order_' . $field->name),
        //             'orderable' => false,
        //             'searchable' => false,
        //         ]]);
        //     }
        // }
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery()->with("user")->with("orderStatus")->with('payment')->with('pickupInformations')->orderBy('id', 'desc');
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
                [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true),
                    'order' => [ [0, 'desc'] ],
                ],
                config('datatables-buttons.parameters')
            ));
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ordersdatatable_' . time();
    }
}