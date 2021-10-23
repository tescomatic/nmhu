<div>
    <div class="modal fade" id="exampleModal" tabindex="-1"
    x-data="{tapped:false}"
    aria-labelledby="exampleModalLabel" id="staticBackdrop"

    data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card">
          <div class="modal-header  border-0" style="height:0px">
            {{-- <h4 class="modal-title" id="exampleModalLabel">Better way to search for anything !!</h4> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="modal-body">
              <h5 class="text-center">Tap the button below and speak</h5>
                <div class="mt-3 w-25 ml-auto mr-auto">

        <div :class="{'animated':tapped}" style="width:60px">
        <img src="{{ asset('images/microphone.svg') }}" @click="tapped= !tapped" x-show="!tapped" class="  card rounded-circle shadow img img-fluid">
         <img src="{{ asset('images/speak.svg') }}" x-show="tapped" alt="" width="60" class="  rounded-circle shadow img img-fluid">

        </div>

                </div>

            <h2>JavaScript Speech to Text</h2>
        <p>Click on the below button and speak something...</p>
        <p><button type="button" onclick="">Speech to Text</button> &nbsp; <span id="action"></span></p>
        <div id="output" class="hide"></div>
          </div>
          {{-- <div class="modal-footer">

          </div> --}}
        </div>
      </div>
    </div>
</div>

@push('scripts')
<script>
    $(function(){
      $('#mod').click(function(){
       $('#exampleModal').modal('show');
       //$('#exampleModal').appendTo('body')
      });
     // $('#exampleModal').modal('show');
var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
var recognition = new SpeechRecognition();

// This runs when the speech recognition service starts
recognition.onstart = function() {
    console.log("We are listening. Try speaking into the microphone.");
};

recognition.onspeechend = function() {
    // when user is done speaking
    recognition.stop();
}

// This runs when the speech recognition service returns result
recognition.onresult = function(event) {
    var transcript = event.results[0][0].transcript;
    var confidence = event.results[0][0].confidence;
};

// start recognition
recognition.start();


    })
   </script>

@endpush
