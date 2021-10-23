<div>
    <div class="modal fade" id="loginModal" tabindex="-1" x-data="{tapped:false}" aria-labelledby="exampleModalLabel"
        id="staticBackdrop" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card">
                <div class="modal-header  border-0" >
                    {{-- <h4 class="modal-title" id="exampleModalLabel">Better way to
                        search for anything !!</h4> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true" style="font-size: 40px">&times;</span>

                    </button>

                </div>
                <div class="modal-body">
                    <livewire:inc.log-sign  />
                </div>
                {{-- <div class="modal-footer">

                </div> --}}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>

            $(function() {

                //  showModal();
                //  $('.login').on('click',function(){
                // showModal();

                // });


                // function showModal(){
                //     $('#loginModal').modal('show');
                // }

                // livewire.on('close-login',()=>{
                //      $('#loginModal').modal('hide');
                // })
            })

        </script>
    @endpush
</div>
