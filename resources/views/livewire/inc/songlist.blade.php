<div x-data="{playing:'a',playingbtn:'',played:'a',paused:'',hov:'a'}">
    {{-- init="init({{ json_encode($songs) }})" --}}

    <div>
        @foreach ($songs as $song)
            <div wire:key="{{ $loop->index }}" class="card mb-2 mb-md-2 p-1 p-md-3 border-0  transition-fade"
                id="swup" style="overflow: hidden" @mouseenter="hov={{ $loop->index }}"
                :class="{'shadow-lg':hov=={{ $loop->index }}}">
                <div class="row no-gutters">
                    <div class="col-sm-3 col-3 col-md-3 col-lg-3 col-xl-3" wire:ignore>

                        <div class="img-thumbs border border-0 rounded-circle shadow bg mt-4">
                            <h1 id="l{{ $loop->index }}" class="text-center mt-4 text-white">
                                <i class="fa fa-spin fa-spinner"></i>
                            </h1>
                            <figure>
                                <a href="/single/{{ $song['url'] }}">
                                    <img src="{{ Storage::disk('s3')->url($song['art']) }}"
                                        class="img  rounded d-none" alt="" id="i{{ $loop->index }}"
                                        style="width: 100%" onload="
                                if(document.querySelector('{{ '#l' . $loop->index }}')){
                                    document.querySelector('{{ '#l' . $loop->index }}').classList.toggle('d-none');
                        document.querySelector('{{ '#i' . $loop->index }}').classList.toggle('d-none')
                                }
                                ">

                                </a>
                            </figure>

                        </div>
                    </div>
                    <div class="col-9 col-md-9 s-list light-divs"
                        style="line-height: 5px;background-color:inherit !important">
                        <div class="ml-md-2" style="background:inherit">
                            <div class="clearfix">
                                <div class="float-left ">
                                    <h5>{{ $song['artist'] }}</h5>
                                </div>
                                <div class="float-right pr-2 pr-md-0 ">
                                    <h5 class=""
                                        x-on:click="Livewire.emit('share',   $wire.songs[{{ $loop->index }}]);setTimeout(()=>{ $('#shareModal').modal('show')},1000)">
                                        <span class="text-right fa fa-share-alt"></span>
                                    </h5>
                                </div>
                            </div>
                            <h6 class="font-weight-bold">
                                <a
                                    href="/single/{{ $song['url'] }}/{{ $song['slug'] }}">{{ $song['title'] }}</a>
                            </h6>
                            @if ($song['feature'])
                                <p><span class="font-weight-bold sidenav-icon">feat</span>
                                    <span>{{ $song['feature'] }}</span>
                                </p>
                            @endif

                            <p><span class="font-weight-bold">Released :</span>
                                <span>{{ date('M d,Y', strtotime($song['release_date'])) }}</span>
                            </p>
                            {{-- @if ($song['producer'])
                                                <p><span class="font-weight-bold">Produced by :</span>
                                                    <span>{{ $song['producer'] }}</span>
                                                </p>
                                            @endif --}}
                            <h5 class="">
                                <span class="badge bg-orange songlist-badge text-white">{{ $song['genre'] }}</span>
                            </h5>

                            <h5 class="songlist-badge2">
                                <span class="badge border border-secondary p-1">
                                    <span class="sidenav-icon fa fa-play"></span>
                                    <span>120.2k</span>
                                </span>
                                <span class="badge border border-secondary p-1 ml-lg-2">
                                    <span class="sidenav-icon fa fa-heart"></span>
                                    <span>120.2k</span>
                                </span>
                                <span class="badge border border-secondary p-1 ml-lg-2">
                                    <span class="sidenav-icon fa fa-comment"></span>
                                    <span>120.2k</span>
                                </span>
                                <span class="badge border border-secondary p-1 ml-lg-2">
                                    <span class="sidenav-icon fa fa-download"></span>
                                    <span>120.2k</span>
                                </span>
                            </h5>

                        </div>
                    </div>

                    {{-- <div class="col-md-3 d-none d-md-inline">
                    <h5 class=" pointer text-right">
                        <span class=" p-3 p-md-1  text-center"><span class="fa fa-facebook text-info "></span></span>
                        <span class=" p-3 p-md-1 text-center"> <span class="fa fa-twitter text-primary "></span></span>
                        <span class=" p-3 p-md-1 text-center"><span class="fa fa-whatsapp text-success "></span></span>
                    </h5>
                </div> --}}
                </div>
                {{-- <div class="row no-gutters " id="" wire:ignore hidden>
                    <div class="col-2 col-md-1 w-100 ">
                        <div class="w{{ $loop->index }} d-none" X-cloak>
                            @php
                                $index = $loop->index;
                            @endphp
                            <button class="btn btn-secondary ml-2 shadow-lg " id="playbtn{{ $loop->index }}"
                                :class="{'btn-play':played =={{ $loop->index }},'btn-play-white':played !={{ $loop->index }}}"
                                x-on:click="(played !={{ $loop->index }}) ? played={{ $loop->index }} : played='a'"
                                onclick="player_wave({{ $loop->index }},'list')">
                                <span id="list-icon{{ $loop->index }}"
                                    :class="{'fa fa-play' : played !={{ $loop->index }}, 'fa fa-pause':played =={{ $loop->index }}}">
                                </span>

                            </button>

                        </div>
                    </div>
                    <div class="col-10 col-md-11 w-100 ">




                        <div id="waveform{{ $loop->index }}" class="w-100"></div>

                        <div class="w{{ $loop->index }}  font-weight-bold d-none">
                            <span class="float-left" id="cd{{ $loop->index }}"></span>
                            <span class="float-right" id="td{{ $loop->index }}"></span>
                        </div>
                    </div>
                </div> --}}
            </div>

        @endforeach
    </div>
    <br>
    <div id="morebtn" class="d-flex justify-content-center">
        <div class="spinner-grow text-danger mx-auto d-none" role="status" id="elementor" wire:loading.class="d-inline">
            {{-- <span class="visually-hidden">Loading...</span> --}}
        </div>

    </div>
    <div class="d-flex justify-content-center mt-3">
        <button wire:loading.attr="disabled" id="mores" wire:click="$emit('load-mores')"
            class="text-center btn  rounded-pill shadow w-50 site-bg-orange text-white p-2 pl-3 pr-3">
            Load More
        </button>
    </div>
    <br><br><br><br><br><br>
    <br><br>

</div>

@push('scripts')
    <script type="text/javascript">
        // document.addEventListener('livewire:load', function() {
        //     load = false;
        //     window.addEventListener('scroll', more)

        //     function more(e) {
        //         if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        //             console.log("HELLO WORLD")
        //             // document.getElementById('hi').click();
        //         }
        //     }
        // })

    </script>
@endpush
