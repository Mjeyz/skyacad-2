<!-- Modal -->
<div class="d-none" id="webinarTicketModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">{{ trans('public.add_ticket') }}</h3>
    <form action="/panel/tickets/store" method="post">
        <input type="hidden" name="webinar_id" value="{{ !empty($webinar) ? $webinar->id :'' }}">

        <div class="form-group">
            <label class="input-label">{{ trans('public.title') }}</label>
            <input type="text" name="title" class="form-control" placeholder="{{ trans('forms.maximum_64_characters') }}"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.sub_title') }}</label>
            <input type="text" name="sub_title" class="form-control" placeholder="{{ trans('forms.maximum_128_characters') }}"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.date') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="dateRangeLabel">
                        <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                    </span>
                </div>
                <input type="text" name="date" class="form-control date-range-picker" aria-describedby="dateRangeLabel"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.discount') }} <span class="braces">(%)</span></label>
            <input type="text" name="discount" class="form-control" placeholder="10"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.capacity') }}</label>
            <input type="text" name="capacity" class="form-control" placeholder="{{ trans('forms.empty_means_unlimited') }}"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveTicket" class="btn btn-sm btn-primary">{{ trans('public.save') }}</button>
            <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">{{ trans('public.close') }}</button>
        </div>
    </form>
</div>
