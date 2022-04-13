<?php
/**
 * File name: PhotoTranslationDataTableJP.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\PhotoTranslation;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

class PhotoTranslationDataTableJP extends DataTable
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
            ->editColumn('address_photo1', function ($order) {
                return getPhotoColumn($order,'address_photo1');
            })
            ->editColumn('address_photo2', function ($order) {
                return getPhotoColumn($order,'address_photo2');
            })
            ->editColumn('receiver_name_photo1', function ($order) {
                return getPhotoColumn($order,'receiver_name_photo1');
            })
            ->editColumn('receiver_name_photo2', function ($order) {
                return getPhotoColumn($order,'receiver_name_photo2');
            })
            ->editColumn('id', function ($order) {
                return getRouteColumn($order, 'id', 'photoTranslationsJP.show');
            })
            ->editColumn('created_at', function ($order) {
                return getDiffDate($order, 'created_at');
            })
            // ->addColumn('action', 'photo_translation.cn.datatables_actions')
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
            ['data' => 'id', 'title' => trans('lang.order_id'),],
            ['data' => 'user.name','name' => 'user.name','title' => trans('lang.order_user_id'),],
            ['data' => 'address_photo1','title' => trans('lang.order_address_photo1'),],
            ['data' => 'address_photo2','title' => trans('lang.order_address_photo2'),],
            ['data' => 'address_trans_done','title' => trans('lang.order_address_trans_done'),],
            ['data' => 'receiver_name_photo1','title' => trans('lang.order_receiver_name_photo1'),],
            ['data' => 'receiver_name_photo2','title' => trans('lang.order_receiver_name_photo2'),],
            ['data' => 'receiver_name_trans_done','title' => trans('lang.order_receiver_name_trans_done'),],
            ['data' => 'created_at','title' => trans('lang.order_created_at'),],
            ['data' => 'updated_at','title' => trans('lang.order_updated_at'),],
        ];
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PhotoTranslation $model)
    {
        return $model->newQuery()->with("user")
        ->where(function ($query) {
            $query->whereNotNull('address_photo1_uuid')
                    ->where('nation_code','=','JP')
                    ->where(function ($querys) {
                        $querys->whereNull('address_trans_done')
                            ->orWhere('address_trans_done', '!=', 'complete');
                    });
        })
        ->orWhere(function ($query) {
            $query->whereNotNull('receiver_name_photo1_uuid')
                    ->where('nation_code','=','JP')
                    ->where(function ($querys) {
                        $querys->whereNull('receiver_name_trans_done')
                            ->orWhere('receiver_name_trans_done', '!=', 'complete');
                    });
        })
        ->orderBy('id', 'desc');
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