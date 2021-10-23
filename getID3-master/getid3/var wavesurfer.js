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
var to_loop = [];
var url = "https://naipod.s3.eu-west-3.amazonaws.com/";
let { log } = console;



window.livewire.on('remake', songss => {
    init(songss);

    return null;
})

function remake(songss) {


    songs = [...songs, ...songss];
    return null;

}

function init(song, dra = false, push = false) {
    //alert()
    push ? songs.push(song) : songs = [...songs, ...song];


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


    if (dra) {

        draw(0);
    } else {
        return;
        for (let index = 0; index < to_loop.length; index++) {
            elem = document.querySelector('#waveform' + to_loop[index]);

            if (elem.innerHTML == '') {

                draw(to_loop[index]);
            }

        }
    }
    if (playIcon == '') {
        playIcon = document.querySelector('#playerbtn');
    }
    return null;
}

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

    playerwave.load(`${url}${songs[id].file}`);
    document.querySelector('#player-thumb').src = `${url}images/${songs[id].images}`;
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
        if (document.querySelector('#cd' + id)) {
            document.querySelector('#cd' + id).innerText = ans
        }


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
        container: '#waveform' + 0,
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

    waves[0] = wavesurfer;
    toplay = `${url}${songs[0].song}`;
    waves[0].load(toplay);

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
    waves[id].on('audioprocess', function() {});
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

livewire.on('snack', ([message, color]) => { 
    Snackbar.show({
        text: message,
        actionTextColor: 'red',
        pos: 'bottom-right',
        textColor: color,
        customClass: `rounded ${color}`
    });
})


$('.login').on('click', function() {
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