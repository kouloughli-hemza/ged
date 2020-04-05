<script>
    var yDataSet = @json($yDataSet);
    var xDataSet = @json($xDataSet);


    var directionFilesBar = @json(array_values($counts));
    var directionsBar = @json(array_keys($counts));

    // Get the Best direction Name And total Documents
    var directionsBest = @json(array_values(array_slice($counts, -1))[0]);
    var directionsBestCount = @json(array_values(array_slice($counts, -1))[0]);

    // Get the worst direction Name And total Documents
    var directionsWorst = @json(reset($counts));
    var directionsWorstCount = @json(key($counts));
</script>
{!! HTML::script('theme/lib/chart.js/Chart.bundle.min.js') !!}
{!! HTML::script('theme/assets/js/documents-by-direction.js') !!}
