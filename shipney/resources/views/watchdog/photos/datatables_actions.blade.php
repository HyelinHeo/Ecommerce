<div class='btn-group btn-group-sm'>
  @can('watchdogPhotos.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('watchdogPhotos.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('watchdogPhotos.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.watchdog_photos_edit')}}" href="{{ route('watchdogPhotos.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('watchdogPhotos.destroy')
{!! Form::open(['route' => ['watchdogPhotos.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
