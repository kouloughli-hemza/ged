<script>
    var files = @json(array_values($counts));
    var months = @json(array_keys($counts));
    var trans = {
        chartLabel: "{{ __('Registration History')  }}",
        new: "{{ __('new') }}",
        user: "{{ __('user') }}",
        users: "{{ __('users') }}"
    };
</script>
{!! HTML::script('theme/lib/chart.js/Chart.bundle.min.js') !!}
{!! HTML::script('theme/assets/js/filesChart.js') !!}
