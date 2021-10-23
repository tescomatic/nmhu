<div data-turbolinks-permanent x-data="{ open: false ,mobilenav:false,resdiv:false,hide:false}" class="card">


    <nav class="main-nav d-flex justify-content-between myshadow  p-2 pl-0">
        <div class="nav-brand d-inline ml-md-4">
            <span class="fa fa-bars mr-4 d-md-none  icon-bar" x-on:click="mobilenav = true"
                style="font-size: 17px"></span>
            <img  src="{{ asset('images/naipod.png') }}" alt="" class="img img-fluid" style="width:30px">

        </div>
        <div class=" d-md-none mt-1">
            <h2 class="d-inline-block">
                <span class="  fa fa-search sidenav-icon" id="ss"
                    x-on:click="hide=true;ttt.classList.remove('d-none')" x-show="!hide">
                </span>
            </h2>
        </div>

        <div class=" d-none d-md-inline" id="ttt" :class="{'w-50':!hide,'w-75':hide}">
            <div class="">

                <div class="input-group  search-div px-2">
                    <span class="fa fa-microphone my-auto sidenav-icon pointer" id="mod"></span>
                    <input id="sinput" class="form-control search-input-light  search-input " type="text"
                        x-on:click="resdiv=true" @click.away="resdiv=false" x-on:focus="resdiv=true;ss.click()"
                        x-on:blur="hide=false;resdiv=false;ttt.classList.add('d-none')"
                        placeholder="Search songs,album artists,genre..." aria-label="Recipient's "
                        aria-describedby="my-addon"> <span class="fa fa-search my-auto sidenav-icon pointer"></span>

                </div>
            </div>
        </div>
        <div class="" x-show="!hide">

            @auth
                <div @click="open = true">
                    @if (auth()->user()->avatar)
                        @php
                        $dp=Storage::disk('s3')->url(auth()->user()->avatar );

                        @endphp
                    @else
                        @php
                        $dp=auth()->user()->s_avatar;

                        @endphp
                    @endif
                    <span class="mr-2 d-none d-md-inline">{{ auth()->user()->stage_name }}</span>
                    <img src="{{ $dp }}" alt="" class="pointer avarta shadow-lg rounded-circle border border-danger">
                    <span class="fa fa-chevron-down mr-2 mt-2 pointer"></span>

                </div>
            @else
                <a onclick="showModal()" class="site-text-orange font-weight-bold mr-4 pointer login mt-5">Sign in/Sign
                    up</a>
            @endauth
        </div>
        <div x-show="!hide">
            <a class="btn btn-danger btn-radius shadow p-2 pl-3 pr-3" href="{{ route('upload') }}">
                <span class="fa fa-upload mr-md-1"></span>
                <span class="">Upload</span>
            </a>
        </div>
    </nav>
    <div class="" x-cloak x-show="resdiv">
        <div class="mt-1 card shadow-lg w-100 w-md-50 rounded "
            style="z-index:999999999;position: absolute;margin-top:-10px">
            <ul class=" list-group pl-2 pr-2 pt-2" style="list-style: none">
                @php
                $mens=[1,1,1];
                @endphp
                @foreach ($mens as $menu)
                    <li class="mb-4 list-group-item-flush">
                        <span class="{{ $menu }} mr-2 sidenav-icon"></span>
                        <a class="" href="/single">Search results here</a>
                    </li>

                @endforeach

            </ul>
        </div>

    </div>

    <div class="card shadow-lg rounded mt-5 p-card" x-cloak x-show.transition.scale.75="open" @click.away="open = false"
        style="">
        <ul class=" list-group pl-3 pr-3 pt-2" style="list-style: none">
            @foreach ($menus as $menu)

                <li class="mb-4 list-group-item-flush pointer">
                    <span class="{{ $menu['icon'] }} mr-2 sidenav-icon"></span>
                    <a class="" href="/single" x-on:click="open=false">{{ $menu['name'] }}</a>
                </li>
            @endforeach

            <li class="mb-4 list-group-item-flush pointer">
                <span class="fa fa-sign-out-alt mr-2 sidenav-icon"></span>
                <a class="" wire:click="logout" x-on:click="open=false">Sign out</a>
            </li>


        </ul>
    </div>


    @livewire('inc.mobile-nav')


</div>
