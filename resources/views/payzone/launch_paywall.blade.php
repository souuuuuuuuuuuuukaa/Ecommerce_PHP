{{-- <!DOCTYPE html>
<html>

<head>
    <title>Redirection vers Payzone</title>
</head>

<body>
    <p>Redirection vers Payzone en cours...</p>

    <form id="openPaywall" action="{{ $paywallUrl }}" method="POST">
        <input type="hidden" name="payload" value='{{ $json_payload }}' />
        <input type="hidden" name="signature" value="{{ $signature }}" />
    </form>
     <form id="openPaywall" action="<?php echo $paywallUrl; ?>" method="POST" target="paywallFrame">
        <input type="hidden" name="payload" value='<?php echo $json_payload; ?>' />
        <input type="hidden" name="signature" value="<?php echo $signature; ?>" />
    </form> 
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("openPaywall");

            // Log form data before submission
            console.log("Submitting form to:", form.action);
            console.log("Payload:", form.querySelector("input[name='payload']").value);
            console.log("Signature:", form.querySelector("input[name='signature']").value);

            // Submit the form
            form.submit();
        });
    </script>
</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <title>Redirection vers Payzone</title>
</head>

<body>
    <p>Redirection vers Payzone en cours...</p>

    <form id="openPaywall" action="{{ $paywallUrl }}" method="POST">
        <input type="hidden" name="payload" value='{{ $json_payload }}' />
        <input type="hidden" name="signature" value="{{ $signature }}" />
    </form>

    <script>
        document.getElementById('openPaywall').submit();
    </script>
</body>

</html>
