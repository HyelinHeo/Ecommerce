<?php
/**
 * File name: WatchdogUserFeedbackDataTableError.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\UserFeedback;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;

class WatchdogUserFeedbackDataTableError extends DataTable
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
            ->editColumn('id', function ($userfeedback) {
                return getRouteColumn($userfeedback, 'id', 'watchdogUserFeedback.show');
            })
            ->editColumn('done', function ($userfeedback) {
                return getDoneColumn($userfeedback, 'done');
            })
            ->addColumn('action', 'watchdog.user_feedback.datatables_actions')
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
            ['data' => 'id', 'title' => trans('lang.user_feedback_id'),],
            ['data' => 'user.email', 'title' => trans('lang.user_feedback_user'),],
            ['data' => 'data', 'title' => trans('lang.user_feedback_data'),],
            ['data' => 'content', 'title' => trans('lang.user_feedback_content'),],
            ['data' => 'done', 'title' => trans('lang.user_feedback_done'),],
            ['data' => 'created_at', 'title' => trans('lang.user_feedback_created_at'),],
            ['data' => 'updated_at', 'title' => trans('lang.user_feedback_updated_at'),],
        ];
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserFeedback $model)
    {
        return $model->newQuery()->with("user")
        ->where('type', '=', 0)
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
        return 'usersFeedbackDatatable_' . time();
    }
}