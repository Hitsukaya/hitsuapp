<x-mail::message>

# {{ $content['title'] }}  - {{ config('app.name') }}


@if (!empty($content['cover_image']))
<img src="{{ $content['cover_image'] }}" alt="{{ $content['title'] }}" style="width:100%; max-height: 200px; object-fit: cover; border-radius: 10px;" />
@endif

@isset($content['author'])
> *By {{ $content['author'] }} on {{ $content['published_at'] }}*
@endisset

{{ $content['body'] }}

@isset($content['url'])
@component('mail::button', ['url' => $content['url']])
Read the full post
@endcomponent
@endisset

</x-mail::message>
