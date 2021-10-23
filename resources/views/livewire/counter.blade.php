<div style="top: 0;bottom:0;margin:auto">
        <h1>HEllo my people</h1>
    <button class="btn btn-info" onclick="change()">Change to dark</button>

</div>
@push('scripts')
    <script>
        function change(){

            element=document.body;
            element.classList.toggle("dark");
        }
    </script>
@endpush
