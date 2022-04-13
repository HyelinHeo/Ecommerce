<?php

namespace App\DataTables;

use App\Models\CountryNews;
use App\Models\CustomField;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;

class CountryNewsDataTable extends DataTable
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
            ->editColumn('id', function ($country_news) {
                return getRouteColumn($country_news, 'id', 'countryNews.show');
            })
            ->editColumn('active', function ($country_news) {
                return getBooleanColumn($country_news, 'active');
            })
            // ->addColumn('action', 'country_news.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Datab
     * ase\Eloquent\Builder
     */
    public function query(CountryNews $model)
    {
        return $model->newQuery()->select('country_news.*');
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
            ['data' => 'id','title' => trans('lang.country_news_id'),],
            ['data' => 'nation','title' => trans('lang.country_news_nation'),],
            ['data' => 'language','title' => trans('lang.country_news_language'),],
            ['data' => 'title','title' => trans('lang.country_news_title'),],
            // ['data' => 'sub_title','title' => trans('lang.country_news_sub_title'),],
            // ['data' => 'content','title' => trans('lang.country_news_content'),],
            ['data' => 'writer','title' => trans('lang.country_news_writer'),],
            ['data' => 'active','title' => trans('lang.country_news_active'),],
            ['data' => 'updated_at','title' => trans('lang.country_news_updated_at'),'searchable' => false,]
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
        return 'countrynewsdatatable_' . time();
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