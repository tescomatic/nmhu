var wavesurfer;
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
var to_loop = []

// function isInViewport(element) {

//     if (!element) {
//         return;
//     }
//     const rect = element.getBoundingClientRect();
//     return (
//         rect.top >= 0 &&
//         rect.left >= 0 &&
//         rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
//         rect.right <= (window.innerWidth || document.documentElement.clientWidth)
//     );
// }

// $(window).on('scroll', function() {

//     copy.forEach((element, index) => {
//         elem = document.querySelector('#waveform' + index);
//        // if (isInViewport(elem)) {
//             if (elem.innerHTML == '') {
//                 draw(index);
//             }
//         // } else {

//         // }

//     });
// });


// function input() {
//     document.querySelectorAll(".__range").forEach(function(el) {
//         el.oninput = function() {
//             var valPercent = (el.valueAsNumber - parseInt(el.min)) /
//                 (parseInt(el.max) - parseInt(el.min));
//             var style = 'background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, color-stop(' + valPercent + ', #F57D4E), color-stop(' + valPercent + ', #f5f6f8));';
//             el.style = style;
//         };
//         el.oninput();
//     });
// }


window.livewire.on('remake', songss => {
    init(songss);

    return null;
})

function remake(songss) {


    songs = songss;
    return null;

}

function init(song) {
    songs = song;


    indexes = songs.map((element, index) => { return index })
    if (!old_indexes.length) {
        old_indexes = [...indexes];
        to_loop = old_indexes
    } else {
        to_loop = indexes.filter((element, index) => {
            return old_indexes.indexOf(element) === -1
        })
        old_indexes = old_indexes.concat(to_loop);

    }


    for (let index = 0; index < to_loop.length; index++) {
        elem = document.querySelector('#waveform' + to_loop[index]);

        if (elem.innerHTML == '') {

            draw(to_loop[index]);
        }

    }
    // input();
    // elem = null;
    to_loop = null;
    if (playIcon == '') {
        playIcon = document.querySelector('#playerbtn');
    }

    console.log(waves)
    return null;

}

// function wave(id) {


//     toplay = `{{ asset('${songs[id].file}') }}`;
//     wavesurfer.load(toplay);
// }


function player_wave(id, where) {

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
            document.querySelector('#list-icon' + last_played).click();


        }

        return;
    }


    last_played = id;

    return null;
}


function make(id, where) {
    if (waves[last_played]) {
        waves[last_played].pause();

    }
    if (playerwave != '' || isFinished) {

        if (playerwave.isPlaying()) {


            noClickp = true;
            playIcon.click();

        } else {

        }
        playerwave.destroy();


    }

    document.querySelector('#player-container').classList.remove('d-none');
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

    playerwave.load("http://127.0.0.1:8000/" + songs[id].file);
    document.querySelector('#player-thumb').src = `http://127.0.0.1:8000/images/${songs[id].images}`;
    playerwave.setVolume(vol);
    playerwave.on('ready', function() {
        if (waves[id].getCurrentTime() > 0) {
            playerwave.setCurrentTime(waves[id].getCurrentTime());
        }

        playerwave.play();
        waves[id].play();

        ans = new Date(playerwave.getDuration() * 1000).toISOString().substr(14, 5);

        document.querySelector('#current_dura').innerText = ans;
        document.querySelector('#td' + id).innerText = ans

    });

    playerwave.on('audioprocess', function() {
        ans = new Date(playerwave.getCurrentTime() * 1000).toISOString().substr(14, 5);
        document.querySelector('#total_dura').innerText = ans;
        document.querySelector('#progres').style.width = (playerwave.getCurrentTime() / playerwave
            .getDuration()) * 100 + '%';
        document.querySelector('#cd' + id).innerText = ans
            //waves[id].setCurrentTime(playerwave.getCurrentTime());;
    });


    playerwave.on('seek', function() {
        waves[last_played].play(playerwave.getCurrentTime());
        if (playerwave.isPlaying()) {
            playerwave.play();
        }
    });


    playerwave.on('finish', function() {
        console.log(noClickl, noClickl)
        document.querySelector('#cd' + id).innerText = '00:00'
        next = document.querySelector('#list-icon' + (id + 1))
        playerwave.stop();
        waves[id].stop();


        isFinished = true
        if (next) {
            noClickl = true;
            playerwave.stop()
            isFinished = false
            next.click();
            return;
        } else {

            playerwave.stop();
            document.querySelector('#list-icon' + 0).click()
        }



        //document.querySelector('#playerbtn').click();
    });

    return null;
}



function draw(id) {

    wavesurfer = WaveSurfer.create({
        container: '#waveform' + id,
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

    waves[id] = wavesurfer;
    toplay = `http://127.0.0.1:8000/${songs[id].file}`;
    waves[id].load(toplay);

    waves[id].on('seek', function() {
        if (waves[id].isPlaying()) {
            waves[id].play();
        }

        if (!waves[id].isPlaying() || !waves[id].getCurrentTime() && playerwave == '') {
            time = waves[id].getCurrentTime();
            document.querySelector('#list-icon' + id).click();
            playerwave.setCurrentTime(time);
            waves[id].setCurrentTime(time);
        }

        if (playerwave != '' && waves[id].isPlaying()) {
            playerwave.setCurrentTime(waves[id].getCurrentTime());
        }


    })

    waves[id].on('ready', function() {
        ans = new Date(waves[id].getDuration() * 1000).toISOString().substr(14, 5);
        document.querySelector('#cd' + id).innerText = '0:0';
        document.querySelector('#td' + id).innerText = ans;

        document.querySelectorAll('.w' + id).forEach(element => {
            element.classList.toggle('d-none')
        });

    });

    waves[id].on('audioprocess', function() {

    });

    waves[id].setMute(true);
    return null;
}


function play(id) {

    if (waves[id]) {
        waves[id].playPause();
        if (waves[last_played] && last_played != id) {
            waves[last_played].pause();
        }
    }

    last_played = id;

}


function mute() {
    if (playerwave != '') {
        playerwave.toggleMute();
    }
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