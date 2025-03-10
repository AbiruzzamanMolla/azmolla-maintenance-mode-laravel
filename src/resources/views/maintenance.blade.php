<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $settings->maintenance_title }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background-color: #f8f9fa;
            }

            .maintenance-container {
                max-width: 800px;
                padding: 40px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .maintenance-image {
                max-width: 100%;
                height: auto;
                margin-bottom: 30px;
            }
        </style>
    </head>

    <body>
        <div class="maintenance-container">
            @if ($settings->maintenance_image)
                <img class="maintenance-image" src="{{ asset($settings->maintenance_image) }}" alt="Maintenance">
            @endif

            <h1>{{ $settings->maintenance_title }}</h1>
            <div class="mt-4">
                {!! nl2br(e($settings->maintenance_description)) !!}
            </div>
        </div>
    </body>

</html>
