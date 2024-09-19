<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Password Recovery</title>
    <style>


    .container {
    width: 80%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}
.headerrr{
    padding: 2%;
}

.headerr {
    background-color: #34a853;
    color: white;
    padding: 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

/* Heading Styles */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Form Section Styles */
div {
    margin-bottom: 20px;
}

/* Label Styles */
label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

/* Input Styles */
input[type="email"],
input[type="text"],
input[type="password"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="email"]:focus,
input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
}

/* Button Styles */
button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 2%;
    margin-left: 40%;
}

button:hover {
    background-color: #0056b3;
}

/* Hidden Class */
.hidden {
    display: none;
}

/* Security Question and New Password Sections */
#security-question-section,
#new-password-section {
    margin-top: 20px;
}

#security-question {
    font-weight: bold;
    margin-bottom: 10px;
}
    </style>
</head>


<body>

<header class="headerrr">
            <nav>
                <ul>
                    <a href="{{ route('about.layout') }}">
                        <img src="/image/billnwow-logo.png" class="billnwow-logo" alt="NWOW Philippines Storefront" style="margin-top:-1.3%;margin-left: 28%;">
                    </a>
                </ul>
            </nav>
        </header>  

    <div class="container">
        <h2>Password Recovery</h2>

        <!-- Email Input Form -->
        <div id="email-section">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter your email" />
            <button id="submit-email">Submit Email</button>
        </div>

        <!-- Security Question Form (hidden by default) -->
        <div id="security-question-section" class="hidden">
            <label for="security-question">Security Question:</label>
            <p id="security-question"></p>
            <input type="text" id="security-answer" placeholder="Answer to the security question" />
            <button id="submit-answer">Submit Answer</button>
        </div>

        <!-- New Password Form (hidden by default) -->
        <div id="new-password-section" class="hidden">
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" placeholder="Enter new password" />
            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" placeholder="Confirm new password" />
            <button id="submit-password">Submit New Password</button>
        </div>
    </div>

    <script>
            document.addEventListener('DOMContentLoaded', function () {
    let userEmail = '';
    let questionId = '';

    // Event listener for submitting email
    document.getElementById("submit-email").addEventListener("click", function () {
        userEmail = document.getElementById("email").value.trim();
        
        fetch('{{ route('security.question') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: userEmail })
        })
        .then(response => response.json())
        .then(data => {
            if (data.question) {
                document.getElementById("email-section").classList.add("hidden");
                document.getElementById("security-question").innerText = data.question;
                questionId = data.question_id; // Store question ID for later
                document.getElementById("security-question-section").classList.remove("hidden");
            } else {
                alert("No account found with that email address.");
            }
        })
        .catch(error => {
            console.error('Email Error:', error);
            alert("There was an error processing your request. Please try again.");
        });
    });

    // Event listener for answering the security question
    document.getElementById("submit-answer").addEventListener("click", function () {
        const answer = document.getElementById("security-answer").value.trim();

        fetch('{{ route('validate.answer') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ answer, question_id: questionId, email: userEmail })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById("security-question-section").classList.add("hidden");
                document.getElementById("new-password-section").classList.remove("hidden");
            } else {
                alert("Incorrect answer. Please try again.");
            }
        })
        .catch(error => {
            console.error('Answer Error:', error);
            alert("There was an error processing your request. Please try again.");
        });
    });

    // Event listener for submitting the new password
    document.getElementById("submit-password").addEventListener("click", function () {
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        if (newPassword === confirmPassword && newPassword.length >= 8) {
            fetch('{{ route('update.password') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: userEmail, password: newPassword })
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = "{{ route('changeforgotpassword.show') }}";
                } else {
                    alert("Error updating password. Please try again.");
                }
            })
            .catch(error => {
                console.error('Password Error:', error);
                alert("There was an error processing your request. Please try again.");
            });
        } else {
            alert("Passwords do not match or are less than 8 characters.");
        }
    });
});

    </script>
</body>
</html>
