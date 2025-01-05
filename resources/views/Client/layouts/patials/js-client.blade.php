<script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('client/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('client/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('client/mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('client/mail/contact.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('client/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
@if(Session::has('success'))
    <script>
        $.toast({
            heading: 'Thông báo',
            text: '{{Session::get('success')}}',
            showHideTransition: 'slide',
            icon: 'success',
            position: 'top-center',
        })
    </script>

@endif
@if(Session::has('error'))
<script>
    $.toast({
        heading: 'Thông báo',
        text: '{{Session::get('error')}}',
        showHideTransition: 'slide',
        icon: 'error',
        position: 'top-center',
    })
</script>
@endif
