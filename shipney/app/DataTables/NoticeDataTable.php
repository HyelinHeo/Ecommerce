<?php

namespace App\DataTables;

use App\Models\Notice;
use App\Models\CustomField;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;

class NoticeDataTable extends DataTable
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
            ->editColumn('id', function ($notice) {
                return getRouteColumn($notice, 'id', 'notice.show');
            })
            ->editColumn('disptop', function ($notice) {
                return getBooleanColumn($notice, 'disptop');
            })
            ->editColumn('dispHomeMode', function ($notice) {
                return getDisplayHomeModeColumn($notice, 'dispHomeMode');
            })
            ->editColumn('active', function ($notice) {
                return getBooleanColumn($notice, 'active');
            })
            // ->addColumn('action', 'notice.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notice $model)
    {
        return $model->newQuery()->select('notice.*');
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
            ['data' => 'id','title' => trans('lang.notice_id'),],
            ['data' => 'nation','title' => trans('lang.notice_nation'),],
            ['data' => 'language','title' => trans('lang.notice_language'),],
            ['data' => 'title','title' => trans('lang.notice_title'),],
            // ['data' => 'content','title' => trans('lang.notice_content'),],
            ['data' => 'writer','title' => trans('lang.notice_writer'),],
            ['data' => 'disptop','title' => trans('lang.notice_disptop'),],
            ['data' => 'dispHomeMode','title' => trans('lang.notice_dispHomeMode'),],
            ['data' => 'active','title' => trans('lang.notice_active'),],
            ['data' => 'updated_at','title' => trans('lang.notice_updated_at'),'searchable' => false,]
        ];

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'noticedatatable_' . time();
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