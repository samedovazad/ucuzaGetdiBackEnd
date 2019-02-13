<style>
    button, input, select, textarea {
        font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    }

    .form-item .label {
        color: #333;
        vertical-align: top;
        font-weight: 600;
        display: block;
        padding: 15px 21px 9px 0px;
        margin-right: 5px;
        font-size: 15px;
        white-space: normal;
    }

    .form-item {
        margin-bottom: 23px;
        position: relative;
    }

    .form-item.required > .label:after {
        content: "*";
        color: #1abc9c;
        display: inline-block;
        width: 8px;
        font-size: 14px;
        font-weight: 400;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        margin-right: -8px;
    }

    .pswp{
        width : 99%;
    }
</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel17">Auction ətraflı</h4>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <div class="row" id="errors">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height: auto;">
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card" style="height: 300px;width: 400px;margin-left: 25%">
                                                    <div class="card-body">
                                                        <div id="carousel-example-generic" class="carousel slide"
                                                             data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                @foreach($auctions->images as $key => $image)
                                                                    <li data-target="#carousel-example-generic"
                                                                        data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                                                @endforeach
                                                            </ol>
                                                            <div class="carousel-inner" role="listbox">
                                                                @foreach($auctions->images as $key => $image)
                                                                    @php
                                                                        $sizes = getimagesize($image->getRealImagePath());
                                                                        $images[] = [
                                                                             'src' => $image->getRealImagePath(),
                                                                             'w' => $sizes[0],
                                                                             'h' => $sizes[1],
                                                                             'url' => $image->getRealImagePath()
                                                                          ];
                                                                    @endphp
                                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                        <img src="{{ $image->getRealImagePath() }}"
                                                                             alt="First slide"
                                                                             onclick="openImage({{ $key }})"
                                                                             style="height: 300px;">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <a class="left carousel-control"
                                                               href="#carousel-example-generic" role="button"
                                                               data-slide="prev">
                                                                <span class="icon-prev" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="right carousel-control"
                                                               href="#carousel-example-generic" role="button"
                                                               data-slide="next">
                                                                <span class="icon-next" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group form-item required">
                                                    <label class="label" for="category">Əlavə edən user</label>
                                                    <strong>{{ $auctions->user_name->name }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-item required">
                                                    <label class="label" for="sub_category">Başlıq</label>
                                                    <strong>{{ $auctions->title }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-item required">
                                                    <label class="label" for="sub_sub_category">Təsvir</label>
                                                    <strong>{{ $auctions->description ?? '-' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group form-item required">
                                                    <label class="label" for="category">Kateqoriya</label>
                                                    <strong>{{ $auctions->category->name }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-item required">
                                                    <label class="label" for="sub_category">Alt Kateqoriya</label>
                                                    <strong>{{ $auctions->sub_category->name }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-item required">
                                                    <label class="label" for="sub_sub_category">Alt Kateqoriya</label>
                                                    <strong>{{ $auctions->sub_sub_category->name ?? '-' }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="start_price">Başlanma qiyməti</label>
                                                    <strong>{{ $auctions->start_price ?? '-' }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="reserve_price">Minimal satiş
                                                        qiyməti</label>
                                                    <strong>{{ $auctions->reserve_price_currency() }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="addPrice">Artim qiyməti</label>
                                                    <strong>{{ $auctions->increment_price }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="city">Ölkə</label>
                                                    <strong>{{ $auctions->countries->name  }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="city">Şəhər</label>
                                                    <strong>{{ $auctions->city->name  }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="endDay">Əlavə olunma tarixi</label>
                                                    <strong>{{ \Carbon\Carbon::parse($auctions->created_at)->format('Y-m-d h:i')  }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="endDay">Bitmə tarixi</label>
                                                    <strong>{{ \Carbon\Carbon::parse($auctions->end_date)->format('Y-m-d h:i') }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-item required">
                                                    <label class="label" for="endDay">Status</label>
                                                    <strong>{{ $auctions->auction_status->name }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-t-10 sm-m-t-10">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
<!-- Root element of PhotoSwipe. Must have class pswp. -->

<script>
    // build items array
    items = {!! json_encode($images) !!};

    function openImage(index) {
        let pswpElement = document.querySelectorAll('.pswp')[0];

        // define options (if needed)
        let options = {
            // optionName: 'option value'
            // for example:
            shareEl: true,
            index: index,
            shareButtons: [
                {
                    id: 'facebook',
                    label: 'Facebook\'da paylaş',
                    url: 'https://www.facebook.com/sharer/sharer.php?u="' + items[index].url + '"'
                },
                {id: 'download', label: 'Şəkili yüklə', url: items[index].url, download: true}
            ],
        };

        // Initializes and opens PhotoSwipe
        let gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    }
</script>