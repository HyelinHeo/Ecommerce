
<div style="padding: 0 4px;" class="column">
  <div class="scroll-div w-auto">
        <div class="form-group row check-box-all">
            <div class="checkbox icheck">
                <label class="w-auto ml-3 form-check-inline">
                    {!! Form::checkbox('all_users', 0, null,['class' => 'select_all_orders', 'id'=>'all_users']) !!}
                    <span class="ml-3">{!! "All" !!}</span>
                </label>
            </div>
        </div>
        @foreach($order as $odr)
        <!-- user_list Field -->
        <div class="form-group row ">
            <!-- {!! Form::label($odr->id, trans("lang.app_setting_fixed_header"),['class' => 'col-4 control-label text-right']) !!} -->
            <div class="checkbox icheck">
                <label class="w-auto ml-3 form-check-inline">
                    {!! Form::checkbox('users[]', $odr->user_id, null,['class' => 'orders-check-box']) !!}
                    <span class="ml-3">{!! $odr->user->email." , ".$odr->orderno." , ".$odr->shipping_price_final !!}</span> </label>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    // Remove the checked state from "All" if any checkbox is unchecked
    $('.select_all_orders').on('ifUnchecked', function (event) {
        $('.orders-check-box').iCheck('uncheck');
    });

    // Add the checked state from "All" if any checkbox is checked
    $('.select_all_orders').on('ifChecked', function (event) {
        $('.orders-check-box').iCheck('check');
    });

    // Make "All" checked if all checkboxes are checked
    $('.orders-check-box').on('ifChecked', function (event) {
        console.log($('.orders-check-box').filter(':checked').length);
        console.log($('.orders-check-box').length);
        if ($('.orders-check-box').filter(':checked').length == $('.orders-check-box').length) {
            $('.select_all_orders').iCheck('check');
        }
    });

    // Make uncheck when unckeck at least 1
    // $('.orders-check-box').on('ifUnchecked', function (event) {
    //     console.log($('.orders-check-box').filter(':checked').length);
    //     if ($('.orders-check-box').filter(':checked').length != $('.orders-check-box').length) {
    //         $('.select_all_orders').iCheck('uncheck');
    //     }
    // });

});
</script>
<!-- Submit Field -->
<div class="form-group mt-4 col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.notification')}}
    </button>
    <a href="{!! url()->previous() !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>