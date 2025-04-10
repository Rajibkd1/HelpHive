<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Rotation Login / Signup Box</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Particle background -->
    <div class="particles" id="particles"></div>

    <!-- Modal for displaying success/error messages -->
    <dialog id="messageModal" class="modal">
        <div class="modal-box">
            <div id="successAnimation" style="display: none;">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            </div>
            <h3 class="text-lg font-bold" style="color: crimson;" id="modalTitle">{{ $title ?? 'Error' }}</h3>
            <p class="py-4" style="color: #C4C3CA;" id="modalMessage">{{ $message ?? 'An unexpected error occurred.' }}</p>
            <div class="modal-action" style="text-align: center; margin-top: 20px;">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

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
                                    <input type="email" name="email" class="form-style" placeholder="Your Email" required>
                                    <i class="input-icon material-icons">alternate_email</i>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-style" placeholder="Your Password" required>
                                    <i class="input-icon material-icons">lock</i>
                                </div>

                                <button type="submit" class="btn">
                                    <span>Submit</span>
                                </button>

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
                                    <input type="email" name="email" id="email" class="form-style" placeholder="Your Email" required>
                                    <i class="input-icon material-icons">alternate_email</i>
                                </div>

                                <!-- Send OTP Button -->
                                <button type="button" class="btn" id="send-otp-btn" onclick="sendOtp()">
                                    <span>Send OTP</span>
                                </button>

                                <!-- OTP Verification -->
                                <div id="otp-fields" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" id="otp" name="otp" class="form-style" placeholder="Enter OTP" required>
                                        <i class="input-icon material-icons">lock</i>
                                    </div>
                                    <button type="button" class="btn" onclick="verifyOtp()">
                                        <span>Verify OTP</span>
                                    </button>
                                </div>

                                <!-- Hidden Fields for Name and Password (Initially Hidden) -->
                                <div id="extra-fields" style="display:none;">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-style" placeholder="Your Name" required>
                                        <i class="input-icon material-icons">perm_identity</i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-style" placeholder="Your Password" required>
                                        <i class="input-icon material-icons">lock</i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-style" placeholder="Confirm Password" required>
                                        <i class="input-icon material-icons">lock</i>
                                    </div>
                                    <button type="submit" class="btn">
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Create floating particles
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random size between 5px and 20px
                const size = Math.random() * 15 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Random duration between 10s and 30s
                const duration = Math.random() * 20 + 10;
                particle.style.animationDuration = `${duration}s`;
                
                // Random delay
                const delay = Math.random() * 5;
                particle.style.animationDelay = `${delay}s`;
                
                particlesContainer.appendChild(particle);
            }
        });

        // Function to flip the card
        function flipCard() {
            var checkbox = document.getElementById('reg-log');
            checkbox.checked = !checkbox.checked; // Toggle the checkbox to flip the card
        }

        // Function to open the modal dynamically
        function openModal(title, message, isSuccess = false) {
            const modal = document.getElementById('messageModal');
            const successAnimation = document.getElementById('successAnimation');
            
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalMessage').innerText = message;
            
            // Show success animation if it's a success message
            if (isSuccess) {
                document.getElementById('modalTitle').style.color = '#4bb71b';
                successAnimation.style.display = 'block';
            } else {
                document.getElementById('modalTitle').style.color = 'crimson';
                successAnimation.style.display = 'none';
            }
            
            modal.classList.add('active');
        }

        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById('messageModal');
            modal.classList.remove('active');
        }

        // Send OTP function
        function sendOtp() {
            document.getElementById('loading').style.display = "block";

            const email = document.getElementById('email').value;

            if (!email) {
                openModal('Error', 'Please enter a valid email');
                document.getElementById('loading').style.display = "none";
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
                document.getElementById('loading').style.display = "none";
                if (data.success) {
                    openModal('Success', 'OTP sent successfully. Check your email.', true);
                    document.getElementById('otp-fields').style.display = "block";
                    
                    // Add the animation to the OTP fields
                    const otpFields = document.getElementById('otp-fields');
                    otpFields.style.animation = 'fadeIn 0.5s ease';
                } else {
                    openModal('Error', data.message || "Failed to send OTP.");
                }
            })
            .catch(error => {
                document.getElementById('loading').style.display = "none";
                console.error('Error:', error);
                openModal('Error', 'An error occurred while sending OTP.');
            });
        }

        // Verify OTP function
        function verifyOtp() {
            document.getElementById('loading').style.display = "block";
            const otp = document.getElementById('otp').value;
            const email = document.getElementById('email').value;

            if (!otp) {
                openModal('Error', 'Please enter the OTP');
                document.getElementById('loading').style.display = "none";
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
                document.getElementById('loading').style.display = "none";
                if (data.success) {
                    openModal('Success', 'OTP verified successfully!', true);
                    
                    // Show extra fields with animation
                    const extraFields = document.getElementById('extra-fields');
                    extraFields.style.display = "block";
                    extraFields.style.animation = 'fadeIn 0.5s ease';
                    
                    document.getElementById('otp-fields').style.display = "none";
                } else {
                    openModal('Error', 'Invalid OTP. Please try again.');
                }
            })
            .catch(error => {
                document.getElementById('loading').style.display = "none";
                console.error('Error:', error);
                openModal('Error', 'An error occurred while verifying OTP');
            });
        }

        // Close modal when clicking the button
        document.querySelector('.modal-action button').addEventListener('click', function() {
            closeModal();
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('messageModal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Add smooth reveal animation for form fields
        document.addEventListener('DOMContentLoaded', function() {
            // Add keyframe animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                
                .form-group {
                    animation: fadeIn 0.5s ease forwards;
                    opacity: 0;
                }
            `;
            document.head.appendChild(style);
            
            // Apply staggered animation to form groups
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.animationDelay = `${0.1 * index}s`;
            });
            
            // Apply animation to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach((button, index) => {
                button.style.animation = 'fadeIn 0.5s ease forwards';
                button.style.animationDelay = `${0.3 + (0.1 * index)}s`;
                button.style.opacity = '0';
            });
        });

        // Check for session messages
        @if(session('error'))
            openModal('Error', '{{ session('error') }}');
        @elseif(session('success'))
            openModal('Success', '{{ session('success') }}', true);
        @endif
    </script>

</body>

</html>