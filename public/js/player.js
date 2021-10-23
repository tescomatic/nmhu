import WaveSurfer from './wavesurfer.js';
var wavesurfers = '';

var playerwave = '';
var waves = [];
var count = 0;
var songs = [];
var last_played = 'd';
var playIcon = '';
var noClickp = false;
var vol = 1;
var time = '';
var isFinished = false;
var indexes = []
var old_indexes = []
var to_loop = [];
var url = "https://naipod.s3.eu-west-3.amazonaws.com/";
var muted = false
var {
    log
} = console;
var last_index = 0;



function drawing(id) {

    songs.forEach((el, index) => {
        if (el.songId == id) {
            toplay = `${url}${el.song}`;
        }
    })
    document.querySelectorAll('.wave_cont').forEach(element => {
        element.classList.remove('d-none')
    });
    if (wavesurfers == '' && document.querySelector('#waveforms' + id) && id != last_played) {
        wavesurfers = WaveSurfer.create({
            container: '#waveforms' + id,
            waveColor: ' rgb(143, 141, 140)',
            progressColor: 'rgb(245,125,78)',
            hideScrollbar: true,
            cursor: false,
            drag: false,
            barWidth: 2,
            height: 30,
            interact: true,
            integer: 1,
            responsive: true,
            cursorWidth: 0,

        });

    } else {

        if (document.querySelectorAll('.loadings')) {
            document.querySelectorAll('.loadings').forEach((el) => {
                el.classList.toggle('d-none');
            })
        }
        wavesurfers.load(toplay);
    }

    // waves[0] = wavesurfer;


    wavesurfers.load(toplay);
    wavesurfers.on('ready', function () {

        ans = new Date(wavesurfers.getDuration() * 1000).toISOString().substr(14, 5);
        document.querySelector('#cd' + id).innerText = '0:0';
        document.querySelector('#td' + id).innerText = ans;
        wavesurfers.setMute(true);
        if (document.querySelectorAll('.loadings')) {
            document.querySelectorAll('.loadings').forEach((el) => {
                el.classList.toggle('d-none');
            })
        }
        document.querySelectorAll('.wave_cont').forEach(element => {
            element.classList.remove('d-none')
        });
    });


}

function init(song, draw = false, push = false, play = false) {
    songs.push(song);

    drawing(song.songId);


}


function player_wave(id, where) {
    document.querySelector('#player-container').classList.remove('d-none');
    if (where == 'list') {
        if (noClickp) {
            noClickp = false;


        } else {
            noClickl = true;

            if (id != "d" && (last_played == 'd' || last_played != 'd') && (playerwave == '' || last_played !=
                    id || isFinished)) {
                isFinished = false;
                make(id, 'list');

            } else {
                playerwave.playPause();
                if (waves[id]) {
                    waves[id].playPause();
                }
            }
            document.querySelector('#playerbtn').click();

        }
    } else if (where == 'player') {
        if (noClickl) {
            noClickl = false

        } else {
            playerwave.playPause();
            if (waves[id]) {
                waves[id].playPause();
            }
            noClickp = true;
            if (document.querySelector('#list-icon' + last_played)) {
                document.querySelector('#list-icon' + last_played).click();
            }



        }

        return;
    }


    last_played = id;
    songs.forEach((el, i) => {
        if (el.songId == id) {
            last_index = i;
        }
    })

    return null;




}

function make(id, where) {
    if (waves[last_played]) {
        waves[last_played].pause();

    }
    if (playerwave != '' || isFinished) {

        if (playerwave.isPlaying()) {


            noClickp = true;
            // playIcon.click();
            document.querySelector('#playerbtn').click();

        } else {

        }
        playerwave.destroy();


    }

    // document.querySelector('#player-container').classList.remove('d-none');
    if (playerwave != '') {
        playerwave.destroy();
    }
    playerwave = WaveSurfer.create({
        container: '#playerwave',
        waveColor: ' rgb(143, 141, 140)',
        progressColor: 'rgb(245,125,78)',
        hideScrollbar: true,
        cursor: false,
        drag: false,
        barWidth: 2,
        height: 30,
        interact: true,
        integer: 1,
        responsive: true,
        cursorWidth: 0,
        fillParent: true
    });


    songs.forEach((el, index) => {

        if (el.songId == id) {
            toplay = `${url}${el.song}`;
            img = `${url}${el.art}`;
            title = el.title;
            artist = el.artist
        }
    })

    playerwave.load(toplay);
    document.querySelector('#player-thumb').src = `${img}`;
    playerwave.setVolume(vol);
    playerwave.on('ready', function () {
        document.querySelector('#songTitle').innerHTML = `${''+title.slice(0,10 | 8 |6 |5 | 3)}`;
        document.querySelector('#songArtist').innerHTML = artist;
        if (wavesurfers.getCurrentTime() > 0) {
            playerwave.setCurrentTime(wavesurfers.getCurrentTime());
        }
        playerwave.setMute(muted);
        log(muted)
        playerwave.play();
        wavesurfers.play();

        ans = new Date(playerwave.getDuration() * 1000).toISOString().substr(14, 5);

        document.querySelector('#current_dura').innerText = ans;
        if (document.querySelector('#tds')) {
            document.querySelector('#tds').innerText = ans
        }


    });

    playerwave.on('audioprocess', function () {
        ans = new Date(playerwave.getCurrentTime() * 1000).toISOString().substr(14, 5);
        document.querySelector('#total_dura').innerText = ans;
        document.querySelector('#progres').style.width = (playerwave.getCurrentTime() / playerwave
            .getDuration()) * 100 + '%';
        if (document.querySelector('#cd' + id)) {
            document.querySelector('#cd' + id).innerText = ans
        }


    });


    playerwave.on('seek', function () {
        wavesurfers.play(playerwave.getCurrentTime());
        if (playerwave.isPlaying()) {
            playerwave.play();
        }
    });


    playerwave.on('finish', function () {

            //document.querySelector('#cd' + id).innerText = '00:00'
            next = songs[last_index + 1]
            playerwave.stop();
            wavesurfers.stop();


            // isFinished = true
            if (next) {
                // wavesurfers.destroy();
                init(songs[last_index + 1], true, true, true);
                make(next.songId);
                // noClickl = true;
                // playerwave.stop()
                // isFinished = false
                // next.click();
                return;
            } else {


                playerwave.load(`${url}${songs[0].song}`);
                //make();
                // document.querySelector('#list-icon' + 0).click()
            }
        }

    )
}




function mute() {
    if (playerwave != '') {
        playerwave.toggleMute();
    }

    muted ? muted = false : muted = true;
}

function slider(d) {
    val = d.value / 5;
    val = '0.' + val;
    val = parseFloat(val);
    if (d.value == 50) {
        val = 1;
    }
    if (playerwave != '') {
        playerwave.setVolume(val);
    }

    vol = val;
}

livewire.on('snack', ([message, color]) => {
    Snackbar.show({
        text: message,
        actionTextColor: 'red',
        pos: 'bottom-right',
        textColor: color,
        customClass: `rounded ${color}`
    });
})


$('.login').on('click', function () {
    showModal();

});


function showModal() {
    $('#loginModal').modal('show');
}

livewire.on('close-login', () => {
    $('#loginModal').modal('hide');
});

livewire.on('closeWindow', () => {
    window.close();
})


