
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Phim hot</span>
                     </div>
                  </div>
                  @foreach ($phimhot_sidebar as $key => $hot_sidebar )
                  <section class="tab-content">
                     <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                           <div class="item post-37176">
                              <a href="{{route('movie',$hot_sidebar->slug)}}" title="{{$hot_sidebar->title}}">
                                 <div class="item-link">
                                    @if(isset($hot_sidebar->image) && !empty($hot_sidebar->image))
                                        @if(preg_match("/^http/", $hot_sidebar->image))
                                            <img src="{{$hot_sidebar->image}}" class="lazy post-thumb" alt="{{$hot_sidebar->title}}" title="{{$hot_sidebar->title}}">
                                        @else
                                            <img src="{{ asset('public/upload/movie/'.$hot_sidebar->image) }}" class="lazy post-thumb" alt="{{$hot_sidebar->title}}" title="{{$hot_sidebar->title}}">
                                        @endif
                                    @else
                                        <img src="{{ asset('path_to_default_image.png') }}" class="lazy post-thumb" alt="default image" title="default image">
                                    @endif

                                    <span class="is_trailer">
                                        @if($hot_sidebar->resolution == 0)
                                            HD
                                        @elseif($hot_sidebar->resolution == 1)
                                            SD
                                        @elseif($hot_sidebar->resolution == 2)
                                            HDCam
                                        @elseif($hot_sidebar->resolution == 3)
                                            FullHD
                                        @endif
                                    </span>

                                 </div>
                                 <p class="title">{{$hot_sidebar->title}}</p>
                              </a>
                              <div class="viewsCount" style="color: #9d9d9d;">{{$hot_sidebar->view}}</div>
                              <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  @endforeach
                  <div class="clearfix"></div>
               </div>
            </aside>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Top Views</span>
                        <ul class="halim-popular-tab" role="tablist">
                           <!-- <li role="presentation" class="active">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="today">Day</a>
                           </li>
                           <li role="presentation">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="week">Week</a>
                           </li>
                           <li role="presentation">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="month">Month</a>
                           </li> -->
                           <!-- <li role="presentation">
                              <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                           </li> -->
                        </ul>
                     </div>
                  </div>
                  <section class="tab-content">
                     <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                        @foreach ($topview as $key => $tview )
                            <div class="item post-37176">
                                <a href="{{route('movie',$tview->slug)}}" title="{{$tview->title}}">
                                    <div class="item-link">
                                    @if(isset($tview->image) && !empty($tview->image))
                                        @if(preg_match("/^http/", $tview->image))
                                            <img src="{{$tview->image}}" class="lazy post-thumb" alt="{{$tview->title}}" title="{{$tview->title}}">
                                        @else
                                            <img src="{{ asset('public/upload/movie/'.$tview->image) }}" class="lazy post-thumb" alt="{{$tview->title}}" title="{{$tview->title}}">
                                        @endif
                                    @else
                                        <img src="{{ asset('path_to_default_image.png') }}" class="lazy post-thumb" alt="default image" title="default image">
                                    @endif
                                    <span class="is_trailer">
                                        @if($tview->resolution == 0)
                                            HD
                                        @elseif($tview->resolution == 1)
                                                SD
                                        @elseif($tview->resolution == 2)
                                                HDCam
                                        @elseif($tview->resolution == 3)
                                                FullHD
                                        @endif
                                        </span>
                                    </div>
                                    <p class="title">{{$tview->title}}</p>
                                </a>
                                <div class="viewsCount" style="color: #9d9d9d;">Lượt xem: {{$tview->view}}</div>
                                <div style="float: left;">
                                    <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                    </span>
                                </div>
                            </div>
                        @endforeach


                        </div>
                     </div>
                  </section>
                  <div class="clearfix"></div>
               </div>
            </aside>

