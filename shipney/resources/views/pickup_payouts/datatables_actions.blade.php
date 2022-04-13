<div class='btn-group btn-group-sm'>
  @can('pickupPayouts.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('pickupPayouts.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('pickupPayouts.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.pickup_payout_edit')}}" href="{{ route('pickupPayouts.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('pickupPayouts.destroy')
{!! Form::open(['route' => ['pickupPayouts.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
