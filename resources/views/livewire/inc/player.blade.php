<div id="player-container" data-turbolinks-permanent class="d-none">
    <div class="bg-orange d-md-none" style="height: 3px;width:0%" id="progres"></div>
    <div class=" card d-flex shadow   p-1 ight-divs" x-data="{played:false}">

        <div class="d-flex">
            <div>
                <div class="player-thumbs rounded-circle " :class="{'fa fa-spin':played}">

                    <img id="player-thumb" src="{{ asset('images/amali.jpg') }}" alt="" class="img img-responsive  "
                        style="width: 100%;">
                </div>
            </div>
            <div style="line-height: 2px;" class="mt-2 ml-3">
                <p class="font-weight-bold" id="songTitle"></p>
                <h6 class="sidenav-icon" id="songArtist"></h6>
            </div>

            <div class="w-25 d-md-none"></div>

            <div class="mt-2 ml-4 ">
                <span class="pointer fa fa-step-backward mr-5 mr-md-4 h1 d-none d-md-inline"></span>

                <span @click="played==false ? played=true: played=false" class="pointer fa  mr-5 mr-md-4 h1 "
                    onclick="player_wave('d','player')" id="playerbtn"
                    :class="{'fa-pause-circle':played,'fa-play-circle':!played}">
                </span>
                <span class="pointer fa fa-step-forward h1 d-none d-md-inline" onclick="pausenow()"></span>
            </div>

            <div class="w-25 ml-3 d-none d-md-inline">
                <div id="playerwave" data-turbolink-permanent class=" p-0"></div>
                <div class="mt-0 font-weight-bold">
                    <span class="float-left float-right" id="current_dura"></span>
                    <span id="total_dura"></span>
                </div>
            </div>
            <div class="mt-3 ml-3 d-none d-md-inline " x-data="{mute:false}">
                <span class="pointer h4" x-on:click="mute==false ? mute=true: mute=false" onclick="mute()"
                    :class="{'fa fa-volume-up':!mute,'fa fa-volume-mute':mute}"></span>

                <div class="slidecontainer d-inline ml-1 wave_cont">
                    <input type="range" min="0" max="50" value="50" id="volume" oninput="slider(this)">
                </div>

            </div>
        </div>
    </div>

</div>
