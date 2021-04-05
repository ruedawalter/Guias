@include('layouts._head')

</head>

<body>
   
        @include('layouts._nav')
        @include('partials.session-status')
        <main class="py-4">

            @yield('content')
        </main>
    </div>
@include('layouts._scripts')
</body>
    @include('layouts._footer')
    

</html>
