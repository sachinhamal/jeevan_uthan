@include('mails.templete.header')

<div>
    <h2 style="font-size: 20px; font-weight: 400; margin-top: 0; margin-bottom: 12px;">
        Hi {{$name }},
    </h2>
    <p style="font-size: 13px; color: #444444; margin-top: 0; margin-bottom: 16px;">
        The account activation is successful. Enjoy the conversi.
    </p>
</div>

@include('mails.templete.footer')
