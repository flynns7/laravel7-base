<script src="/js/plugin.js"></script>

<script src="/js/app.js"></script>

<script src="/js/core.js"></script>

<script src="/js/constant.js"></script>
<script src="/js/listCheatSheetFa.js"></script>

<script>
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(request, status, error) {
            if (status.status == 401) {
                alert("Sesi Login Telah Habis")
                window.location = "{{ route('login') }}"
            }

            if (status.status == 403) {
                toastr.error(request.responseJSON.message ? request.responseJSON.message : request
                    .responseText)
                toastr.error("Mohon Refresh Kembali Halaman")
                return
            }

            toastr.error(request.responseJSON.message ? request.responseJSON.message : request
                .responseText)
        }
    });
</script>
