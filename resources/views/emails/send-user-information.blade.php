@component('mail::message')
<div class="fancybox-inner" style="overflow: auto; width: 400px; height: auto;">
    <div id="email" style="text-align: left; width: 400px; display: block;">
        <p>
            Dear New COMPackage User:
        </p>
        <p>
            You have been granted access to the COMPackage employee benefits statement software platform by the account owner.
        </p>
        <p>
            <strong>Step 1: </strong>
            <br>
            Log in at <a href="{{url('/login')}}" target="_blank"> {{url('/')}}</a>. For your very first login, we have sent you a password reset email separately. Your username is: {{$user->username}}
        </p>
        <p>
            <strong>Step 2: </strong>
            <br>
            Once logged in, you will be on the Home Dashboard. Here you will find instructions for using COMPackage.
        </p>
        <p>
            If at any point you need support, please don't hesitate to contact us at support@compackage.com.
        </p>
    </div>
</div>
<br>
Thank you,<br>
Team {{ config('app.name') }}
@endcomponent
