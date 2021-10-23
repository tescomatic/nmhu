<div x-data="{embeds:true,tapped:false,use:true,cus:false,color:'rgb(245,125,78)'}" @share.window="embeds=false">

    <div class="modal fade  modal-fullscreen-md-down" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        id="staticBackdrop" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header  border-0">
                    @if ($info != '')
                        <h4 class="modal-title" id="exampleModalLabel">{{ $info['title'] }} </h4>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true" style="font-size: 40px">&times;</span>

                    </button>


                </div>
                <div class="modal-body p-0">
                    @if ($info != '')


                        <div class="row p-4" x-show="!embeds">
                            <div class="col-md-2 col-4 mb-3" x-on:click="embeds=true">
                                <img class="img img-responsive shadow-lg rounded-circle"
                                    src="{{ asset('images/laptop.svg') }}" width="50">
                                <div class="text-md-center">
                                    <strong>Embed</strong>
                                </div>
                            </div>
                            <div class="col-md-3 col-4 mb-3">
                                <img class="img img-responsive shadow-lg rounded-circle ml-auto"
                                    src="{{ asset('images/whatsapp.svg') }}" width="52">

                                <div class="">
                                    <strong class="">Whatsapp</strong>
                                </div>
                            </div>
                            <div class="col-3">
                                <img class="img img-responsive shadow-lg rounded-circle"
                                    src="{{ asset('images/facebook.svg') }}" width="50">
                                <div>
                                    <strong>Facebook</strong>
                                </div>
                            </div>
                            <div class="col-md-2 col-4 mb-3">
                                <img class="img img-responsive shadow-lg rounded-circle"
                                    src="{{ asset('images/twitter.svg') }}" width="50">
                                <div class="text-md-center">
                                    <strong>Twitter</strong>
                                </div>
                            </div>
                            <div class="col-md-2 col-4 mb-3">
                                <img class="img img-responsive shadow-lg rounded-circle"
                                    src="{{ asset('images/google-plus.svg') }}" width="50">
                                <div class="text-md-center">
                                    <strong>Google</strong>
                                </div>
                            </div>
                        </div>
                        <div x-show="embeds==true" class="pl-md-2 pr-md-2 pt-md-2 pb-md-2 p-2 rounded  site-bg-ash">
                            <button x-on:click="embeds=false" class="mb-2 btn bg-dark text-white">
                                <span class="fa fa-arrow-left mr-2"></span> Back to share</button>

                            <div class="card shadow  p-1 p-md-3 border-0 text-white transition-fade" id="swup" :style=" 'background:'+(use? 'linear-gradient(0deg,rgba(46,19,2,0.8),rgba(36,17,0,0.8)),url({{ Storage::disk('s3')->url($info['art']) }})' :'')+`;
                                        background-position: center;
                                        background-size: cover;
                                        background-repeat: no-repeat;
                                        background-attachment: fixed;`" style="overflow: hidden">
                                <div class="row no-gutters">
                                    <div class="col-sm-3 col-3 col-md-3 col-lg-3 col-xl-3">

                                        <div class="img-thumbs border border-0 rounded shadow bg">

                                            <figure>
                                                <a href="/single">
                                                    <img src="{{ Storage::disk('s3')->url($info['art']) }}" onload=""
                                                        class="img  rounded" alt="" style="width: 100%">

                                                </a>
                                            </figure>

                                        </div>
                                    </div>
                                    <div class="col-9 col-md-9 s-list light-divs " style="line-height:">
                                        <div class="mt-2 ml-3 ml-md-0" :class="{'text-dark':!use}">
                                            <div style="line-height: 5px">
                                                <h5>{{ $info['artist'] }}</h5>
                                                <h5 class="font-weight-bold">{{ Str::limit($info['title'], 40) }}</h5>
                                                @if ($info['feature'])
                                                    <h6 class=""><span class=" font-weight-bold"
                                                            :style="'color:'+color">Feat</span>.
                                                        {{ $info['feature'] }}</h6>
                                                @endif
                                                <p><span class="font-weight-bold">Released :</span>
                                                    <span>{{ date('M d,Y', strtotime($info['release_date'])) }}</span>
                                                </p>
                                            </div>
                                            @if ($info['producer'])
                                                <p><span class="font-weight-bold">Produced by :</span>
                                                    <span>{{ $info['producer'] }}</span>
                                                </p>
                                            @endif
                                            <h5 class="d-none">
                                                <span
                                                    class="badge bg-orange songlist-badge text-white">{{ $info['genre'] }}</span>
                                            </h5>

                                            <h6 class="songlist-badge2">
                                                <span class="badge border border-secondary p-1">
                                                    <span class="fa fa-play" :style="'color:'+color"></span>
                                                    <span>120.2k</span>
                                                </span>
                                                <span class="badge border border-secondary p-1 ml-lg-2">
                                                    <span class=" fa fa-heart" :style="'color:'+color"></span>
                                                    <span>120.2k</span>
                                                </span>
                                                <span class="badge border border-secondary p-1 ml-lg-2">
                                                    <span class=" fa fa-comment" :style="'color:'+color"></span>
                                                    <span>120.2k</span>
                                                </span>
                                                <span class="badge border border-secondary p-1 ml-lg-2">
                                                    <span class=" fa fa-download" :style="'color:'+color"></span>
                                                    <span>120.2k</span>
                                                </span>
                                            </h6>

                                        </div>
                                    </div>

                                </div>
                                <div class="row no-gutters " id="">
                                    <div class="col-2 col-md-1 w-100 ">
                                        <div class="" X-cloak>

                                            <button class="btn btn-secondary ml-2 rounded-circle p-3"
                                                :style="'background:'+color+';z-index:999'">
                                                <span id="list-icon{{ 0 }}" class="fa fa-play">
                                                </span>

                                            </button>

                                        </div>
                                    </div>
                                    <div class="col-10 col-md-11 w-100 ">



                                        <div id="waveforma" class="w-100"></div>

                                        <div class="  font-weight-bold d-none">
                                            <span class="float-left" id="">00</span>
                                            <span class="float-right" id="">00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <embed> --}}
                            <div class=" p-1 card mt-1">
                                <div class="clearfix">
                                    <div class="float-left h6 pointer mt-2" x-on:click="use ? use=false : use=true">
                                        <i
                                            :class="{'fas fa-check-circle text-success':use,'fas fa-circle site-text-ash':!use}"></i>

                                        <strong>Use cover as background?</strong>

                                    </div>
                                    <div class="float-right h6 pointer" :class="{'mt-2':!cus}">
                                        <span x-on:click="cus ? cus=false : cus=true">
                                            <i
                                                :class="{'fas fa-check-circle text-success':cus,'fas fa-circle site-text-ash':!cus}"></i>

                                            <strong>Customize color?</strong>
                                        </span>

                                        <input type="color" class="ml-2" x-show="cus" id="color"
                                            x-on:change="color=document.querySelector('#color').value">

                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 p-1 card pl-2 pr-2 pb-2">
                                <h6 class="font-weight-bold">You can add this player to a website by embedding it.</h6>
                                <div class="p-3 site-bg-ash mt-3"
                                    x-text='`<iframe src="https://audiomack.com/embed/single/ss/{{ $info['slug'] }}?color=${color}&bg=${use}" scrolling="no" width="100%" height="252" scrollbars="no" frameborder="0"></iframe>`'>

                                </div>
                                <div class="clearfix mt-1">
                                    <button class="float-right  shadow btn btn-dark">Copy Link</button>
                                </div>
                            </div>
                        </div>



                    @else
                        <h3>Something went wrong</h3>
                    @endif
                </div>
                @if ($info != '')
                    @push('scripts')
                        <script>
                            function dras() {

                                wavesurfer = WaveSurfer.create({
                                    container: '#waveforma',
                                    waveColor: ' rgb(143, 141, 140)',
                                    progressColor: 'rgb(245,125,78)',
                                    hideScrollbar: true,
                                    cursor: false,
                                    drag: false,
                                    barWidth: 2,
                                    height: 30,
                                    interact: true,
                                    integer: 1,
                                    responsive: true,
                                    cursorWidth: 0,
                                    fillParent: true,


                                });
                                wavesurfer.load(
                                    'https://naipod.s3.eu-west-3.amazonaws.com/tzee/Want%20To%20%7C%7C%20GLtrends.ng%20%5BBBMC-%20C00424417%5D%20%7C%20Naipod.com.mp3'
                                );
                            }
                            // dras();

                        </script>
                    @endpush
                @endif
            </div>
        </div>
    </div>

</div>
