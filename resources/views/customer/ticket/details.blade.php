@extends('customer.sidebar')

@section('sidebar-content')


<head>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .editor-content {
            min-height: 200px;
        }

        .reply-editor {
            display: none;
        }

        .fullscreen .editor-content {
            width: 100vw;
            height: 100vh;
            overflow: auto;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="max-w-6xl mx-auto  p-4 sm:p-6 mt-12 lg:p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Ticket details</h1>
            <a href="{{ route('customer.tickets') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors">
                Return to tickets list
            </a>
        </div>

        <!-- Ticket Thread -->
        <div class="space-y-6">

            <!-- Customer Message -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-700 flex items-center justify-center text-white font-medium">
                            C
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Customer</h3>
                            <p class="text-sm text-gray-500">{{ $ticket->customer->name }} ({{ $ticket->customer->email }})</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-500">{{ $ticket->created_at->format('m/d/Y H:i') }}</span>
                        <button class="text-blue-500 hover:text-blue-600 text-sm font-medium" id="replyButton">Reply</button>
                    </div>
                </div>

                <div class="text-black-600 text-2xl">
                    {{ $ticket->title }}
                </div>
                <div class="text-gray-600">
                    {{ $ticket->description }}
                </div>
        
                <!-- Show Attachments (if any) -->
                @if($ticket->uploads->count() > 0)
                <div class="mt-4">
                    <ul>
                        @foreach($ticket->uploads as $upload)
                        <li>
                            @php
                                $filePath = asset('storage/'.$upload->file_path);
                                $extension = pathinfo($upload->file_path, PATHINFO_EXTENSION);
                            @endphp
        
                            <!-- If the file is an image, display it directly -->
                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                            <img src="{{ $filePath }}" alt="{{ $upload->file_path }}" class="max-w-xs h-auto rounded-md cursor-pointer" onclick="toggleFullscreen(this)">

                            <!-- If it's a PDF, display a link to open the PDF -->
                            @elseif($extension == 'pdf')
                                <a href="{{ $filePath }}" class="text-blue-500 hover:underline" target="_blank">View PDF</a>
                            <!-- For other file types, provide a download link -->
                            @else
                                <a href="{{ $filePath }}" class="text-blue-500 hover:underline" target="_blank">Download File</a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
        
                
            </div>
        
        </div>
        

        <!-- Ticket Responses -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-900">Ticket Responses</h3>
            @foreach($ticket->responses as $response)
            <div class="bg-white p-6 rounded-lg shadow-sm mt-4">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-700 flex items-center justify-center text-white font-medium">
                            A
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Agent</h3>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-500">{{ $response->created_at->format('m/d/Y H:i') }}</span>
                    </div>
                </div>
                <div class="text-gray-600">
                    {{ $response->response }}
                </div>

                <!-- Show attachment (if any) in response -->
                @if($response->file_path)
                <div class="mt-4">
                    <a href="{{ asset('storage/'.$response->file_path) }}" class="text-blue-500 hover:underline" target="_blank">View attachment</a>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Reply Editor (hidden by default) -->
        <div id="replyEditor" class="bg-white rounded-lg shadow-sm border border-gray-200 reply-editor">
            <!-- Toolbar -->
            <div class="border-b border-gray-200 p-2">
                <button id="toggleFullscreen" class="px-4 py-2 text-sm bg-gray-300 rounded-md">Toggle Fullscreen</button>
            </div>

            <!-- Editor Content -->
            <div class="p-4">
                <div class="editor-content" contenteditable="true" class="w-full outline-none"></div>
            </div>

            <!-- Actions -->
            <div class="border-t border-gray-200 p-4 flex justify-between items-center">
                <button class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors">
                    Discard
                </button>
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors">
                    Send reply
                </button>
            </div>
        </div>

        <!-- Show reply editor when reply button clicked -->
        <div class="mt-6">
            <button id="replyButton" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Reply</button>
        </div>
    </div>

    <script>
        // Function to toggle image between fullscreen and normal size
        function toggleFullscreen(imgElement) {
            // Check if the document is already in fullscreen mode
            if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
                // Exit fullscreen mode
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) { // Safari
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) { // Firefox
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) { // IE/Edge
                    document.msExitFullscreen();
                }
    
                // Remove the fullscreen class from the image to revert to its normal size
                imgElement.classList.remove('fullscreen');
            } else {
                // Enter fullscreen mode
                if (imgElement.requestFullscreen) {
                    imgElement.requestFullscreen();
                } else if (imgElement.mozRequestFullScreen) { // Firefox
                    imgElement.mozRequestFullScreen();
                } else if (imgElement.webkitRequestFullscreen) { // Chrome/Safari
                    imgElement.webkitRequestFullscreen();
                } else if (imgElement.msRequestFullscreen) { // IE/Edge
                    imgElement.msRequestFullscreen();
                }
    
                // Add the fullscreen class to the image
                imgElement.classList.add('fullscreen');
            }
        }
    </script>
    
    
    <style>
        /* Ensure images have a fixed size */
        img {
            max-width: 300px;
            max-height: 300px;
            object-fit: contain;
            cursor: pointer;
        }
    
        /* Fullscreen image style */
        img.fullscreen {
            width: 100vw;
            height: 100vh;
            object-fit: contain;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
        }
    </style>
    

    <script>
        // Toggle the visibility of the reply editor when the "Reply" button is clicked
        document.getElementById('replyButton').addEventListener('click', function() {
            const replyEditor = document.getElementById('replyEditor');
            replyEditor.classList.toggle('reply-editor'); // Toggle visibility class
        });

        // Toggle fullscreen for reply editor
        document.getElementById('toggleFullscreen').addEventListener('click', function() {
            const replyEditor = document.getElementById('replyEditor');
            replyEditor.classList.toggle('fullscreen');
        });
    </script>
</body>

@endsection