@include('mails.templete.header')

<div>
    <h2 style="font-size: 20px; font-weight: 400; margin-top: 0; margin-bottom: 12px;">
        Hi {{$name }},
    </h2>
    <p style="font-size: 13px; color: #444444; margin-top: 0; margin-bottom: 16px;">
        Your registration is completed. Please click the link to get access.
    </p>
    <div align="center">
        <a  href="{{route('confirmation', encrypt($token))}}" style="font-weight: 400; display: inline-block; background-color: #428bca; color: #FFFFFF; border: 1px solid #428bca ; margin: 8px auto auto auto; padding: 12px 28px; border-radius: 2px 2px 2px 2px; text-decoration: none; outline: 0; vertical-align: middle ; line-height: 1; white-space: nowrap; text-align: center; user-select: none; --webkit-user-select: none; -moz-user-select: none; -moz-user-select: none;"> Verify Email</a>
    </div>
</div>

@include('mails.templete.footer')
