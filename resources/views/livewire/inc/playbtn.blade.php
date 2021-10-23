<div>
    <button class="btn btn-secondary ml-2 shadow-lg"
        :class="{'btn-play':played =={{ $index }},'btn-play-white':played !={{ $index }}}"
        x-on:click="(played !={{ $index }}) ? played={{ $index }} : played='a'"
        onclick="draw({{ $index }})">
        <span :class="{'fa fa-play' : played !={{ $index }}, 'fa fa-pause':played =={{ $index }}}"></span>

    </button>
</div>
