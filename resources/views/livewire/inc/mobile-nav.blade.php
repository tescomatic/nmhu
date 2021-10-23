<div x-cloak
x-show.transition.scale.75="mobilenav"
class="card shadow-lg rounded w-100 mobile-nav d-md-none" >
<div class=" mt-3">
    <span class="float-left">
        <img src="{{ asset('images/naipod.png') }}" alt="" class="img img-fluid ml-5 " style="width:30px">
    </span>
    <span class="fa fa-close float-right pr-3" @click="mobilenav = false" style="font-size: 30px"></span>
</div>

  <div class="mt-5 " style="height: 80vh;font-size: 17px;overflow-y: auto">
    <div class="w-75 ml-auto mr-auto" >
        @livewire('inc.sidenav')
        <br><br><br><br><br><br><br>
        <div class=" text-center fixed-bottom ml-auto mr-auto " >
            <div class="row no-gutters mb-4 mt-3">
                <div class="col-6 card p-0 text-center border-right-0">
                   <span class="">
                    <i class="fas fa-moon" tyle="font-size: 20px"></i>
                    <span class="font-weight-bold" >Dark mode</span>
                   </span>
                   &nbsp;
                </div>
                <div class="col-6 card p-0 text-left border-left-0">

                   <livewire:inc.mode-toggle />
                </div>
            </div>

          </div>
       </div>
  </div>

</div>
