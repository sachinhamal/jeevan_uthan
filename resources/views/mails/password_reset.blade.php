@include('mails.templete.header')

<div>
    <h2 style="font-size: 20px; font-weight: 400; margin-top: 0; margin-bottom: 12px;">
        Hi {{$name }},
    </h2>
    <p style="font-size: 13px; color: #444444; margin-top: 0; margin-bottom: 16px;">
        The following is your password reset link. </p>
    <div align="center">
        <a href="{{route('resetpassword', encrypt($token))}}" style="font-weight: 400; display: inline-block; background-color: #ffb442; color: #FFFFFF; border: 1px solid #ffb442 ; margin: 8px auto auto auto; padding: 12px 28px; border-radius: 2px 2px 2px 2px; text-decoration: none; outline: 0; vertical-align: middle ; line-height: 1; white-space: nowrap; text-align: center; user-select: none; --webkit-user-select: none; -moz-user-select: none; -moz-user-select: none;"> Reset Password</a>
    </div>

</div>


@include('mails.templete.footer')
