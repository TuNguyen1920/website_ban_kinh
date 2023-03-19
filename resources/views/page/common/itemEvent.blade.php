<div class="size-202 m-lr-auto respon4">
    <!-- Block1 -->
    <div class="block1 wrap-pic-w">
        <img src="{{ !empty($event->e_banner) ? asset(pare_url_file($event->e_banner)) : asset('admin/dist/img/no-image.png') }}" alt="IMG-BANNER" style="width: 100% !important; height: 475px;">

        <a href="{{ $event->e_link }}"
           class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
            <div class="block1-txt-child1 flex-col-l">
                <span class="block1-name ltext-102 trans-04 p-b-8">
                    {{ $event->e_name }}
                </span>
                <span class="block1-info stext-102 trans-04">
                    {{ $event->e_sub_title }}
                </span>
            </div>

            <div class="block1-txt-child2 p-b-4 trans-05">
                <div class="block1-link stext-101 cl0 trans-09">
                    <a href="{{ $event->e_link }}">Mua ngay</a>
                </div>
            </div>
        </a>
    </div>
</div>
