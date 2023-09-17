@component('mail::message')
{{-- Title --}}
# Permohonan Reset Kata Sandi
    
@component('mail::panel')
{{-- Description --}}
Silakan klik tombol di bawah ini untuk melanjutkan proses pengaturan ulang kata sandi.
@endcomponent

{{-- Button --}}
@component('mail::button', ['url' => $url])
Reset Kata Sandi
@endcomponent
    
<br>

{{-- Noreply --}}
Ini adalah pesan otomatis. Mohon untuk tidak membalas email ini.

<br>
<br>

{{-- Regard --}}
Terimakasih,

<br>

<strong>{{ config('app.name') }}</strong>
@endcomponent

