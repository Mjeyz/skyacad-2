<div class="webinar-card">
    <figure>
        <div class="image-box">
            <img src="{{ $webinar->getImage() }}" class="img-cover" alt="{{ $webinar->title }}">
            @if($webinar->type == 'webinar')
            @endif
        </div>

        <figcaption class="webinar-card-body">
            @if(!empty($webinar->category))
                <span class="d-block font-14 mt-10"><a href="{{ $webinar->category->getUrl() }}" target="_blank" class="home-course-category">{{ $webinar->category->title }}</a></span>
            @endif

            <a href="{{ $webinar->getUrl() }}">
                <h3 class="mt-10 webinar-title home-course-title">{{ $webinar->title }}</h3>
            </a>
            
            <div class="webinar-price-box home-course-price" style="margin-top: -5px">
                @if(!empty($webinar->price) and $webinar->price > 0)
                    @if($webinar->bestTicket() < $webinar->price)
                        <span class="real">{{ $currency }}{{ number_format($webinar->bestTicket(),2) }}</span>
                        <span class="off ml-10">{{ $currency }}{{ number_format($webinar->price,2) }}</span>
                    @else
                        <span class="real">{{ $currency }}{{ number_format($webinar->price,2) }}</span>
                    @endif
                @else
                    <span class="real font-14">{{ trans('public.free') }}</span>
                @endif
            </div>
            <p class="pt-10"> {{trans('home.course_description')}} </p>
            <a href="{{ $webinar->getUrl() }}" class="btn btn-primary course-button mt-20">Enroll now</a>
        </figcaption>
    </figure>
</div>
