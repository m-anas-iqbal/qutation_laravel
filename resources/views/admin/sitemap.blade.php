<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{--country--}}
    @foreach ($datas as $data)
        <url>
            <loc>{{ url('/') }}/country-states/{{ $data->country }}</loc>
            <lastmod>{{ $data->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach

    {{--state--}}
    @foreach ($datas as $data)
        <url>
            <loc>{{ url('/') }}/state-counties/{{ $data->country }}/{{ $data->state }}</loc>
            <lastmod>{{ $data->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach

    {{--county--}}
    @foreach ($datas as $data)
        <url>
            <loc>{{ url('/') }}/county-cities/{{ $data->country }}/{{ $data->state }}/{{ $data->county }}</loc>
            <lastmod>{{ $data->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach

    {{--city--}}
    @foreach ($datas as $data)
        <url>
            <loc>{{ url('/') }}/city-towns/{{ $data->country }}/{{ $data->state }}/{{ $data->county }}/{{ $data->city }}</loc>
            <lastmod>{{ $data->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach


    {{--towns--}}
    @foreach ($datas as $data)
        <url>
            <loc>{{ url('/') }}/traders/{{ $data->country }}/{{ $data->state }}/{{ $data->county }}/{{ $data->name }}</loc>
            <lastmod>{{ $data->created_at->tz('UTC')->toAtomString() }}</lastmod>
        </url>
    @endforeach


</urlset>