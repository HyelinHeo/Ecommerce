<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;

class NotificationUserDataTable extends DataTable
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
        return $dataTable
            ->editColumn('email', function ($user) {
                return getEmailColumn($user, 'email');
            })
            ->editColumn('id', function ($user) {
                return getRouteColumn($user, 'id', 'users.show');
            })
            ->editColumn('country_code', function ($user) {
                $extradata=array($user['email']);
                return getButtonColumn($user,'users[]','id', $extradata);
            })
            // ->addColumn('action', 'settings.users.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('roles');
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
                        file_get_contents(base_path('resources/lang/'.app()->getLocale().'/datatable.json')
                    ),true)
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
        // TODO custom element generator
        $columns = [
            [
                'data' => 'id',
                'title' => trans('lang.user_id'),
                'orderable' => true, 'searchable' => true,
            ],
            [
                'data' => 'name',
                'title' => trans('lang.user_name'),
                'orderable' => true, 'searchable' => true,
            ],
            [
                'data' => 'email',
                'title' => trans('lang.user_email'),
                'orderable' => true, 'searchable' => true,
            ],
            [
                'data' => 'phone',
                'title' => trans('lang.user_phone'),
                'orderable' => true, 'searchable' => true,
            ],
            ['data' => 'country_code','title' => "<div class='checkbox icheck'>
                                                <label class='w-auto ml-3 form-check-inline'>
                                                    <div class= 'btn btn-".setting('theme_color')."' onClick='selectUserList(this)' data-extra='All' value='all' id='all' name='all'>
                                                        ALL
                                                    </div>
                                                </label>
                                            </div>"
            ,'orderable' => false, 'searchable' => false,],
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
        return 'usersdatatable_' . time();
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