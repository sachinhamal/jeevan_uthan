@include('user.layout.header')
@include('user.layout.sidebar')
 <div class="content-wrapper">
    <div class="content">
       @include('user.layout.notification')	
       @yield('contents')
    </div>
</div>
@include('user.layout.footer')