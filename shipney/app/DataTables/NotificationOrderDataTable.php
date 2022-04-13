<?php
/**
 * File name: NotificationOrderDataTable.php
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

class NotificationOrderDataTable extends DataTable
{

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
            ->editColumn('orderno', function ($order) {
                return getRouteColumn($order, 'orderno', 'orders.show');
            })
            ->editColumn('user_id', function ($order) {
                $extradata = array($order['user']['email'], $order['orderno']);
                return getButtonColumn($order,'users[]','user_id', $extradata);
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
            ['data' => 'orderno','title' => trans('lang.order_orderno'),'orderable' => true, 'searchable' => true,],
            ['data' => 'user.email','name' => 'user.name','title' => trans('lang.order_user_id'),'orderable' => true, 'searchable' => true,],
            ['data' => 'order_status.status','name' => 'orderStatus.status','title' => trans('lang.order_order_status_id'),'orderable' => false, 'searchable' => false,],
            ['data' => 'nation_code','title' => trans('lang.order_nation_code'),'orderable' => false, 'searchable' => false,],
            ['data' => 'updated_at','title' => trans('lang.order_updated_at'),'orderable' => false, 'searchable' => false,],
            ['data' => 'user_id','title' => "<div class='checkbox icheck'>
                                                <label class='w-auto ml-3 form-check-inline'>
                                                    <div class= 'btn btn-".setting('theme_color')."' onClick='selectUserList(this)' data-extra='All' value='all' id='all' name='all'>
                                                        ALL
                                                    </div>
                                                </label>
                                            </div>"
            ,'orderable' => false, 'searchable' => false,],];
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