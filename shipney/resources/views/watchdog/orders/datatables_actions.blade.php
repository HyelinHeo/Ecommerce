<div class='btn-group btn-group-sm'>
  @can('watchdogOrders.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('watchdogOrders.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('watchdogOrders.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.watchdog_orders_edit')}}" href="{{ route('watchdogOrders.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('watchdogOrders.destroy')
{!! Form::open(['route' => ['watchdogOrders.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
