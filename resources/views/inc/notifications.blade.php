@if ($message = session()->get('info'))
    <script>
        new Noty({
            type: 'info',
            text: "{{ $message }}"
        }).show()
    </script>
@elseif($message = session()->get('success'))
    <script>
        new Noty({
            type: 'info',
            text: "{{ $message }}"
        }).show()
    </script>
@elseif($message = session()->get('error'))
    <script>
        new Noty({
            type: 'error',
            text: "{{ $message }}"
        }).show()
    </script>
@endif
