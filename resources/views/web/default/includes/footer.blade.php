@php
    $socials = getSocials();
    if (!empty($socials) and count($socials)) {
        $socials = collect($socials)->sortBy('order')->toArray();
    }

    $footerColumns = getFooterColumns();
@endphp

<footer class="footer position-relative user-select-none" style="    padding: 31px;
    background: #0000000D;
    color: #000;">
    @php
        $columns = ['first_column','second_column','third_column','forth_column'];
    @endphp

    <div class="container">
        <div class="row">

            @foreach($columns as $column)
                <div class="col-6 col-md-3">
                    @if(!empty($footerColumns[$column]))
                        @if(!empty($footerColumns[$column]['title']))
                            <span class="header d-block font-weight-bold">{{ $footerColumns[$column]['title'] }}</span>
                        @endif

                        @if(!empty($footerColumns[$column]['value']))
                            <div class="mt-20">
                                {!! $footerColumns[$column]['value'] !!}
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</footer>
