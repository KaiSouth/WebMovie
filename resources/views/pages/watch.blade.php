@extends('layout')
@section('content')
<div class="row container" id="wrapper">
         <div class="halim-panel-filter">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-6">
                     <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('category',$movie->category->slug)}}">{{$movie->category->title}}</a> » <span><a href="{{route('genre',$movie->genre->slug)}}">{{$movie->genre->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
                  </div>
               </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
               <div class="ajax"></div>
            </div>
         </div>
         <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
               <div class="clearfix wrap-content">
               <iframe style="height:450px;width:100%;margin-top:14px;border:0px" frameborder="0"  scrolling="0" allowfullscreen src="{{$episode->linkphim}}" ></iframe>
                  <div class="collapse" id="moretool">
                     <ul class="nav nav-pills x-nav-justified">
                        <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                        <div class="fb-save" data-uri="" data-size="small"></div>
                     </ul>
                  </div>

                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="title-block">
                     <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                           <div class="halim-pulse-ring"></div>
                        </div>
                     </a>
                     <div class="title-wrapper-xem full">
                        <h5 class="entry-title"><a href="" title="{{$movie->title}}" class="tl">{{$movie->title}}</a></h5>
                     </div>
                  </div>
                  <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                     <article id="post-37976" class="item-content post-37976"></article>
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-center">
                     <div id="halim-ajax-list-server"></div>
                  </div>
                  <div id="halim-list-server">
                     <ul class="nav nav-tabs" role="tablist">
                        @if($movie->resolution == 0)
                           <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>
                           HD</a></li>
                           @elseif($movie->resolution == 1)
                           <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>
                           SD</a></li>
                           @elseif($movie->resolution == 2)
                           <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>
                           HDCam</a></li>
                           @elseif($movie->resolution == 3)
                           <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>
                           FullHD</a></li>
                        @endif
                     </ul>

                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                           <div class="halim-server">
                              <ul class="halim-list-eps">
                                @foreach ($movie->episode as $key => $sotap)
                                    <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$sotap->episode)}}">
                                    <li class="halim-episode"><span class="halim-btn halim-btn-2 {{$tapphim==$sotap->episode ? 'active' : ''}} halim-info-1-1 box-shadow" data-post-id="37976" data-server="1" data-episode="{{$sotap->episode}}" data-position="first" data-embed="0" data-title="Xem phim {{$movie->title}} - Tập{{$sotap->episode}} " data-h1="Phim {{$movie->title}} - Tập{{$sotap->episode}} ">{{$sotap->episode}}</span></li>
                                    </a>
                                @endforeach
                             </ul>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="clearfix"></div>
                  <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                            @if($movie->tags!=NULL)
                                @php
                                    $tags = array();
                                    $tags = explode(',',$movie->tags);
                                @endphp
                                @foreach($tags as $key => $tag)
                                    <a href="{{url('tag/'.$tag)}}">{{$tag}}</a>
                                @endforeach
                                @else
                                    {{$movie->title}}
                            @endif

                           </article>
                        </div>
                     </div>
            </section>

            <section class="related-movies">
            <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
            <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
            @foreach ($related as $key => $mov)
                        <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{route('movie',$mov->slug)}}"" title="{{$mov->title}}">
                              <figure>
                                    @if(isset($mov->image) && !empty($mov->image))
                                        @if(preg_match("/^http/", $mov->image))
                                            <img class="lazy img-responsive" src="{{$mov->image}}" alt="{{$mov->title}}" title="{{$mov->title}}">
                                        @else
                                            <img class="lazy img-responsive" src="{{ asset('public/upload/movie/'.$mov->image) }}" alt="{{$mov->title}}" title="{{$mov->title}}">
                                        @endif
                                    @else
                                        <img class="lazy img-responsive" src="{{ asset('path_to_default_image.png') }}" alt="Default Image" title="Default Image">
                                    @endif
                                </figure>                              <span class="status">
                                    @if($mov->resolution == 0)
                                            HD
                                    @elseif($mov->resolution == 1)
                                            SD
                                    @elseif($mov->resolution == 2)
                                            HDCam
                                    @elseif($mov->resolution == 3)
                                            FullHD
                                    @endif
                              </span>
                              <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if($mov->phude == 0)
                                        Vietsub
                                    @elseif($mov->phude == 1)
                                        Thuyết minh
                                    @endif
                              </span>
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$mov->title}}</p>
                                    <p class="original_title">{{$mov->title}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                @endforeach

            </div>
            <script>
               jQuery(document).ready(function($) {
               var owl = $('#halim_related_movies-2');
               owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
            </script>
            </div>
            </section>
         </main>
        <!-- <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-9" class="widget halim_tab_popular_videos-widget-3">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Top Views</span>
                     </div>
                  </div>

                  <section class="tab-content">
                     <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                         @foreach($phimhot as $key => $hot)
                          <article class="thumb grid-item post-38498" style="margin-bottom: 15px">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{ route('movie',$hot->slug) }}" title="{{$hot->title}}">
                                 <img class="lazy img-responsive" src="{{asset('public/upload/movie/'.$hot->image)}}" alt="{{asset('public/upload/movie/'.$hot->image)}}" title="{{$hot->title}}">
                                 <span class="status">
                                    @if($hot->resolution == 0)
                                            HD
                                    @elseif($hot->resolution == 1)
                                            SD
                                    @elseif($hot->resolution == 2)
                                            HDCam
                                    @elseif($hot->resolution == 3)
                                            FullHD
                                    @endif
                                 </span>
                                 <span class="episode" style="margin-top:0px"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if($hot->phude == 0)
                                        Vietsub
                                    @elseif($hot->phude == 1)
                                        Thuyết minh
                                    @endif
                                </span>
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$hot->slug}}</p>
                                       <p class="original_title">{{$hot->title}}</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                    @endforeach


                        </div>
                     </div>
                  </section>
                  <div class="clearfix"></div>
               </div>
            </aside> -->
            @include('pages.include.sidebar')
      </div>
@endsection
