@can('dashboard')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{!! url('dashboard') !!}">@if($icons)
                <i class="nav-icon fa fa-dashboard"></i>@endif
            <p>{{trans('lang.dashboard')}}</p></a>
    </li>
@endcan

@can('earnings.index')
<li class="nav-header">{{trans('lang.earning_management')}}</li>

    <li class="nav-item has-treeview {{ Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('pickupPayouts*') || Request::is('marketsPayouts*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('pickupPayouts*') || Request::is('marketsPayouts*') ? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-credit-card"></i>@endif
            <p>{{trans('lang.earning_plural')}}<i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">

            @can('earnings.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('earnings*') ? 'active' : '' }}" href="{!! route('earnings.index') !!}">@if($icons)<i class="nav-icon fa fa-money"></i>@endif<p>{{trans('lang.earning_plural')}} <!--<span class="right badge badge-danger">New</span>--> </p></a>
                </li>
            @endcan

            @can('pickupPayouts.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pickupPayouts*') ? 'active' : '' }}" href="{!! route('pickupPayouts.index') !!}">@if($icons)<i class="nav-icon fa fa-dollar"></i>@endif<p>{{trans('lang.pickup_payout_plural')}}</p></a>
                </li>
            @endcan

            @can('marketsPayouts.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('marketsPayouts*') ? 'active' : '' }}" href="{!! route('marketsPayouts.index') !!}">@if($icons)<i class="nav-icon fa fa-dollar"></i>@endif<p>{{trans('lang.markets_payout_plural')}}</p></a>
                </li>
            @endcan

        </ul>
    </li>
@endcan

            
<!-- @can('orders.index')
    <li class="nav-item has-treeview {{ Request::is('orders*') || Request::is('deliveryAddresses*') || Request::is('payments*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('orders*') || Request::is('deliveryAddresses*') || Request::is('payments*') ? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-shopping-bag"></i>@endif
            <p>{{trans('lang.order_plural')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview"> -->

            @can('orders.index')
<li class="nav-header">{{trans('lang.order_management')}}</li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{!! route('orders.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-shopping-bag"></i>@endif<p>{{trans('lang.order_plural')}}</p></a>
                </li>
            @endcan

            @can('deliveryAddresses.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('deliveryAddresses*') ? 'active' : '' }}" href="{!! route('deliveryAddresses.index') !!}">@if($icons)<i class="nav-icon fa fa-map"></i>@endif<p>{{trans('lang.delivery_address_plural')}}</p></a>
                </li>
            @endcan

            @can('payments.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('payments*') ? 'active' : '' }}" href="{!! route('payments.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-money"></i>@endif<p>{{trans('lang.payment_plural')}}</p></a>
                </li>
            @endcan

        <!-- </ul>
    </li>
@endcan -->

@can('watchdogOrders.index')
<!--Error menu-->
<li class="nav-header">{{trans('lang.app_watchdogs')}}</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('watchdogOrders*') ? 'active' : '' }}" href="{!! route('watchdogOrders.index') !!}">@if($icons)<i class="nav-icon fa fa-shopping-bag"></i>@endif<p>{{trans('lang.watchdog_orders_plural')}}</p></a>
    </li>
@endcan

@can('watchdogPayments.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('watchdogPayments*') ? 'active' : '' }}" href="{!! route('watchdogPayments.index') !!}">@if($icons)<i class="nav-icon fa fa-money"></i>@endif<p>{{trans('lang.watchdog_payments_plural')}}</p></a>
    </li>
@endcan

@can('watchdogPhotos.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('watchdogPhotos*') ? 'active' : '' }}" href="{!! route('watchdogPhotos.index') !!}">@if($icons)<i class="nav-icon fa fa-photo"></i>@endif<p>{{trans('lang.watchdog_photos_plural')}}</p></a>
    </li>
@endcan

@can('watchdogUserFeedback.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('watchdogUserFeedback*') ? 'active' : '' }}" href="{!! route('watchdogUserFeedback.index') !!}">@if($icons)<i class="nav-icon fa fa-photo"></i>@endif<p>{{trans('lang.user_feedback_plural')}}</p></a>
    </li>
@endcan


@can('photoTranslations.index')
<!--Photo translation menu-->
<li class="nav-header">{{trans('lang.app_photo_translations')}}</li>
    <li class="nav-item has-treeview {{ Request::is('photoTranslationsUS*') || Request::is('photoTranslationsCN*') || Request::is('photoTranslationsID*') || Request::is('photoTranslationsMY*') || Request::is('photoTranslationsTH*') || Request::is('photoTranslationsVN*') || Request::is('photoTranslationsTW*') || Request::is('photoTranslationsHK*') || Request::is('photoTranslationsJP*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('photoTranslationsUS*') || Request::is('photoTranslationsCN*') || Request::is('photoTranslationsID*') || Request::is('photoTranslationsMY*') || Request::is('photoTranslationsTH*') || Request::is('photoTranslationsVN*') || Request::is('photoTranslationsTW*') || Request::is('photoTranslationsHK*') || Request::is('photoTranslationsJP*') ? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-language"></i>@endif
            <p>{{trans('lang.photo_translation_plural')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">

            @can('photoTranslationsUS.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsUS*') ? 'active' : '' }}" href="{!! route('photoTranslationsUS.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.US_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsCN.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsCN*') ? 'active' : '' }}" href="{!! route('photoTranslationsCN.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.CN_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsID.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsID*') ? 'active' : '' }}" href="{!! route('photoTranslationsID.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.ID_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsMY.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsMY*') ? 'active' : '' }}" href="{!! route('photoTranslationsMY.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.MY_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsTH.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsTH*') ? 'active' : '' }}" href="{!! route('photoTranslationsTH.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.TH_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsVN.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsVN*') ? 'active' : '' }}" href="{!! route('photoTranslationsVN.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.VN_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsTW.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsTW*') ? 'active' : '' }}" href="{!! route('photoTranslationsTW.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.TW_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsHK.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsHK*') ? 'active' : '' }}" href="{!! route('photoTranslationsHK.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.HK_plural')}}</p></a>
                </li>
            @endcan

            @can('photoTranslationsJP.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('photoTranslationsJP*') ? 'active' : '' }}" href="{!! route('photoTranslationsJP.index') !!}">@if($icons)<i class="nav-icon fa fa-language"></i>@endif<p>{{trans('lang.JP_plural')}}</p></a>
                </li>
            @endcan
        </ul>
    </li>
@endcan


@can('users.index')
<!--User Management menu-->
<li class="nav-header">{{trans('lang.user_management')}}</li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{!! route('users.index') !!}">@if($icons)
                <i class="nav-icon fa fa-users"></i>@endif
            <p>{{trans('lang.user_plural')}}</p></a>
    </li>
@endcan


@can('notifications.index')
<!--App notification menu-->
<li class="nav-header">{{trans('lang.app_notification')}}</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}" href="{!! route('notifications.index') !!}">@if($icons)
                <i class="nav-icon fa fa-bell"></i>@endif<p>{{trans('lang.notification_plural')}}</p></a>
    </li>
@endcan


    @can('faqCategories.index')
<!--App management menu-->
<li class="nav-header">{{trans('lang.app_management')}}</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('faqCategories*') ? 'active' : '' }}" href="{!! route('faqCategories.index') !!}">@if($icons)
                <i class="nav-icon fa fa-folder"></i>@endif<p>{{trans('lang.faq_category_plural')}}</p></a>
    </li>
    @endcan

    @can('faqs.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('faqs*') ? 'active' : '' }}" href="{!! route('faqs.index') !!}">@if($icons)
                <i class="nav-icon fa fa-list"></i>@endif<p>{{trans('lang.faq_plural')}}</p></a>
    </li>
    @endcan

    @can('notice.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('notice*') ? 'active' : '' }}" href="{!! route('notice.index') !!}">@if($icons)
                <i class="nav-icon fa fa-list"></i>@endif<p>{{trans('lang.notice_plural')}}</p></a>
    </li>
    @endcan

    @can('countryNews.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('countryNews*') ? 'active' : '' }}" href="{!! route('countryNews.index') !!}">@if($icons)
                <i class="nav-icon fa fa-newspaper-o"></i>@endif<p>{{trans('lang.country_news_plural')}}</p></a>
    </li>
    @endcan

@can('events.index')
<li class="nav-header">{{trans('lang.events_and_coupons')}}</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('events*') ? 'active' : '' }}" href="{!! route('events.index') !!}">@if($icons)<i class="nav-icon fa fa-calendar"></i>@endif<p>{{trans('lang.event_plural')}}</p></a>
    </li>
@endcan

@can('coupons.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('coupons*') ? 'active' : '' }}" href="{!! route('coupons.index') !!}">@if($icons)<i class="nav-icon fa fa-money"></i>@endif<p>{{trans('lang.coupon_plural')}}</p></a>
    </li>
@endcan


@can('categories.index')
<!--System Settings-->
<li class="nav-header">{{trans('lang.system_setting')}}</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{!! route('categories.index') !!}">@if($icons)
                <i class="nav-icon fa fa-folder"></i>@endif<p>{{trans('lang.category_plural')}}</p></a>
    </li>
@endcan

@can('orderStatuses.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('orderStatuses*') ? 'active' : '' }}" href="{!! route('orderStatuses.index') !!}">@if($icons)
                <i class="nav-icon fa fa-server"></i>@endif<p>{{trans('lang.order_status_plural')}}</p></a>
    </li>
@endcan

<!-- @can('drivers.index')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('drivers*') ? 'active' : '' }}" href="{!! route('drivers.index') !!}">@if($icons)<i class="nav-icon fa fa-car"></i>@endif<p>{{trans('lang.driver_plural')}} </p></a>
    </li>
@endcan -->

<!-- @can('faqs.index')
    <li class="nav-item has-treeview {{ Request::is('faqCategories*') || Request::is('faqs*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('faqs*') || Request::is('faqCategories*') ? 'active' : '' }}"> @if($icons)
                <i class="nav-icon fa fa-support"></i>@endif
            <p>{{trans('lang.faq_plural')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('faqCategories.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('faqCategories*') ? 'active' : '' }}" href="{!! route('faqCategories.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-folder"></i>@endif<p>{{trans('lang.faq_category_plural')}}</p></a>
                </li>
            @endcan

            @can('faqs.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('faqs*') ? 'active' : '' }}" href="{!! route('faqs.index') !!}">@if($icons)
                            <i class="nav-icon fa fa-question-circle"></i>@endif
                        <p>{{trans('lang.faq_plural')}}</p></a>
                </li>
            @endcan
        </ul>
    </li>
@endcan -->

<!--App Setting-->
<!-- @can('medias')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('medias*') ? 'active' : '' }}" href="{!! url('medias') !!}">@if($icons)<i class="nav-icon fa fa-picture-o"></i>@endif
            <p>{{trans('lang.media_plural')}}</p></a>
    </li>
@endcan -->

@can('app-settings')
<li class="nav-header">{{trans('lang.app_setting')}}</li>
    <li class="nav-item has-treeview {{ Request::is('settings/mobile*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('settings/mobile*') ? 'active' : '' }}">
            @if($icons)<i class="nav-icon fa fa-mobile"></i>@endif
            <p>
                {{trans('lang.mobile_menu')}}
                <i class="right fa fa-angle-left"></i>
            </p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{!! url('settings/mobile/globals') !!}" class="nav-link {{  Request::is('settings/mobile/globals*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-cog"></i> @endif <p>{{trans('lang.app_setting_globals')}} <span class="right badge badge-danger">New</span> </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/mobile/colors') !!}" class="nav-link {{  Request::is('settings/mobile/colors*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-pencil"></i> @endif <p>{{trans('lang.mobile_colors')}} <span class="right badge badge-danger">New</span> </p>
                </a>
            </li>
        </ul>

    </li>
    <li class="nav-item has-treeview {{Request::is('settings*') && !Request::is('settings/mobile*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{Request::is('settings*') && !Request::is('settings/mobile*') ? 'active' : '' }}">
        @if($icons)
            <i class="nav-icon fa fa-cogs"></i>
        @endif
            <p>{{trans('lang.app_setting')}} <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{!! url('settings/app/globals') !!}" class="nav-link {{  Request::is('settings/app/globals*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-cog"></i> @endif <p>{{trans('lang.app_setting_globals')}}</p>
                </a>
            </li>

            <li class="nav-item has-treeview {{ Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-user-secret"></i>@endif
                    <p>
                        {{trans('lang.permission_menu')}}
                        <i class="right fa fa-angle-left"></i>
                    </p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/permissions') ? 'active' : '' }}" href="{!! route('permissions.index') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.permission_table')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/permissions/create') ? 'active' : '' }}" href="{!! route('permissions.create') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.permission_create')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/roles') ? 'active' : '' }}" href="{!! route('roles.index') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.role_table')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/roles/create') ? 'active' : '' }}" href="{!! route('roles.create') !!}">
                            @if($icons)<i class="nav-icon fa fa-circle-o"></i>@endif
                            <p>{{trans('lang.role_create')}}</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('settings/customFields*') ? 'active' : '' }}" href="{!! route('customFields.index') !!}">@if($icons)
                        <i class="nav-icon fa fa-list"></i>@endif<p>{{trans('lang.custom_field_plural')}}</p></a>
            </li>


            <li class="nav-item">
                <a href="{!! url('settings/app/localisation') !!}" class="nav-link {{  Request::is('settings/app/localisation*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-language"></i> @endif <p>{{trans('lang.app_setting_localisation')}}</p></a>
            </li>
            <li class="nav-item">
                <a href="{!! url('settings/translation/en') !!}" class="nav-link {{ Request::is('settings/translation*') ? 'active' : '' }}">
                    @if($icons) <i class="nav-icon fa fa-language"></i> @endif <p>{{trans('lang.app_setting_translation')}}</p></a>
            </li>
            @can('currencies.index')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('settings/currencies*') ? 'active' : '' }}" href="{!! route('currencies.index') !!}">@if($icons)<i class="nav-icon fa fa-dollar"></i>@endif<p>{{trans('lang.currency_plural')}}</p></a>
            </li>
            @endcan

            <li class="nav-item">
                <a href="{!! url('settings/payment/payment') !!}" class="nav-link {{  Request::is('settings/payment*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-credit-card"></i> @endif <p>{{trans('lang.app_setting_payment')}}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/app/social') !!}" class="nav-link {{  Request::is('settings/app/social*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-globe"></i> @endif <p>{{trans('lang.app_setting_social')}}</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{!! url('settings/app/notifications') !!}" class="nav-link {{  Request::is('settings/app/notifications*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-bell"></i> @endif <p>{{trans('lang.app_setting_notifications')}}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/mail/smtp') !!}" class="nav-link {{ Request::is('settings/mail*') ? 'active' : '' }}">
                    @if($icons)<i class="nav-icon fa fa-envelope"></i> @endif <p>{{trans('lang.app_setting_mail')}}</p>
                </a>
            </li>

        </ul>
    </li>
@endcan