<main class="py-4" style="min-height: 88vh">
    <div class="container">
        <section class="news-section news mb-2 row">
            <h2 class="news__header order-2 order-sm-0 col-12">News</h2>

            <div class="news-section__news new col-sm-8 col-lg-10 order-2 order-sm-0">
                @forelse($news as $new)
                    <div class="new__item d-flex">
                        <div class="new__heading d-flex flex-column p-3 w-100 border rounded mb-4 shadow-sm">
                            <strong class="mb-2 text-primary">new #{{ $new->id }}</strong>

                            <h3 class="new__name mb-0">{{ $new->name }}</h3>

                            <div class="new__created-at mb-1 text-muted">{{ $new->created_at->toFormattedDateString() }}</div>

                            <p class="new__preview card-text flex-grow-1 text-justify">  {{ str_limit($new->text, $limit = 200, $end = '...') }} </p>

                            @if($new->tags->isNotEmpty())
                                <div class="post__tags mb-2">
                                    @foreach($new->tags as $tag)
                                        <span class="badge badge-info text-white">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('news.show', $new) }}" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Read</a>

                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('news.edit', $new) }}" class="btn btn-outline-secondary mx-1" style="width: 80px; font-size: 0.7rem">Edit</a>

                                    <form method="post" action="{{ route('news.destroy', $new) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-outline-secondary" style="width: 80px; font-size: 0.7rem">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="no-news">No available news yet</p>
                @endforelse
            </div>

            @include('layouts.aside-tags')
        </section>
    </div>
</main>
