<script>
    var directionFiles = @json(array_values($counts));
    var directions = @json(array_keys($counts));
</script>
{!! HTML::script('theme/lib/chart.js/Chart.bundle.min.js') !!}
{!! HTML::script('theme/assets/js/directionChart.js') !!}
