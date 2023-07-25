<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Voting System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f9f9f9;
        }
        .container {
            margin-top: 30px;
            text-align: center;
        }
        .card {
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .vote-btn {
            width: 100%;
        }
        .vote-btn i {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Digital Voting System</h2>
    <div class="row">
        @foreach($projects as $project)
        <div class="col-md-6 mb-3">
            <div class="card">
                <h2>{{ $project->name }}</h2>
                <p>
                    {{ $project->description }}
                </p>
                <div class="btn-group-vertical">
                    <button type="button" class="btn btn-outline-primary vote-btn" onclick="vote({{ $project->id }},'up')"><i class="far fa-thumbs-up"></i> Agree</button>
                    <button type="button" class="btn btn-outline-primary vote-btn" onclick="vote({{ $project->id }},'down')"><i class="far fa-thumbs-down"></i> Disagree</button>
                     <!-- Add more options as needed -->
                </div>
                <div class="mt-3">
                    <p>Up votes: {{ $project->upvotes }}</p>
                    <p>Down votes: {{ $project->downvotes }}</p>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

<!-- Bootstrap JS (Popper.js and jQuery are required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JavaScript -->
<script>
    function vote(project_id,option) {
        // AJAX call to send the vote data to the Laravel backend
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Successful response from the server
                    alert("Thanks for voting");
                    location.reload()
                } else {
                    // Error handling if the server returns an error
                    alert("Error: Voting failed. Please try again later.");
                }
            }
        };

        // Get the CSRF token from the meta tag in the head section
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        // Replace "YOUR_LARAVEL_URL" with the URL of your Laravel backend route
        var url = "{{ route('vote') }}";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Set the CSRF token in the request header
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        var data = "option=" + encodeURIComponent(option) + "&project_id=" + encodeURIComponent(project_id);

        xhr.send(data);
    }
</script>


</body>
</html>
