<div class='btn-group btn-group-sm'>
  @can('photoTranslationsTW.show')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.view_details')}}" href="{{ route('photoTranslationsTW.show', $id) }}" class='btn btn-link'>
    <i class="fa fa-eye"></i>
  </a>
  @endcan

  @can('photoTranslationsTW.edit')
  <a data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.photo_translation_edit')}}" href="{{ route('photoTranslationsTW.edit', $id) }}" class='btn btn-link'>
    <i class="fa fa-edit"></i>
  </a>
  @endcan

  @can('photoTranslationsTW.destroy')
{!! Form::open(['route' => ['photoTranslationsTW.destroy', $id], 'method' => 'delete']) !!}
  {!! Form::button('<i class="fa fa-trash"></i>', [
  'type' => 'submit',
  'class' => 'btn btn-link text-danger',
  'onclick' => "return confirm('Are you sure?')"
  ]) !!}
{!! Form::close() !!}
  @endcan
</div>
