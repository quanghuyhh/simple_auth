@php
    $messages = (session('flash_notification') ?? collect());
@endphp
@foreach ($messages as $message)
    <div class=" {{ $message->getClassName() }} alert rounded-lg py-5 px-6 mb-3 text-base inline-flex items-center w-full alert-dismissible fade show" role="alert">
        {!! $message['message'] !!}
        @if ($message['important'])
            <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline"
                    data-dismiss="alert"
                    aria-hidden="true"
                    aria-label="Close"
            ></button>
        @endif
    </div>
@endforeach

@php
    session_forget('flash_notification');
@endphp

@push('footer')
    <style>
        .btn-close {
            background: url("data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 16 16%22 fill=%22%23000%22%3E%3Cpath d=%22M.293.293a1 1 0 011.414.0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293A1 1 0 01.293 14.293L6.586 8 .293 1.707a1 1 0 010-1.414z%22/%3E%3C/svg%3E")50%/1em no-repeat;
        }
    </style>
    <script type="text/javascript">
        $('.btn-close').on('click', function (e) {
            e.preventDefault();
            $(this).closest('.alert').remove();
        });
    </script>
@endpush