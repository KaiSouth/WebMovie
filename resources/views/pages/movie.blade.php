@extends('layout')
@section('content')

<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs">
                            <span>
                                <span>
                                    <a href="{{route('category',$movie->category->slug)}}">{{$movie->category->title}}</a> » <span><a href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span>
                                </span>
                            </span>
                            </div>
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

                     <div class="halim-movie-wrapper">
                        <div class="title-block">
                           <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                              <div class="halim-pulse-ring"></div>
                           </div>
                           <div class="title-wrapper" style="font-weight: bold;">
                              Bookmark
                           </div>
                        </div>
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                           @if(isset($movie->image) && !empty($movie->image))
                                @if(preg_match("/^http/", $movie->image))
                                    <img class="movie-thumb" src="{{$movie->image}}" alt="{{$movie->title}}">
                                @else
                                    <img class="movie-thumb" src="{{ asset('public/upload/movie/'.$movie->image) }}" alt="{{$movie->title}}">
                                @endif
                            @else
                                <img class="movie-thumb" src="{{ asset('path_to_default_image.png') }}" alt="{{$movie->title}}">
                            @endif
                              <div class="bwa-content">
                                 <div class="loader"></div>
                                 <a href="{{route('watch',$movie->slug.'/tap-'.'1')}}" class="bwac-btn">
                                 <i class="fa fa-play"></i>
                                 </a>
                              </div>
                           </div>
                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                              <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->title}}</h2>
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                    @if($movie->resolution == 0)
                                            HD
                                    @elseif($movie->resolution == 1)
                                            SD
                                    @elseif($movie->resolution == 2)
                                            HDCam
                                    @elseif($movie->resolution == 3)
                                            FullHD
                                    @endif
                                </span>
                                <span class="episode">
                                    @if($movie->phude == 0)
                                        Vietsub
                                    @elseif($movie->phude == 1)
                                        Thuyết minh
                                    @endif
                                </span>
                                </li>
                                 <li class="list-info-group-item"><span>Danh mục phim</span> : <a href="{{route('category',$movie->category->slug)}}" rel="category tag">{{$movie->category->title}}</a>
                                 <li class="list-info-group-item"><span>Thể loại</span> : <a href="{{route('genre',$movie->genre->slug)}}" rel="category tag">{{$movie->genre->title}}</a>
                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',$movie->country->slug)}}" rel="tag">{{$movie->country->title}}</a></li>
                                 <li class="list-info-group-item"><span>Năm</span> : <a href="{{url('nam/'.$movie->year)}}" rel="tag">{{$movie->year}}</a></li>
                                 <li class="list-info-group-item"><span>Số tập</span> : <a href="#" rel="tag">{{$movie->sotap}}</a></li>
                                 <li class="list-info-group-item"><span>Thời lượng</span> : <a href="#" rel="tag">{{$movie->thoiluong}}</a></li>
                                </ul>
                              <div class="movie-trailer hidden"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="halim_trailer"></div>
                     <div class="clearfix"></div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              <p>{{$movie->description}}</p>
                           </article>
                        </div>
                     </div>

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


                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        @php
                           $current_url = Request::url();
                        @endphp
                           <div class="video-item halim-entry-box">
                              <article id="post-38424" class="item-content">
                                 <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10"></div>
                              </article>
                           </div>


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
                            </figure>
                              <span class="status">
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
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
         </div>
@endsection
