<script>
    const csrfToken = "{{csrf_token()}}";
    console.log(csrfToken);
</script>
<!-- Jquery JS-->
<script src="{{ asset('assets/cool_dashboard/vendor/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('assets/cool_dashboard/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('assets/cool_dashboard/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/cool_dashboard/vendor/select2/select2.min.js') }}"></script>

{{-- plugins --}}
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
<!-- Main JS-->

<script src="{{ asset('assets/cool_dashboard/js/main.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('scripts')

</body>

</html>
<!-- end document-->
