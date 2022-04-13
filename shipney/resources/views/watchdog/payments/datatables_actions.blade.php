<div class='btn-group btn-group-sm'>
  @can('watchdogPayments.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('watchdogPayments.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('watchdogPayments.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.watchdog_payments_edit')}}" href="{{ route('watchdogPayments.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('watchdogPayments.destroy')
{!! Form::open(['route' => ['watchdogPayments.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
