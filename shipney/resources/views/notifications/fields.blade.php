
<div style="padding: 0 4px;" class="column">
    <div class="scroll-div w-auto">
      <input name="all_users" class="select_all" type="checkbox">Select all
      <div class="checkbox icheck">
      {!! Form::checkbox('users[]', '1', null,['class' => 'check-box']) !!}Product 1
      </div>
      <div class="checkbox icheck">
      {!! Form::checkbox('users[]', '2', null,['class' => 'check-box']) !!}Product 2
      </div>
      <div class="checkbox icheck">
      {!! Form::checkbox('users[]', '3', null,['class' => 'check-box']) !!}Product 3
      </div>
      <div class="checkbox icheck">
      {!! Form::checkbox('users[]', '4', null,['class' => 'check-box']) !!}Product 4
      </div>
      <div class="checkbox icheck">
      {!! Form::checkbox('users[]', '5', null,['class' => 'check-box']) !!}Product 5
      </div>
    </div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
        $('.select_all').on('change', function() {     
                $('.check-box').prop('checked', $(this).prop("checked"));              
        });
        //deselect "checked all", if one of the listed checkbox category is unchecked amd select "checked all" if all of the listed checkbox category is checked
        $('.check-box').change(function(){ //".checkbox" change 
            if($('.check-box:checked').length == $('.check-box').length){
                   $('.select_all').prop('checked',true);
            }else{
                   $('.select_all').prop('checked',false);
            }
        });
    </script>
<!-- Submit Field -->
<div class="form-group mt-4 col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.notification')}}
    </button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>