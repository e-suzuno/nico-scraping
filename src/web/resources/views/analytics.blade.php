@if(config("my-app.google-analytics-id"))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id{{ config("my-app.google-analytics-id") }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ config("my-app.google-analytics-id") }}');
    </script>
@endif
