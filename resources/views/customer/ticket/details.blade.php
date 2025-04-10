@extends('customer.sidebar')

@section('sidebar-content')

<head>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #3f37c9;
            --secondary: #f0f4ff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --card-bg: #ffffff;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-outline {
            border: 1px solid var(--border);
            color: var(--text-secondary);
            background-color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline:hover {
            background-color: var(--secondary);
            color: var(--primary);
        }

        .avatar {
            border-radius: 50%;
            object-fit: cover;
        }

        .editor-content {
            min-height: 200px;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .reply-editor {
            display: none;
        }

        .attachment {
            display: inline-flex;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: var(--secondary);
            color: var(--primary);
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            transition: all 0.2s ease;
        }

        .attachment:hover {
            background-color: #e6ebff;
        }

        .image-preview {
            border-radius: 0.75rem;
            overflow: hidden;
            position: relative;
            max-width: 300px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        .fullscreen .editor-content {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background-color: white;
            padding: 2rem;
            overflow: auto;
        }

        .conversation-bubble {
            position: relative;
            padding: 1.25rem;
            border-radius: 1rem;
            background-color: white;
        }

        .conversation-bubble.customer {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
        }

        .conversation-bubble.agent {
            background-color: #f8f9fa;
            border-left: 4px solid #8b5cf6;
        }

        .timeline-connector {
            position: absolute;
            left: 24px;
            top: 100%;
            width: 2px;
            height: 2rem;
            background-color: #e2e8f0;
        }

        .attachment-preview {
            border-radius: 0.5rem;
            overflow: hidden;
            margin-top: 1rem;
            background-color: var(--secondary);
            padding: 0.75rem;
            display: inline-block;
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            background-color: #f9fafb;
            border-radius: 1rem;
            margin: 2rem 0;
            color: var(--text-secondary);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header with animated gradient background -->
        <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-xl p-6 mb-8 shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 bg-white opacity-10 wave-pattern"></div>
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">Ticket Details</h1>
                    <p class="text-indigo-100 mt-1 font-medium">View and manage your support conversation</p>
                </div>
                <a href="{{ route('customer.tickets') }}" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 text-sm font-medium rounded-lg transition-all hover:bg-opacity-90 shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Back to tickets
                </a>
            </div>
        </div>

        <!-- Status Badge Section -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <span class="badge bg-blue-100 text-blue-800">
                    <i class="fas fa-ticket-alt mr-1"></i> Ticket #{{ $ticket->id }}
                </span>
                
                @if($ticket->status == 'open')
                    <span class="badge bg-green-100 text-green-800">
                        <i class="fas fa-circle text-xs mr-1"></i> Open
                    </span>
                @elseif($ticket->status == 'closed')
                    <span class="badge bg-gray-100 text-gray-800">
                        <i class="fas fa-check-circle text-xs mr-1"></i> Closed
                    </span>
                @else
                    <span class="badge bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock text-xs mr-1"></i> {{ ucfirst($ticket->status) }}
                    </span>
                @endif
            </div>
            <span class="text-sm text-gray-500">
                <i class="far fa-calendar-alt mr-1"></i> Created: {{ $ticket->created_at->format('M d, Y H:i') }}
            </span>
        </div>

        <!-- Ticket Original Message -->
        <div class="card p-6 mb-8 conversation-bubble customer">
            <div class="flex justify-between items-start mb-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-medium border-2 border-white shadow-md overflow-hidden">
                        <img src="{{ session('user')->profile_picture ? asset('storage/' . session('user')->profile_picture) : asset('default.png') }}"
                        alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-lg">{{ $ticket->customer->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $ticket->customer->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button class="btn-primary" id="replyButton">
                        <i class="fas fa-reply mr-1"></i> Reply
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $ticket->title }}</h2>
                <div class="text-gray-700 leading-relaxed bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                    {{ $ticket->description }}
                </div>
            </div>
            
            <!-- Show Attachments (if any) with improved styling -->
            @if($ticket->uploads->count() > 0)
            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($ticket->uploads as $upload)
                @php
                    $filePath = asset('storage/'.$upload->file_path);
                    $extension = pathinfo($upload->file_path, PATHINFO_EXTENSION);
                    $fileName = pathinfo($upload->file_path, PATHINFO_FILENAME);
                @endphp

                <div class="attachment-container">
                    <!-- If the file is an image, display it with fancy hover effect -->
                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <div class="image-preview relative group" onclick="toggleFullscreen(this)">
                        <img src="{{ $filePath }}" alt="{{ $fileName }}" class="w-full h-auto rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all rounded-lg">
                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-search-plus text-2xl"></i>
                            </span>
                        </div>
                    </div>
                    
                    <!-- For PDF files -->
                    @elseif($extension == 'pdf')
                    <a href="{{ $filePath }}" class="attachment" target="_blank">
                        <i class="fas fa-file-pdf text-red-500"></i>
                        <span>{{ strlen($fileName) > 15 ? substr($fileName, 0, 15).'...' : $fileName }}.pdf</span>
                    </a>
                    
                    <!-- For other file types -->
                    @else
                    <a href="{{ $filePath }}" class="attachment" target="_blank">
                        <i class="fas fa-file-download text-indigo-500"></i>
                        <span>{{ strlen($fileName) > 15 ? substr($fileName, 0, 15).'...' : $fileName }}.{{ $extension }}</span>
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Conversation History Section -->
        <div class="mt-10">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Conversation History</h3>
            </div>
            
            <!-- Empty state with animation -->
            @if($ticket->responses->isEmpty())
            <div class="empty-state">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-comment-dots text-3xl text-gray-400"></i>
                </div>
                <h4 class="text-lg font-medium text-gray-700 mb-2">No responses yet</h4>
                <p class="text-gray-500">Be the first to reply to this ticket</p>
            </div>
            @endif
            
            <!-- Conversation Thread with Timeline -->
            <div class="space-y-6 relative">
                @foreach($ticket->responses as $index => $response)
                <div class="card p-6 conversation-bubble {{ $response->agent ? 'agent' : 'customer' }} relative">
                    <!-- Timeline connector between messages -->
                    @if($index < count($ticket->responses) - 1)
                    <div class="timeline-connector"></div>
                    @endif
                    
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r {{ $response->agent ? 'from-purple-500 to-indigo-500' : 'from-blue-500 to-cyan-500' }} flex items-center justify-center text-white font-bold shadow-md">
                                {{ substr($response->agent->name ?? $response->customer->name ?? 'Unknown', 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $response->agent->name ?? $response->customer->name ?? 'Unknown' }}</h3>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-clock mr-1"></i>
                                    <time>{{ $response->created_at->format('M d, Y H:i') }}</time>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-gray-700 leading-relaxed bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                        {{ $response->response }}
                    </div>

                    <!-- Show attachment (if any) in response with improved styling -->
                    @if($response->file_path)
                        @php
                            $respFilePath = asset('storage/'.$response->file_path);
                            $respExtension = pathinfo($response->file_path, PATHINFO_EXTENSION);
                            $respFileName = pathinfo($response->file_path, PATHINFO_FILENAME);
                        @endphp

                        <div class="mt-4">
                            @if(in_array($respExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                <div class="attachment-preview">
                                    <div class="text-xs text-gray-500 mb-2">Attachment</div>
                                    <div class="image-preview relative group" onclick="toggleFullscreen(this)">
                                        <img src="{{ $respFilePath }}" alt="{{ $respFileName }}" class="max-w-xs rounded-lg shadow-sm">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all rounded-lg">
                                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                                <i class="fas fa-search-plus text-xl"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @elseif($respExtension == 'pdf')
                                <a href="{{ $respFilePath }}" class="attachment" target="_blank">
                                    <i class="fas fa-file-pdf text-red-500"></i>
                                    <span>{{ strlen($respFileName) > 20 ? substr($respFileName, 0, 20).'...' : $respFileName }}.{{ $respExtension }}</span>
                                </a>
                            @else
                                <a href="{{ $respFilePath }}" class="attachment" target="_blank">
                                    <i class="fas fa-file-download text-blue-500"></i>
                                    <span>{{ strlen($respFileName) > 20 ? substr($respFileName, 0, 20).'...' : $respFileName }}.{{ $respExtension }}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

           <!-- Include the reply section -->
           @include('customer.ticket.ticket_reply')
    </div>

    <script>
        // Function to toggle image between fullscreen and normal size with animation
        function toggleFullscreen(element) {
            // Find the img element within the container if it's not the img itself
            const imgElement = element.tagName === 'IMG' ? element : element.querySelector('img');
            
            // Check if already in fullscreen
            if (document.fullscreenElement) {
                // Exit fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                
                // Remove fullscreen class
                imgElement.classList.remove('fullscreen');
            } else {
                // Create a div for fullscreen view
                const fullscreenContainer = document.createElement('div');
                fullscreenContainer.style.position = 'fixed';
                fullscreenContainer.style.top = '0';
                fullscreenContainer.style.left = '0';
                fullscreenContainer.style.width = '100vw';
                fullscreenContainer.style.height = '100vh';
                fullscreenContainer.style.backgroundColor = 'rgba(0,0,0,0.9)';
                fullscreenContainer.style.zIndex = '9999';
                fullscreenContainer.style.display = 'flex';
                fullscreenContainer.style.alignItems = 'center';
                fullscreenContainer.style.justifyContent = 'center';
                fullscreenContainer.style.cursor = 'pointer';
                fullscreenContainer.style.padding = '2rem';
                
                // Clone the image for the fullscreen view
                const clonedImg = imgElement.cloneNode(true);
                clonedImg.style.maxWidth = '90%';
                clonedImg.style.maxHeight = '90%';
                clonedImg.style.objectFit = 'contain';
                clonedImg.style.borderRadius = '0.5rem';
                clonedImg.style.boxShadow = '0 0 30px rgba(0,0,0,0.3)';
                
                // Add close button
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '<i class="fas fa-times"></i>';
                closeBtn.style.position = 'absolute';
                closeBtn.style.top = '1rem';
                closeBtn.style.right = '1rem';
                closeBtn.style.background = 'white';
                closeBtn.style.color = 'black';
                closeBtn.style.borderRadius = '50%';
                closeBtn.style.width = '2.5rem';
                closeBtn.style.height = '2.5rem';
                closeBtn.style.display = 'flex';
                closeBtn.style.alignItems = 'center';
                closeBtn.style.justifyContent = 'center';
                closeBtn.style.cursor = 'pointer';
                closeBtn.style.border = 'none';
                closeBtn.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
                
                // Append elements
                fullscreenContainer.appendChild(clonedImg);
                fullscreenContainer.appendChild(closeBtn);
                document.body.appendChild(fullscreenContainer);
                
                // Event listeners to close
                closeBtn.addEventListener('click', function() {
                    document.body.removeChild(fullscreenContainer);
                });
                
                fullscreenContainer.addEventListener('click', function(e) {
                    if (e.target === fullscreenContainer) {
                        document.body.removeChild(fullscreenContainer);
                    }
                });
            }
        }

        // Toggle the visibility of the reply section when the "Reply" button is clicked
        document.getElementById('replyButton').addEventListener('click', function() {
                const replySection = document.getElementById('customerReplySection');
                replySection.classList.toggle('hidden');

                // Scroll to the reply section
                if (!replySection.classList.contains('hidden')) {
                    replySection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });

        // Toggle fullscreen for reply editor
        document.getElementById('toggleFullscreen').addEventListener('click', function() {
            const replyEditor = document.getElementById('replyEditor');
            replyEditor.classList.toggle('fullscreen');
            
            // Change button text
            const button = this;
            if (replyEditor.classList.contains('fullscreen')) {
                button.innerHTML = '<i class="fas fa-compress"></i> <span>Exit Fullscreen</span>';
            } else {
                button.innerHTML = '<i class="fas fa-expand"></i> <span>Expand Editor</span>';
            }
        });
        
        // Display filename when file is selected
        document.getElementById('attachment').addEventListener('change', function() {
            const fileName = this.files[0]?.name || '';
            document.getElementById('fileName').textContent = fileName;
        });
    </script>
</body>

@endsection