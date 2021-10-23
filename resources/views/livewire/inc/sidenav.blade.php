<div>
   <div class="" >
    <ul class="scroll-ul" >
        @foreach ($lists as $list)

             <li class="" @click="mobilenav = false">
                 <img src="{{ asset($list['icon']) }}" alt="" width="20" class="mr-2" >

                 {{-- <span class="{{ $list['icon'] }} mr-2 sidenav-icon"></span> --}}
                 <a href="{{ $list['link'] }}" >{{ $list['name'] }}</a>
                </li>

        @endforeach
     </ul>
   </div>
</div>

