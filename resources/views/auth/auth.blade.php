<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Rotation Login / Signup Box</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
     <!-- Modal for displaying success/error messages -->
     <dialog id="messageModal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-red-600" id="modalTitle">{{ $title ?? 'Error' }}</h3>
            <p class="py-4 text-red-500" id="modalMessage">{{ $message ?? 'An unexpected error occurred.' }}</p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        // Function to open the modal dynamically
        function openModal(title, message) {
            const modal = document.getElementById('messageModal');
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalMessage').innerText = message;
            modal.showModal();
        }

        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById('messageModal');
            modal.close();
        }

        @if(session('error'))
            openModal('Error', '{{ session('error') }}');
        @elseif(session('success'))
            openModal('Success', '{{ session('success') }}');
        @endif
    </script>

    <div class="form">
        <div class="text-center">
            <input type="checkbox" class="checkbox" id="reg-log">
            <label for="reg-log"></label>

            <div class="card-3d-wrap">
                <div class="card-3d-wrapper">

                    <!-- Login Form -->
                    <div class="card-front">
                        <div class="center-wrap">
                            <h4 class="heading">Log In</h4>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-style" placeholder="Your Email"
                                        required>
                                    <i class="input-icon material-icons">alternate_email</i>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-style"
                                        placeholder="Your Password" required>
                                    <i class="input-icon material-icons">lock</i>
                                </div>

                                <button type="submit" class="btn">Submit</button>

                                <p class="text-center"><a href="#" class="link">Forgot your password?</a></p>
                            </form>

                            <!-- Enhanced "Don't have an account? Sign Up" Section -->
                            <p class="text-center signup-text">
                                <span class="signup-question">Don't have an account?</span>
                                <a href="javascript:void(0);" class="link signup-link" onclick="flipCard()">
                                    Sign Up <i class="fas fa-arrow-right"></i>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div id="loading" style="display: none;">
                        <div class="spinner"></div>
                    </div>


                    <!-- Registration Form -->
                    <div class="card-back">
                        <div class="center-wrap">
                            <h4 class="heading">Sign Up</h4>
                            <form action="{{ route('register') }}" method="POST" id="register-form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-style"
                                        placeholder="Your Email" required>
                                    <i class="input-icon material-icons">alternate_email</i>
                                </div>

                                <!-- Send OTP Button -->
                                <button type="button" class="btn" id="send-otp-btn" onclick="sendOtp()">Send
                                    OTP</button>

                                <!-- OTP Verification -->
                                <div id="otp-fields" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" id="otp" name="otp" class="form-style"
                                            placeholder="Enter OTP" required>
                                        <i class="input-icon material-icons">lock</i>
                                    </div>
                                    <button type="button" class="btn" onclick="verifyOtp()">Verify OTP</button>
                                </div>

                                <!-- Hidden Fields for Name and Password (Initially Hidden) -->
                                <div id="extra-fields" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-style" placeholder="Your Name"
                                            required>
                                        <i class="input-icon material-icons">perm_identity</i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-style"
                                            placeholder="Your Password" required>
                                        <i class="input-icon material-icons">lock</i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-style"
                                            placeholder="Confirm Password" required>
                                        <i class="input-icon material-icons">lock</i>
                                    </div>
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to flip the card
        function flipCard() {
            var checkbox = document.getElementById('reg-log');
            checkbox.checked = !checkbox.checked; // Toggle the checkbox to flip the card
        }

        function sendOtp() {
            document.getElementById('loading').style.display = "block";

            const email = document.getElementById('email').value;

            if (!email) {
                alert('Please enter a valid email');
                return;
            }

            fetch("{{ route('send-otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("OTP sent successfully. Check your email.");
                        document.getElementById('otp-fields').style.display = "block";
                    } else {
                        alert(data.message || "Failed to send OTP.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while sending OTP.');
                });

        }
        // Send OTP function


        // Verify OTP function
        function verifyOtp() {
            document.getElementById('loading').style.display = "block";
            const otp = document.getElementById('otp').value;
            const email = document.getElementById('email').value;

            if (!otp) {
                alert('Please enter the OTP');
                return;
            }

            fetch("{{ route('verify-otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('extra-fields').style.display = "block";
                        document.getElementById('otp-fields').style.display = "none";
                    } else {
                        alert("Invalid OTP");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while verifying OTP');
                });
        }
    </script>

</body>

</html>
