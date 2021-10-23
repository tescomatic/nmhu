<div class="mb-5 mt-3" x-data="{type:'',show:'',upload:false}">


    <div x-show="show=='ss'" class="row mb-5">
        <div class="col-12 mb-2">
            <h2 class="text-center ">Please choose your upload type</h2>
            <hr>
        </div>
        <div class="col-6">
            <div class="card pr-5 pl-5 pt-3 pb-4 rounded" x-on:click="type='song'"
                :class="{'shadow-lg':type=='song','mt-4':type=='album'}">
                <img src="{{ asset('images/microphone.svg') }}" alt="" width="100"
                    class="img img-responsive ml-auto mr-auto">
                <h4 class="text-center mt-2">Song <span class="fa fa-check site-text-orange"
                        x-show="type=='song'"></span></h4>

            </div>
        </div>
        <div class="col-6">
            <div class="card rounded pr-5 pl-5 pt-3 pb-4" x-on:click="type='album'"
                :class="{'shadow-lg':type=='album','mt-4':type=='song'}">
                <img src="{{ asset('images/cd.svg') }}" alt="" width="100" class="img img-responsive ml-auto mr-auto">
                <h4 class="text-center mt-2">Album
                    <span class="fa fa-check site-text-orange" x-show="type=='album'"></span>
                </h4>



            </div>
        </div>
        <div class="col-12 mb-5 mt-5">
            <button :disabled="type==''" x-on:click="show=type;upload=true"
                class="btn btn-lg mx-auto rounded-pill site-bg-orange text-white w-50 d-block">Next
                <span class="fa fa-arrow-right ml-4"></span>
            </button>
        </div>

    </div>


    {{-- show --}}
    <div >
         <div class="w-75 ml-auto mr-auto">
                <p>
                    By importing to Naipod, you settle to our Terms of Service. <b>DO NOT</b> add any tune you don’t personally have the copyrights to or have express permission to distribute. Any account found guilty can be deleted and completely banned.
                </p>
            </div>
        @foreach ($amount as $item)

            @php
            $randomKey = time().$loop->index;
            @endphp

             @if (count($amount) == 1)
                        <div class="card  p-3 text-center rounded-top border border-top-danger">
                            <h3>Hi, Welcome to Naipod !</h3>
                            <h6>Start uploading your songs right here.</h6>
                        </div>
                    @endif
               @if (count($amount) >1)
                    <div class="card w-25 p-2 rounded-right">
                    <h3>Track {{ $loop->index+1 }}</h3>
                </div>
               @endif
               @php
                   $index=$loop->index
               @endphp
            <div wire:ignore>

                <livewire:upload-single :key="$randomKey" :ids="$randomKey" :ind="$item">

            </div>

        @endforeach


    </div>
</div>
