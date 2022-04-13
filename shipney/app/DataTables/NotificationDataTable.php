<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class NotificationDataTable extends DataTable
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
            ->editColumn('id', function ($notification) {
                return getRouteColumn($notification, 'id', 'notifications.show');
            })
            ->editColumn('type', function ($notification) {
                return trans('lang.notification_' . $notification->type);
            })
            // ->editColumn('notifiable_id', function ($notification) {
            //     return $notification->user->email;
            // })
            // ->addColumn('action', 'notifications.datatables_actions')
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
            [
                'data' => 'id',
                'title' => trans('lang.notification_id'),
                'searchable' => false,

            ],
            [
                'data' => 'type',
                'title' => trans('lang.notification_type'),
                'searchable' => true,

            ],
            [
                'data' => 'user.email',
                'title' => trans('lang.notification_user_id'),
                'searchable' => true,
                'orderable' => true,
            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.notification_updated_at'),
                'searchable' => false,
            ],
            // [
            //     'data' => 'created_at',
            //     'title' => trans('lang.notification_created_at'),
            //     'searchable' => false,
            // ]
        ];
        $columns = array_filter($columns);
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        return $model->newQuery()->with("user")
        ->join('users', 'users.id', '=', 'notifications.notifiable_id')
        ->select('notifications.*', 'users.email')
        ->orderBy('notifications.updated_at', 'desc');

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
        return 'notificationsdatatable_' . time();
    }
}