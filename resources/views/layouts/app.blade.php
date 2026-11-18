<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Propinsi')</title>

    @vite('resources/js/app.js')
</head>
<body>

    <nav class="bg-white p-4 rounded shadow mb-6">
        <a href="propinsi" class="text-blue-600 font-bold mr-4 hover:underline">Propinsi</a>
        <a href="kabkota" class="text-blue-600 font-bold hover:underline">Kab/Kota</a>
    </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

    <script src="{{ asset('assets/js/lazy-load.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#toggle-search-btn').on('click', function () {
            $('#search-container').slideToggle('fast', function () {

            if ($(this).is(':visible')) {
                $(this).find('input').first().focus();
            }
            });
            });
       

        $('#search-container input').on('keyup', function () {
            var keyword = $(this).val().toLowerCase();
            if (keyword === ''){
                $('tbody tr').show();
                return;
            }
            $('tbody tr').each(function(){
                var rowText = $ (this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(keyword) >-1 );
            });
        });
        });
    </script>
    @stack('scripts')

</body>
</html>