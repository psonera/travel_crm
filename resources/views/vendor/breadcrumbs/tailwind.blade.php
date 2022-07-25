@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="leading-normal text-size-xl">
                        <a href="{{ $breadcrumb->url }}" class="opacity-50 text-slate-700">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="text-size-xl capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless($loop->last)
                    <li class="leading-normal text-size-xl px-2">
                        /
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
