@switch($order->status)
    @case(App\Models\OrderStatus::PENDING_STATUS)
        <label class="badge badge-info">{{ __('Pending') }}</label>
        <i class="mdi mdi-arrow-right-bold"></i>
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::IN_PROGRES_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-wrench"></i> {{ __('In progres') }}</a>

        @break
    @case(App\Models\OrderStatus::IN_PROGRES_STATUS)
        <label class="badge badge-warning">{{ __('In progres') }}</label>
        <i class="mdi mdi-arrow-right-bold"></i>
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::SUBMITED_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-send"></i> {{ __('Submited') }}</a>

        @break
    @case(App\Models\OrderStatus::SUBMITED_STATUS)
    @case(App\Models\OrderStatus::RESUBMITED_STATUS)
        <label class="badge badge-success">{{ __('Submited') }}</label>
        <i class="mdi mdi-arrow-right-bold"></i>
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::RECEIVED_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-call-received"></i> {{ __('Received') }}</a>

        @break
    @case(App\Models\OrderStatus::RECEIVED_STATUS)
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::REJECTED_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-keyboard-return"></i> {{ __('Rejected') }}</a>
        <i class="mdi mdi-arrow-left-bold"></i>
        <label class="badge badge-success">{{ __('Received') }}</label>
        <i class="mdi mdi-arrow-right-bold"></i>
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::COMPLETED_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-checkbox-marked-outline"></i> {{ __('Completed') }}</a>

        @break
    @case(App\Models\OrderStatus::REJECTED_STATUS)
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::REFUSAL_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-close-box-outline"></i> {{ __('Refusal') }}</a>
        <i class="mdi mdi-arrow-left-bold"></i>
        <label class="badge badge-warning">{{ __('Rejected') }}</label>
        <i class="mdi mdi-arrow-right-bold"></i>
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::REPIRED_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-wrench"></i> {{ __('Repired') }}</a>

        @break
    @case(App\Models\OrderStatus::REPIRED_STATUS)
        <label class="badge badge-success">{{ __('Repired') }}</label>
        <i class="mdi mdi-arrow-right-bold"></i>
        <a href="{{ route('cms.orders.change-status', [$order->id, App\Models\OrderStatus::RESUBMITED_STATUS]) }}"
            title="{{ __('Change status') }}"
            class="btn btn-primary btn-icon-text"
        ><i class="mdi mdi-send"></i> {{ __('Re submited') }}</a>

        @break
    @case(App\Models\OrderStatus::COMPLETED_STATUS)
        <label class="badge badge-success">{{ __('Completed') }}</label>

        @break
    @case(App\Models\OrderStatus::REFUSAL_STATUS)
        <label class="badge badge-danger">{{ __('Refusal') }}</label>

        @break

        {{-- mdi mdi-twitter-retweet --}}
    @default
@endswitch
