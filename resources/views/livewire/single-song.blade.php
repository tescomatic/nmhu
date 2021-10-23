<div>
    @if ($song == '')
        <div>
            <h2>The song you are looking for could not be found</h2>
            <h4>See more ineteresting songs below</h4>
            <div>
                @livewire('inc.songlist')
            </div>
        </div>
    @else
        <div class="card hadow" x-init="init({{ json_encode($song) }},true,true,true)"
            x-data="{playing:'a',playingbtn:'',played:0,paused:'',hov:'a'}">
            <div class="row ">
                <div class="col-12 col-md-5 col-lg-4 p-2 pt-md-3 pb-md-3">
                    <div class="img-thumbss border border-0 rounded shadow-lg bg ml-auto mr-auto ml-md-3 mr-md-1">

                        <h1 id="l" class="text-center mt-5 text-white display-1">
                            <br>
                            <i class="fa fa-spin fa-spinner"></i>
                        </h1>
                        <figure>

                            <img src="{{ Storage::disk('s3')->url($song['art']) }}"
                                class="img  rounded d-none shadow-lg" alt="" id="i" style="width: 100%" onload="
                                if(document.querySelector('#l')){
                                    document.querySelector('#l').classList.toggle('d-none');
                        document.querySelector('#i' ).classList.toggle('d-none')
                                }
                                ">


                        </figure>

                    </div>

                </div>
                <div class="col-md-6 col-lg-8">
                    <div class="mt-md-5 text-md-left ml-4 ml-md-0 mt-3">
                        <h4>{{ $song->artist }}</h4>
                        <h5 class="font-weight-bold"><a href="/">{{ $song->title }}</a></h5>
                        @if ($song->feature)
                            <h5 class=""><span class="sidenav-icon font-weight-bold">Feat</span>. {{ $song->feature }}
                            </h5>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between mt-4 pl-3 pr-3 pl-md-0">
                        @foreach ($icons as $icon)
                            <div class=" pointer">

                                <img src="{{ asset('images/' . $icon) }}" class="img img-responsive " alt=""
                                    width="25">
                                {{-- <span
                                class=" font-weight-bold">10{{ $loop->index }}</span> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row no-gutters mt-5 mb-4 mt-md-1 ">
                        <div class="col-12  loadings" id="">
                            <div class="w-75 ml-auto mr-auto">
                                <img src="{{ asset('images/wave.gif') }}" alt="" height="70">
                                <span>Loading song</span>
                            </div>
                        </div>
                        <div class="col-2 col-md-1 w-100 ">
                            <div class="w " X-cloak>

                                <button class="btn btn-secondary ml-2 shadow-lg loadings d-none"
                                    id="playbtn{{ $song['songId'] }}"
                                    :class="{'btn-play':played ==1,'btn-play-white':played !=1}"
                                    x-on:click="(played !=1) ? played=1: played=0"
                                    onclick="player_wave({{ $song['songId'] }},'list')">
                                    <span id="list-icon{{ $song['songId'] }}"
                                        :class="{'fa fa-play' : played !=1, 'fa fa-pause':played ==1}">
                                    </span>

                                </button>

                            </div>
                        </div>
                        <div class="col-10 col-md-11 w-100 ">
                            <div id="waveforms{{ $song['songId'] }}" class="w-100"></div>

                            <div class="loadings font-weight-bold d-none pr-2">
                                <span class="float-left" id="cd{{ $song['songId'] }}"></span>
                                <span class="float-right" id="td{{ $song['songId'] }}"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="ml-auto mr-auto w-75">
        <hr>
    </div> --}}

        <div class="card p-2 mt-2">
            <div class="row ">
                <div class="col-3 col-md-2 col-lg-2 col-xl-1 ">
                    <div style="width: 70px;height:70px;overflow: hidden"
                        class=" border border-0 rounded-circle shadow-lg bg ml-auto mr-auto ml-md-1 mr-md-1">
                        <h1 id="ll" class="text-center mt-4 text-white">
                            <i class="fa fa-spin fa-spinner"></i>
                        </h1>
                        <figure>

                            {{--  --}}
                            <img src="{{ Storage::disk('s3')->url($song['avatar']) }} "
                                class="img  rounded d-none shadow-lg" alt="" id="ii" style="width: 100%" onload="
                                if(document.querySelector('#ll')){
                                    document.querySelector('#ll').classList.toggle('d-none');
                        document.querySelector('#ii' ).classList.toggle('d-none')
                                }
                                ">


                        </figure>

                    </div>
                    <div style="width: 80px;" class="ml-auto mr-auto ml-md-0 mt-2">
                        <a href="" class="p-0 pl-2 pr-2 btn site-bg-orange text-white btn-sm mt-1">See profile</a>

                    </div>
                </div>
                <div class="col-6 col-md-7 mt-2" style="line-height: 10px">
                    <div class="ml-xl-2">
                        <h5 class="font-weight-bold">{{ $song->artist }} <span
                                class="fa fa-check-circle site-text-orange"></span></h5>
                        <p><strong>Produced by:</strong> <span>{{ $song->producer }} </span></p>
                        <p><strong>Released:</strong> <span>{{ date('M d, yy', strtotime($song->release_date)) }}
                            </span>
                        </p>
                        <p><strong>Genre:</strong> <span>{{ $song->genre }}</span></p>
                    </div>
                </div>
                <div class="col-3">
                    <h3>
                        <a href=""
                            class="btn btn-outline-warning rounded-pill font-weight-bold pl-4 pr-4 pl-md-5 pr-md-5 site-text-orange .site-border-orange">Follow</a>
                    </h3>
                    {{-- <h6 class="ml-md-5 ml-4">1,200</h6> --}}
                </div>
            </div>
        </div>
        {{-- Insight --}}
        <div class="card mt-2 pb-3">
            <h3 class="mt-2 ml-2">Turn Up</h3>
            <div class="row no-gutters">
                <div class="col-6 col-md-3  p-1 mb-2 ">
                    <div class=" card">
                        <img src="{{ asset('images/location.svg') }}" class="img d-block  rounded mr-auto ml-auto"
                            alt="" width="40">
                        <div class="text-center">
                            <h3 class="font-weight-bold mt-1">2.9K</h3>
                            <h6>Plays</h6>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-1 mb-2">
                    <div class="card">
                        <img src="{{ asset('images/download.svg') }}"
                            class="img d-block  rounded mr-auto ml-auto mt-1" alt="" width="40">
                        <div class="text-center">
                            <h3 class="font-weight-bold mt-1">2.9K</h3>
                            <h6>Downloads</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card">
                        <img src="{{ asset('images/heart.svg') }}" class="img d-block  rounded mr-auto ml-auto mt-1"
                            alt="" width="40">
                        <div class="text-center">
                            <h3 class="font-weight-bold mt-1">2.9K</h3>
                            <h6>Likes</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card">
                        <img src="{{ asset('images/shares.svg') }}" class="img d-block  rounded mr-auto ml-auto mt-1"
                            alt="" width="40">
                        <div class="text-center">
                            <h3 class="font-weight-bold mt-1">2.9K</h3>
                            <h6>Shares</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- Insight ends --}}
        <div class="card p-2 mt-2">
            <div>
                <div class="float-left w-50">
                    <h4 class="font-weight-bold">200 Comments</h4>
                </div>
                <div class="float-right w-50 text-right">200 Comments</div>
            </div>
            <div class="mt-3 row mb-2 no-gutters">
                <div class="col-1 col-md-1 mt-3">
                    <h1><span class="fa fa-user-circle"></span></h1>
                </div>
                <div class="col-8 col-md-8  mr-md-3">
                    <textarea rows="2" class="form-control rounded-pill p-2"></textarea>
                </div>
                <div class="col-3 col-md-2 mt-3">
                    <button class="btn rounded-pill site-bg-orange text-white ml-3  pl-md-4 pr-md-4">Comment</button>
                </div>

            </div>
            <hr>
            {{-- comment starts here --}}
            <div x-data="{reply:'=',flag:'-'}">
                @foreach ([1, 1, 1, 1] as $item)


                    <div class="mt-3 row mb-1 no-gutters pl-3">
                        <div class="col-1 col-md-1 ">
                            <h1><span class="fa fa-user-circle"></span></h1>
                        </div>
                        <div class="col-10 col-md-9  mr-md-3 pl-2 pl-md-0">
                            <h6 class="site-text-orange font-weight-bold">Sojay</h6>
                            <p class="lead"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate ut
                                porro
                                tenetur. Sapiente
                                animi corrupti tenetur exercitationem a aut illum porro nobis corporis aspernatur,
                                dolores
                                ab
                                accusantium, sint nemo saepe.
                            </p>
                            <div class="row no-gutters ">
                                <div class="col-4  pointer">
                                    <span class="fa fa-thumbs-up"></span>
                                    <span>Like</span>
                                    <span class="ml-1">200</span>
                                </div>

                                <div class="col-4  pointer"
                                    x-on:click="reply=={{ $loop->index }} ? reply='=' : reply={{ $loop->index }}">
                                    <span class="font-weight-bold ">
                                    </span>

                                    <span class="fa fa-reply mr-1"></span>
                                    <span>Reply</span>
                                    <span>50</span>


                                </div>
                                <div class="col-4">
                                    <span class="fa fa-history mt-1 font-weight-bold ml-1"></span>
                                    <span class="">2 minutes ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 col-md-1 mt-1 text-center text-md-right  pointer">
                            <div class="card shadow-lg text-left pl-3 pr-3 p-4"
                                x-show.transition.scale.75="flag=={{ $loop->index }}" X-on:click.away="flag='-'"
                                style="position: absolute;z-index:2;right:1;width:190px;margin-top:-30px">
                                <h6 class="font-weight-bold site-text-orange">
                                    <span class="fa fa-flag"></span> Report this comment
                                </h6>
                            </div>
                            <h4> <i class="fas fa-ellipsis-v" x-on:click="flag={{ $loop->index }}"></i></h4>
                        </div>
                        <div class="col-12" x-show="reply=={{ $loop->index }}">
                            <div class="mt-3 row mb-2 no-gutters pl-5 pr-4">
                                <div class="col-2 col-md-1 mt-3">
                                    <h1><span class="fa fa-user-circle"></span></h1>
                                </div>
                                <div class="col-7 col-md-8  mr-md-3">
                                    <textarea rows="2" class="form-control rounded-pill p-2"></textarea>
                                </div>
                                <div class="col-3 col-md-2 mt-3">
                                    <button
                                        class="btn rounded-pill site-bg-orange text-white ml-3  pl-md-4 pr-md-4">Comment</button>
                                </div>

                            </div>
                            <hr>
                        </div>

                    </div>

                    {{-- replies start --}}
                    <div class="mt-3 row mb-1 no-gutters" style="margin-left:60px ">
                        <div class="col-1 col-md-1 ">
                            <h1><span class="fa fa-user-circle"></span></h1>
                        </div>
                        <div class="col-10 col-md-10  mr-md-3 pl-2 pl-md-0">
                            <h6 class="site-text-orange font-weight-bold">Sojay</h6>
                            <p class="lead"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate ut
                                porro
                                tenetur. Sapiente
                                animi corrupti tenetur exercitationem a aut illum porro nobis corporis aspernatur,
                                dolores
                                ab
                                accusantium, sint nemo saepe.
                            </p>
                            <div class="row no-gutters ">
                                <div class="col-4  pointer">
                                    <span class="fa fa-thumbs-up"></span>
                                    <span>Like</span>
                                    <span class="ml-1">200</span>
                                </div>
                                <div class="col-7">
                                    <span class="fa fa-history mt-1 font-weight-bold ml-1"></span>
                                    <span class="">2 minutes ago</span>
                                </div>
                            </div>
                        </div>




                    </div>


                    {{-- replies end --}}




                @endforeach
            </div>
            {{-- comment ends here --}}
        </div>
        {{-- more songs --}}
        <div class="card p-3 mt-2">
            <h5 class="font-weight-bold">More songs from <span class="site-text-orange">TEMS</span></h5>

        </div>
        <div>
            @livewire('inc.songlist')
        </div>
        {{-- more songs --}}
        <br><br><br><br><br>
    @endif
</div>
