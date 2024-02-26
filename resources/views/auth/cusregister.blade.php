<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #508bfc;
        }

        .card {
            width: 100%;
            max-width: 400px; /* Set maximum width for the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 1rem;
            background-color: white;
            overflow: hidden;
            margin: 20px; /* Add some margin to not touch the viewport edges */
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        h3 {
            margin-bottom: 24px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-transform: uppercase; /* Make button text uppercase */
            width: 100%; /* Make buttons span the full container width */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-google {
            background-color: #dd4b39;
            color: white;
            margin-top: 12px; /* Add space between buttons */
        }

        .btn-facebook {
            background-color: #3b5998;
            color: white;
            margin-top: 8px; /* Add space between buttons */
        }

        .form-label {
            display: block; /* Make label a block to create a new line */
            text-align: left;
            margin-bottom: 5px;
            margin-left: 3px; /* Align with the text input */
        }

        .form-outline {
            text-align: left;
        }

        @media (max-width: 576px) {
            /* Responsive adjustments */
            .card-body {
                padding: 15px;
            }

            .btn {
                padding: 10px;
                font-size: 14px;
            }

            .form-control {
                padding: 10px;
            }
        }
    </style>

</head>

<body>

    <form action="/register" method="POST" class="card">
        @csrf

        <div class="card-body">
            <h3>Register</h3>

            <!-- Name input -->
            <div class="form-outline">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required />
            </div>

            <!-- Email input -->
            <div class="form-outline">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required />
            </div>

            <!-- Password input -->
            <div class="form-outline">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>

            <!-- Confirm Password input -->
            <div class="form-outline">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required />
            </div>

            <!-- Register button -->
            <button class="btn btn-primary" type="submit">Register</button>
        </div>
    </form>

</body>
</html>
