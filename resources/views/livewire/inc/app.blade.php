<div>


    <div class="sticky-top">
        @livewire('inc.navbar')
    </div>
    <div class="flex-cont">
        <div class="sidenav-container d-none d-md-inline">
            <div id="side-inner" class="mb-4">
                <div class="w-50  ml-5 mt-3 mb-5">
                    <img src="{{ asset('images/avat.jpg') }}" alt=""
                    style="width: 80px;height:80px"
                     class="pointer myshadow rounded-circle border border-danger" >

                </div>
                @livewire('inc.sidenav')
                @livewire('inc.sidenav')
            </div>

            <div class="row no-gutters mb-5">
                <div class="col-6 pl-3">
                   <span class="mt-5">
                    <i class="fas fa-moon" tyle="font-size: 20px"></i>
                    <span class="font-weight-bold" >Dark mode</span>
                   </span>
                </div>
                <div class="col-6">
                   <livewire:inc.mode-toggle />
                </div>
                <br><br>
            </div>
        </div>
        <div class="main-container light-divs bg-ash w-100 ">
            <div id="inner" class="w-100">
                <div class="p-2 pl-md-5 pr-md-5 w-100">



                    <div style="position: fixed;z-index:999999">
                         <div  class=" mb-2 card  pl-3 pr-3"
                   style="display:absolute;z-index:9999999999999;top:0;margin-top:-7px">
                    <div class="">

                <div class="input-group  search-div mt-0 pl-3 pr-3" >
                    <span class="fa fa-microphone my-auto sidenav-icon pointer" id="mod"></span>
                    <input class="form-control search-input " type="text" name="" placeholder="Search songs,album artists,genre..." aria-label="Recipient's " aria-describedby="my-addon">
                    <span class="fa fa-search my-auto sidenav-icon pointer"></span>

                </div>
                <div class="d-none mt-2 card shadow-lg w-100 w-md-50 rounded "  style="z-index:999999999;position: absolute;">
        <ul class=" list-group pl-2 pr-2 pt-2" style="list-style: none">
            @php
                $mens=[1,1,1];
            @endphp
            @foreach ($mens as $menu)
            <li class="mb-4 list-group-item-flush">
                <span class="{{ $menu }} mr-2 sidenav-icon"></span>
            <a class="" href="#">Search results here</a>
            </li>

            @endforeach

        </ul>
    </div>

            </div>

                   </div>
                   <div id="list" class=" mb-2 genre-list card p-2 pl-3"
                   style="z-index:9999;top:-1;margin-top:-8px">

                        <livewire:genre-list />
                   </div>


                    <div class="" style="margin-top:-65px;z-index:9999999;position: relative;">
                      <div class=" p-3  pointer float-left d-none d-md-inline"
                    onclick="document.getElementById('list').scrollBy({left: 200,behavior: 'smooth'});"
                     style="margin-left:-20px">
                      <button class="shadow-lg btn btn-light rounded-circle" style="width: 30px;height:30;position: fixed;">
                         <span class="sidenav-icon fa fa-chevron-left"></span>
                    </button>



                    </div>
                      <div class=" p-3  pointer float-right d-none d-md-inline"
                    onclick="document.getElementById('list').scrollBy({left: -200,behavior: 'smooth'});"
                     style="margin-right:10px">
                        <button class="shadow-lg btn btn-light rounded-circle" style="width: 30px;height:30;position: fixed;">
                         <span class="sidenav-icon fa fa-chevron-right"></span>
                    </button>
                    </div>

                  </div>

                </div>
                    @php
                    $img=[1];
                    @endphp
                    @foreach ($img as $item)
                    <figure class="mt-5 mt-md-1">
                        <img src="{{ asset('images/banner.jpg') }}" alt="banner" class="img img-fluid rounded-top">
                    </figure>
                    @endforeach
                    @livewire('inc.songlist')


                </div>
            </div>
        </div>


    </div>

    @push('scripts')

    @endpush

</div>
