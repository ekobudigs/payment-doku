{{-- SWAL from server --}}
@if ($swal = session('swal'))
    <script>
        const title = "{{ $swal['title'] }}";
        const text = "{{ $swal['text'] }}";
        const icon = "{{ $swal['icon'] }}";
        const buttonText = "{{ $swal['button'] }}";

        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonText: buttonText,
        })
    </script>
@endif

{{-- SWAL from client --}}
<script>
    function swalConfirm(event) {
        event.preventDefault();

        const clickable = $(event.target);
        const buttonText = clickable.data('button-text') ?? 'OK';
        const title = clickable.data('title') ?? 'Apakah anda yakin?';
        const text = clickable.data('text') ?? 'Tekan ' + buttonText + ' untuk melanjutkan!';
        const icon = clickable.data('icon') ?? 'warning';
        const type = clickable.data('type') ?? 'button';

        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: buttonText
        }).then((result) => {
            if (result.isConfirmed) {
                if (type == 'link') {
                    const href = $(clickable).attr('href');
                    window.location.href = href;
                } else {
                    clickable.parent().submit();
                }
            }
        });
    }
</script>
