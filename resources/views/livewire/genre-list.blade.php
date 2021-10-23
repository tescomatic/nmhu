<div class="d-flex">


    {{-- <span class="shadow-lg rounded-circle mr-2 badge  badge-light badge-pill sidenav-icon fa fa-chevron-left"

        onclick="document.getElementById('list').scrollBy({left: 200,behavior: 'smooth'});">
        <span class=""></span>
    </span> --}}
    <span
    style="margin-top: -2px"
         onclick="document.getElementById('list').scrollBy({left: 200,behavior: 'smooth'});"
        class="d-md-none mr-2 sidenav-icon  pointer badge badge-light pl-3 pr-3 p-2 badge-pill shadow-lg border border-secondary">
        <span class="fa fa-chevron-left mt-2"></span>
    </span>

    @foreach ($list as $item)
        <h5 class="mr-2">
            <span class="pointer badge  pl-3 pr-3 p-2 badge-pill shadow-lg border border-secondary"
            >
                {{ $item }}</span>

        </h5>
    @endforeach
    {{-- style="background-color: #085373" --}}
</div>
