<div x-data="{albums:'s',step:'' ,isUploading: false, progress: 0,bum:false,release:'',finished:false,shared:false,prod:''}"
    x-init="" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="step=1"
    x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
    @finished.window="{{ $ids }}==event.detail.id ? alert('DONE') : ''"
    class="mb-5 card pt-3 pb-5 pl-2 pr-2 rounded">
    @if (!$finished)


        <h5 class="font-weight-bold">
            @error('song')
                <small class="text-danger">{{ $message }}</small>

            @enderror
        </h5 class="font-weight-bold">
        <div class="clearfix mb-2">

            <div x-show="progress" class="float-left w-75">
                <h6 class="font-weight-bold">{{ $title }}</h6 class="font-weight-bold">
                <h6 class=""><span x-show="progress!=100">Uploading...</span> <span
                        x-text="progress+'% completed'"></span>
                </h6>
                <div class="progress ">
                    <div :class="{'bg-success':progress == 100,'bg-warning':progress < 100}" class="progress-bar"
                        role="progressbar" :style="'width: '+progress+'%'" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
            {{-- <div x-show="progress==100" class="rounded-circle float-right p-1 shadow" style="width: 40px;height:40px" wire:click="$emit('reduse',{{ $index}})">
            <h4 class="text-center mt-2"><span class="fa fa-trash text-danger"></span></h4>
        </div> --}}
        </div>
        <div>
            <div x-show="(progress!=100 || progress==100) && '{{ $done }}'==0" class=" p-4 "
                style="border: 3px  dashed rgb(245,125,78);border-radius:20px ">
                <form wire:submit.prevent="upload" method="POST">
                    <div class="row ">
                        <div class="col-md-9 mb-2">
                            <div class="p-3">
                                {{-- <h3 class="text-center">Drag your song here</h3> --}}
                                <h6 class="font-weight-bold text-center">Accepted file types are MP3, WAV OGG & M4A.
                                </h6>
                                <h5 class="text-center">Limit of 100MB per file</h5>

                            </div>
                        </div>
                        {{-- <div class="col-md-2 mb-3 mt-2">
                        <h3 class="text-center text-md-left">Or</h3>
                    </div> --}}
                        <div class="col-md-3 mb-1 mt-md-2">

                            <button x-on:click="{{ 'inputs' . $ids }}.click()" type="button"
                                class="btn w-100 ml-auto mr-auto  rounded-pill text-white site-bg-orange">
                                <input accept="audio/M4A, audio/mp3,audio/ogg,audio/wav" type="file" name="song"
                                    class="d-none" id="{{ 'inputs' . $ids }}" wire:model="song">
                                SELECT FILE</button>

                        </div>
                    </div>

                </form>

            </div>



            {{-- form --}}
            <div>
                <div :hidden="step!=1" class="row mt-3">
                    <div class="col-md-4 mb-3 ">
                        <div style="width:150px;height:150px;overflow:hidden"
                            class=" border border-0 rounded shadow-lg ml-auto mr-auto ml-md-3 mr-md-1">
                            <figure>
                                <img src="{{ $art ?? asset('images/camera.svg') }}" style="width: 100%"
                                    {{-- :class="{'shadow-lg':{{ $art }}!=''}" --}} class="img  rounded ml-auto mr-auto d-block ">
                            </figure>


                        </div>
                        <button style="margin-top: -10px;z-index:22"
                            class="ml-5 ml-md-4 btn rounded-pill site-bg-orange text-white shadow-lg w-75"
                            x-on:click="{{ 'cov' . $ids }}.click()" type="button">
                            <input type="file" class="d-none" id="{{ 'cov' . $ids }}" wire:model="cover"
                                accept="image/png,image/jpg,image/jpeg">
                            <span class="fa fa-camera mr-2"></span>
                            Cover Art</button>
                        <h5 class="text-center mt-2"><small>Minimum 500x500 size,JPG,JPEG or PNG</small></h5>
                        @error('cover')
                            <small class="text-center text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 for="">Song Title <span class="text-danger">*</span></h5>
                                    <input type="text" class="form-control" wire:model.defer="title"
                                        placeholder="Song Title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 for="">Artist <span class="text-danger">*</span></h5>
                                    <input type="text" class="form-control" placeholder="Artist"
                                        wire:model.defer="artist">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <h5 for="">Featuring <small></small></h5>
                                    <input type="text" class="form-control" placeholder="Featuring"
                                        wire:model.defer="feature">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Producer(s) <span class="text-danger">*</span></h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="" wire:model="producer">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Genre</h5>
                                <div class="form-group">
                                    <select wire:model.lazy="genre" class="form-control">
                                        @if ($genre)
                                            <option value="{{ $genre }}">{{ $genre }}</option>
                                        @endif
                                        @if (!$genre)
                                            <option value=""></option>
                                        @endif
                                        @foreach ($genres as $gen)
                                            <option value="{{ $gen->genreName }}">{{ $gen->genreName }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <button x-on:click="step=2" @if (!$producer) disabled @endif
                            class="float-right clearfix btn w-50 rounded-pill site-bg-orange text-white">Next <span
                                class="ml-2 fa fa-arrow-right"></span></button>
                    </div>

                </div>
                <div class="row mt-2" :hidden="step!=2">
                    <div class="col-md-6 mt-md-4">
                        <div class="form-group">
                            <h5>Album</h5>

                            <input type="text" class="form-control" x-on:focus="bum=true" @click.away="bum=false"
                                wire:model.lazy="album">

                            <div :hidden="!bum">
                                @if (count($albums) > 0)

                                    <div class="card shadow-lg"
                                        style="position: absolute;z-index:2;height:200px;overflow-y:scroll;overflow-x:hidden;width:91%">

                                        <ul class="list-group">
                                            @foreach ($albums as $item)
                                                <li wire:click="$set('album', '{{ $item->name }}')"
                                                    x-on:click="bum=false" class="list-group-item"
                                                    x-on:mouseover="albums={{ $loop->index }}"
                                                    :class="{'site-bg-orange text-light':albums=={{ $loop->index }}}">
                                                    {{ $item->name }}
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Video URL <small>(Enter an absolute URL that leads to the video of this song. E.g
                                    YouTube
                                    )</small></h5>
                            <input type="text" class="form-control" placeholder="http://youtube.com/myvideo-url"
                                wire:model.defer="video_link">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Song Description</h5>
                        <div class="form-group">
                            <textarea rows="3" class="form-control" wire:model.defer="description"
                                placeholder="What do you want fans to know about this song?"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Lyrics</h5>
                        <div class="form-group">
                            <textarea rows="3" class="form-control" wire:model.defer="lyrics"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="clearfix">
                            <div class="float-left w-50 ">
                                <button x-on:click="step=1"
                                    class="float-right btn w-50   rounded-pill btn-dark text-white">
                                    <span class="ml-2 fa fa-arrow-left"></span>
                                    Back
                                </button>
                            </div>

                            <div class="float-right w-50">


                                <button x-on:click="step=3"
                                    class="ml-3 btn w-50  rounded-pill site-bg-orange text-white">Next
                                    <span class="ml-2 fa fa-arrow-right"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div :hidden="step!=3" class="mt-2">
                    <h4 class="">How do you want your song released ? <span class="text-danger">*</span> </h4>
                    <div class="row ">
                        <div class="col-md-6 pointer">
                            <div class="form-group">
                                <input type="radio" class="mr-2" id="now{{ $ids }}"
                                    x-on:click="date{{ $ids }}.checked=false;release='now'"
                                    wire:model.defer="release_date" value="{{ now() }}">
                                <span
                                    x-on:click="date{{ $ids }}.checked=false;now{{ $ids }}.click()"
                                    class="font-weight-bold">Immediately</span>

                            </div>
                            <div class="form-group">
                                <input type="radio" class="mr-2"
                                    x-on:click="now{{ $ids }}.checked=false;release='date'"
                                    id="date{{ $ids }}">
                                <span class="font-weight-bold"
                                    x-on:click="now{{ $ids }}.checked=false;date{{ $ids }}.click()">Release
                                    date</span>

                            </div>
                            <div class="form-group ml-4" :hidden="release!='date'">
                                <h5>Choose a date</h5>
                                <input type="datetime-local" class="mr-2 form-control" wire:model.defer="release_date">


                            </div>

                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="clearfix">
                                <div class="float-left w-50 ">
                                    <button x-on:click="step=2"
                                        class="float-right btn w-50   rounded-pill btn-dark text-white">
                                        <span class="ml-2 fa fa-arrow-left"></span>
                                        Back
                                    </button>
                                </div>


                                <div class="float-right w-50">

                                    <button wire:loading.class="btn-dark" wire:loading.attr="disabled"
                                        wire:click="upload"
                                        class="ml-3 btn w-50  rounded-pill site-bg-orange text-white">

                                        <span>
                                            <span class="mr-2 fa fa-upload"></span>
                                            Upload
                                        </span>

                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div wire:loading wire:target="upload" class="w-100">
                                <div class="w-50  ml-auto">
                                    <div class="spinner-grow text-danger text-center"></div>
                                    <br>
                                </div>
                                <div class="w-75 mt-2  ml-auto">

                                    <em class="ml-md-5">Uploading song, please wait.....</em>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            {{-- form --}}
        </div>


    @else


        <div class="row">
            <div class="col-12 col-md-5 col-lg-4 p-2 pt-md-3 pb-md-3">
                <div class="img-thumbss border border-0 rounded shadow-lg bg ml-auto mr-auto ml-md-3 mr-md-1">

                    {{-- <h1 id="l{{ $ids }}" class="text-center mt-5 text-white display-1">
                        <br>
                        <i class="fa fa-spin fa-spinner"></i>
                    </h1> --}}
                    <figure>

                        <img src="{{ Storage::disk('s3')->url($pic) }}"
                            class="img  rounded  shadow-lg img img-responsive" alt="" id="i" style="width: 100%">


                    </figure>

                </div>

            </div>
            <div class="col-12 col-md-7 col-lg-8">
                <div class="row">
                    <div class="col-12 ">
                        <h4>{{ $artist }} -: {{ $title }}
                            @if ($feature)
                                <span> ft {{ $feature }}</span>
                            @endif
                        </h4>

                        <p>
                            {{ $description }}
                        </p>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="">
                            <div class="float-left ml-5 ml-md-4">

                                <a class="btn rounded-pill site-bg-orange text-light pl-5 pr-5"
                                    href="/single/{{ auth()->user()->url }}/{{ $slug }}">
                                    <span class="fa fa-eye mr-2"></span>View
                                </a>
                            </div>
                            <div class="float-right mr-5 mr-md-4">
                                <button class="btn rounded-pill site-bg-orange text-light pl-5 pr-5" :disabled="shared"
                                    x-on:click="shared=true;$wire.share();setTimeout(()=>{ $('#shareModal').modal('show');shared=false},1000)">
                                    <span class=" mr-2"
                                        :class="{'fa fa-share':!shared,'fa fa-spin fa-spinner':shared}"></span>Share</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
