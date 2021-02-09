@extends('layouts.app')

@include('partials.meta_dynamic')

@section('content')

    <div class="container-fluid">
        <article>
            <div class="jumbotron">

                <div class="col-md-12">
                    @if($blog->featured_img)
                        <img src="/images/featured_imgs/{{ $blog->featured_img ? : '' }}" alt="{{ str_limit
                        ($blog->title, 50)
                        }}" class="img-fluid">
                    @endif
                </div>

                <div class="col-md-12">
                    <h1>{{ $blog->title }}</h1>
                </div>

                @if(Auth::user()->role_id === 1 || (Auth::user()->role_id === 2 && Auth::user()->id === $blog->user_id))
                    <div class="col-md-12">
                        <div class="btn-group">
                            <a href="{{ route('blogs.edit', $blog->id) }}"
                               class="btn btn-primary btn-sm btn-margin-right">Edit </a>

                            <form action="{{ route('blogs.delete', $blog->id) }}" method="POST">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-12">
                {!! $blog->body !!}
                @if($blog->user)
                    Author: <a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a> |
                    Posted: {{
                    $blog->created_at->diffForHumans
                    () }}
                @endif
                <br>
                <strong>Categories: </strong>
                @foreach($blog->category as $category)
                    <span><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></span>
                @endforeach
            </div>
        </article>

        <hr>
        <div id="disqus_thread"></div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://http-backend-demo-test.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

    </div>
@endsection