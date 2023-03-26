<div class="col-sm-6 col-md-4 p-b-40">
    <div class="blog-item">
        <div class="hov-img0">
            <a href="{{ route('page.news.detail', ['id' => $article->id, 'slug' => $article->a_slug]) }}">
                <img src="{{ !empty($article->a_avatar) ? asset(pare_url_file($article->a_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="{{ $article->a_name }}">
            </a>
        </div>
        <div class="p-t-15">
            <div class="stext-107 flex-w p-b-14">
                @if (isset($article->user))
                    <span class="m-r-3">
                                                    <span class="cl4">
                                                        Đăng :
                                                    </span>

                                                    <span class="cl5">
                                                        {{ isset($article->user) ? $article->user->name : '' }}
                                                    </span>
                                                </span>
                @endif
                <span>
                                                    <span class="cl4">
                                                        |
                                                    </span>

                                                    <span class="cl5">
                                                        {{ date('Y-m-d', strtotime($article->created_at)) }}
                                                    </span>
                                                </span>
            </div>

            <h4 class="p-b-12">
                <a href="{{ route('page.news.detail', ['id' => $article->id, 'slug' => $article->a_slug]) }}" class="mtext-101 cl2 hov-cl1 trans-04" title="">
                    {{ $article->a_name }}
                </a>
            </h4>

            <p class="stext-108 cl6">
                {!!  $article->a_description !!}
            </p>
        </div>
    </div>
</div>