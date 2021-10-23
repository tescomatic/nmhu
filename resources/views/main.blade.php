<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="turbolinks-cache-control" content="no-cache">

    {{-- <meta name="turbolinks-visit-control" content="reload"> --}}
    {{-- <meta name="turbolinks-cache-control" content="no-preview"> --}}
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('dist/snackbar.min.css') }}" media="screen" title="no title"
        charset="utf-8">
    <link rel="stylesheet" href="{{ asset('src/prism.css') }}" media="screen" title="no title" charset="utf-8">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/naipod.css') }}">

    <div data-turbolinks-eval="true">
        @livewireScripts
    </div>
    {{-- <livewire:scripts > --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('js/app.js') }}" data-turbolinks-suppress-warning></script>
    <script src="https://kit.fontawesome.com/ccab2e2008.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">

    </script>
    <script src="https://unpkg.com/@barba/core"></script>
    {{-- <script src="https://unpkg.com/wavesurfer.js"></script> --}}
    <script src="{{ asset('js/player.js') }}" type="module"></script>

    <script defer src="{{ asset('src/prism.js') }}" charset="utf-8"></script>
    <script defer src="{{ asset('dist/snackbar.min.js') }}" charset="utf-8"></script>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    @stack('cap')

    <title>Naipod</title>
</head>

<body data-barba="wrapper">







    {{-- NEW trynign --}}
    <div>

        <div class="card sidebar d-none d-md-inline" data-turbolinks-permanent>
            <div id="side-inner" class="mt-5">
                <div class="w-50  ml-5 mt-3 mb-5">
                    <img src="{{ asset('images/avat.jpg') }}" alt="" style="width: 80px;height:80px"
                        class="pointer myshadow rounded-circle border border-danger">

                </div>
                @livewire('inc.sidenav')
                @livewire('inc.sidenav')

            </div>
            <div class="row no-gutters mb-1 mt-3 pl-5">
                {{-- <div class="col-6 pl-3">
                    <span class="mt-5">
                        <i class="fas fa-moon" tyle="font-size: 20px"></i>
                        <span class="font-weight-bold">Dark mode</span>
                    </span>
                </div> --}}
                <div class="col-4">
                    <i class="fas fa-moon mt-2 ml-2 h3 text-secondary"></i>

                </div>
                <div class="col-6">
                    <livewire:inc.mode-toggle />
                </div>

            </div>
        </div>

        <div class="content light-divs bg-ash ">
            <div data-turbolinks-permanent class="sticky-top">
                @livewire('inc.navbar')
            </div>
            <div data-turbolinks-permanent style="position:fixed;display:absolute;z-index:99;bottom:0"
                class="w-100 pr-md-5">
                <div>
                    @livewire('inc.player')
                </div>
            </div>
            <div class="pl-md-3 pr-md-3 p-0 pl-lg-5 pr-lg-5">

                <div id="" class="inners" data-barba="container" data-barba-namespace="home">
                    {{-- searcha and topmost --}}
                    @if (!$hide)
                        <div style="position: fixed;z-index:99;" class="ml-md-5">

                            <div id="list" class=" genre-list card p-2 pl-3"
                                style="z-index:9999;top:-1;margin-top:-6px">

                                <livewire:genre-list />
                            </div>


                            <div class="" style="margin-top:-65px;z-index:999999999999;position: relative;">
                                <div class=" p-3  pointer float-left d-none d-md-inline"
                                    onclick="document.getElementById('list').scrollBy({left: 200,behavior: 'smooth'});"
                                    style="margin-left:-20px">
                                    <button class="shadow-lg btn btn-light rounded-circle"
                                        style="width: 30px;height:30;position: fixed;">
                                        <span class="sidenav-icon fa fa-chevron-left"></span>
                                    </button>



                                </div>
                                <div class=" p-3  pointer float-right d-none d-md-inline"
                                    onclick="document.getElementById('list').scrollBy({left: -200,behavior: 'smooth'});"
                                    style="margin-right:10px">
                                    <button class="shadow-lg btn btn-light rounded-circle"
                                        style="width: 30px;height:30;position: fixed;">
                                        <span class="sidenav-icon fa fa-chevron-right"></span>
                                    </button>
                                </div>

                            </div>

                        </div>
                    @endif
                    {{-- search and topmost ends --}}
                    <div class="p-2 pl-md-5 pr-md-5 w-100">

                        @if (!$hide)
                            @php
                                $img = [1];
                            @endphp
                            @foreach ($img as $item)
                                <figure class="mt-5 mt-md-1">
                                    <img src="{{ asset('images/banner.jpg') }}" alt="banner"
                                        class="img img-fluid rounded-top">
                                </figure>
                            @endforeach
                        @endif
                        {{ $slot }}



                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- NEW trynign --}}











    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script> --}}

    {{-- Option 2: jQuery, Popper.js, and Bootstrap JS --}}



    {{-- <livewire:inc.voice-search /> --}}



    <script>
        barba.init({
            // transitions: [{
            //     name: 'opacity-transition',
            //     leave(data) {
            //         return gsap.to(data.current.container, {
            //             opacity: 0
            //         });
            //     },
            //     enter(data) {
            //         return gsap.from(data.next.container, {
            //             opacity: 0
            //         });
            //     }
            // }]
            // prefetchIgnore: true

        });
        barba.hooks.beforeEnter((data) => {
            window.livewire.start();
            // changes()
            $(window).scrollTop(0);
            // if ('scrollRestoration' in history) {
            //     history.scrollRestoration = 'manual';
            // }


        });

    </script>
    <livewire:inc.login />
    <livewire:inc.share />

</body>

</html>

@stack('scripts')
<script data-turbolinks-permanent>
    function changes(status = 0) {

        var theme = localStorage.getItem('theme') || 'none';
        if (theme == 'none' && status == 0) {
            return;

        } else if (theme == 'none' && status == 1) {
            localStorage.setItem('theme', 'isset');
        } else if (theme == 'isset' && status == 0) {

            toggles = document.querySelectorAll('.toggles');

            toggles.forEach(toggle => {
                toggle.click();

            })
        } else if (theme == 'isset' && status == 1) {
            localStorage.setItem('theme', 'none');
        }
        element = document.body;
        element.classList.toggle("dark");
        divs = document.querySelectorAll('.light-divs');
        cards = document.querySelectorAll('.card');
        divs.forEach(elements => {
            elements.classList.toggle("bg-ash");
            elements.classList.toggle("bg-darks");
        });
        cards.forEach(elements => {
            elements.classList.toggle("dark");
        });
        // var siput = document.querySelector('#sdiv');
        // siput.classList.toggle('search-div-dark');
        // siput.classList.toggle('search-div');
        // document.querySelector('#sinput').classList.toggle('search-input-dark')
        // document.querySelector('#sinput').classList.toggle('search-input-light')
    }

    // changes()
    window.livewire.on('remake', songss => {

        // }

    })

</script>
