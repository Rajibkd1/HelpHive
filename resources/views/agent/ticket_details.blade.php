@extends('agent.sidebar')

@section('sidebar-content')

    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            .fullscreen {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                z-index: 9999;
                background-color: white;
                overflow: auto;
                padding: 2rem;
            }

            .ticket-card {
                transition: all 0.3s ease;
            }

            .attachment-image {
                transition: transform 0.2s ease-in-out;
            }

            .attachment-image:hover {
                transform: scale(1.05);
            }

            .ticket-response {
                position: relative;
            }

            .ticket-response::before {
                content: '';
                position: absolute;
                left: -1px;
                top: 0;
                height: 100%;
                width: 4px;
                background: linear-gradient(to bottom, #667eea, #764ba2);
                border-radius: 4px;
                transition: width 0.2s ease;
            }

            .ticket-response:hover::before {
                width: 6px;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            }
        </style>
    </head>

    <body class="bg-gray-50">
        <div class="max-w-6xl mx-auto p-4 sm:p-6 mt-12 lg:p-8">
            <!-- Header with improved styling -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1
                        class="text-3xl font-bold text-gray-900 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                        Ticket Details</h1>
                    <p class="text-gray-500 mt-1">View and manage support ticket information</p>
                </div>
                <a href="{{ route('agent.tickets-show') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Tickets
                </a>
            </div>

            <!-- Ticket Information with improved styling -->
            <div
                class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden mb-8 ticket-card hover:shadow-xl transition-all">
                <!-- Ticket Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-lg bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm flex items-center justify-center text-white font-bold text-xl shadow-inner">
                                {{ substr($ticket->customer->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-xl">{{ $ticket->customer->name }}</h3>
                                <p class="text-sm opacity-90">{{ $ticket->customer->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm bg-white bg-opacity-20 px-3 py-1 rounded-full">
                                <i class="far fa-clock mr-1"></i>
                                {{ $ticket->created_at->format('m/d/Y H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Ticket Content -->
                <div class="p-6">
                    <div class="text-gray-800 text-2xl font-bold mb-4 border-b pb-4">
                        {{ $ticket->title }}
                    </div>
                    <div class="text-gray-600 leading-relaxed">
                        {{ $ticket->description }}
                    </div>

                    <!-- Metadata Cards -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Department -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <div class="text-xs uppercase text-gray-500 font-semibold mb-1">Department</div>
                            <div class="font-medium text-gray-800 flex items-center">
                                <i class="fas fa-building mr-2 text-blue-500"></i>
                                {{ $ticket->department->name }}
                            </div>
                        </div>

                        <!-- Priority -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <div class="text-xs uppercase text-gray-500 font-semibold mb-1">Priority</div>
                            <div class="font-medium text-gray-800 flex items-center">
                                @php
                                    $priorityColor =
                                        [
                                            'low' => 'text-green-500',
                                            'medium' => 'text-yellow-500',
                                            'high' => 'text-orange-500',
                                            'urgent' => 'text-red-500',
                                        ][$ticket->priority] ?? 'text-blue-500';

                                    $priorityIcon =
                                        [
                                            'low' => 'fa-arrow-down',
                                            'medium' => 'fa-equals',
                                            'high' => 'fa-arrow-up',
                                            'urgent' => 'fa-exclamation',
                                        ][$ticket->priority] ?? 'fa-circle';
                                @endphp
                                <i class="fas {{ $priorityIcon }} mr-2 {{ $priorityColor }}"></i>
                                {{ ucfirst($ticket->priority) }}
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <div class="text-xs uppercase text-gray-500 font-semibold mb-1">Status</div>
                            <div class="font-medium text-gray-800 flex items-center">
                                @php
                                    $statusColor =
                                        [
                                            'open' => 'text-green-500',
                                            'in_progress' => 'text-blue-500',
                                            'pending' => 'text-yellow-500',
                                            'resolved' => 'text-purple-500',
                                            'closed' => 'text-gray-500',
                                        ][$ticket->status] ?? 'text-blue-500';

                                    $statusIcon =
                                        [
                                            'open' => 'fa-envelope-open',
                                            'in_progress' => 'fa-spinner',
                                            'pending' => 'fa-clock',
                                            'resolved' => 'fa-check-circle',
                                            'closed' => 'fa-times-circle',
                                        ][$ticket->status] ?? 'fa-circle';
                                @endphp
                                <i class="fas {{ $statusIcon }} mr-2 {{ $statusColor }}"></i>
                                {{ ucfirst($ticket->status) }}
                            </div>
                        </div>

                        <!-- Assigned Agent -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <div class="text-xs uppercase text-gray-500 font-semibold mb-1">Assigned Agent</div>
                            <div class="font-medium text-gray-800 flex items-center">
                                <i class="fas fa-user-tie mr-2 text-purple-500"></i>
                                {{ $ticket->agent ? $ticket->agent->name : 'No agent assigned' }}
                            </div>
                        </div>
                    </div>

                    <!-- Show Attachments (if any) with improved styling -->
                    @if ($ticket->uploads->count() > 0)
                        <div class="mt-8 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h4 class="font-semibold text-gray-700 mb-3">
                                <i class="fas fa-paperclip mr-2 text-blue-500"></i>
                                Attachments ({{ $ticket->uploads->count() }})
                            </h4>
                            <ul class="flex flex-wrap gap-4">
                                @foreach ($ticket->uploads as $upload)
                                    @php
                                        $filePath = asset('storage/' . $upload->file_path);
                                        $extension = pathinfo($upload->file_path, PATHINFO_EXTENSION);
                                        $fileName = pathinfo($upload->file_path, PATHINFO_FILENAME);
                                    @endphp

                                    <li class="group relative">
                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                            <div
                                                class="w-48 h-48 overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-all">
                                                <img src="{{ $filePath }}" alt="{{ $fileName }}"
                                                    class="w-full h-full object-cover attachment-image cursor-pointer"
                                                    onclick="toggleFullscreen(this)">
                                            </div>
                                            <div
                                                class="absolute bottom-2 left-2 right-2 bg-black bg-opacity-60 text-white text-xs p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity text-center truncate">
                                                {{ $fileName }}.{{ $extension }}
                                            </div>
                                        @elseif($extension == 'pdf')
                                            <a href="{{ $filePath }}"
                                                class="flex flex-col items-center p-4 bg-white border rounded-lg shadow-md hover:shadow-lg transition-all w-48 h-48"
                                                target="_blank">
                                                <i class="fas fa-file-pdf text-red-500 text-4xl mb-2"></i>
                                                <span
                                                    class="text-sm text-gray-700 text-center truncate w-full">{{ $fileName }}.{{ $extension }}</span>
                                                <span class="mt-2 text-xs text-blue-500">View PDF</span>
                                            </a>
                                        @else
                                            <a href="{{ $filePath }}"
                                                class="flex flex-col items-center p-4 bg-white border rounded-lg shadow-md hover:shadow-lg transition-all w-48 h-48"
                                                target="_blank">
                                                <i class="fas fa-file text-blue-500 text-4xl mb-2"></i>
                                                <span
                                                    class="text-sm text-gray-700 text-center truncate w-full">{{ $fileName }}.{{ $extension }}</span>
                                                <span class="mt-2 text-xs text-blue-500">Download File</span>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Reply Button -->
            <div class="flex justify-center mb-8">
                <button id="replyButton"
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-full shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-reply"></i>
                    Reply to Ticket
                </button>
            </div>

            <!-- Ticket Responses with improved styling -->
            <div class="mt-6 space-y-6">
                <h3 class="text-xl font-bold text-gray-800 pl-4 border-l-4 border-purple-500">
                    Conversation History
                </h3>

                @if ($ticket->responses->isEmpty())
                    <div class="bg-gray-50 p-8 rounded-lg text-center text-gray-500">
                        <i class="fas fa-comments text-4xl mb-3 text-gray-300"></i>
                        <p>No responses yet. Be the first to reply!</p>
                    </div>
                @endif

                @foreach ($ticket->responses as $response)
                    <div class="bg-white p-6 rounded-xl shadow-md ticket-response border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
                                    {{ substr($response->agent->name ?? ($response->customer->name ?? 'Unknown'), 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-lg">
                                        {{ $response->agent->name ?? ($response->customer->name ?? 'Unknown') }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $response->created_at->format('m/d/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                            {{ $response->response }}
                        </div>

                        <!-- Show attachment (if any) in response with improved styling -->
                        @if ($response->file_path)
                            @php
                                $respFilePath = asset('storage/' . $response->file_path);
                                $respExtension = pathinfo($response->file_path, PATHINFO_EXTENSION);
                                $respFileName = pathinfo($response->file_path, PATHINFO_FILENAME);
                            @endphp

                            <div class="mt-4">
                                @if (in_array($respExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                    <div class="mt-3 p-2 bg-gray-50 rounded-lg inline-block">
                                        <div class="text-xs text-gray-500 mb-1">Attached Image:</div>
                                        <img src="{{ $respFilePath }}" alt="{{ $respFileName }}"
                                            class="max-w-md rounded-lg shadow-sm hover:shadow-md transition-all cursor-pointer"
                                            onclick="toggleFullscreen(this)">
                                    </div>
                                @elseif($respExtension == 'pdf')
                                    <a href="{{ $respFilePath }}"
                                        class="mt-3 flex items-center gap-2 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors inline-block"
                                        target="_blank">
                                        <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                        <span
                                            class="text-blue-500 hover:underline">{{ $respFileName }}.{{ $respExtension }}</span>
                                    </a>
                                @else
                                    <a href="{{ $respFilePath }}"
                                        class="mt-3 flex items-center gap-2 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors inline-block"
                                        target="_blank">
                                        <i class="fas fa-file-download text-blue-500 text-xl"></i>
                                        <span
                                            class="text-blue-500 hover:underline">{{ $respFileName }}.{{ $respExtension }}</span>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>


            <!-- Include the reply section -->
            @include('agent.ticket_reply')
        </div>

        <script>
            // Function to toggle image between fullscreen and normal size
            function toggleFullscreen(imgElement) {
                if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document
                    .msFullscreenElement) {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) { // Safari
                        document.webkitExitFullscreen();
                    } else if (document.mozCancelFullScreen) { // Firefox
                        document.mozCancelFullScreen();
                    } else if (document.msExitFullscreen) { // IE/Edge
                        document.msExitFullscreen();
                    }
                    imgElement.classList.remove('fullscreen');
                } else {
                    if (imgElement.requestFullscreen) {
                        imgElement.requestFullscreen();
                    } else if (imgElement.mozRequestFullScreen) { // Firefox
                        imgElement.mozRequestFullScreen();
                    } else if (imgElement.webkitRequestFullscreen) { // Chrome/Safari
                        imgElement.webkitRequestFullscreen();
                    } else if (imgElement.msRequestFullscreen) { // IE/Edge
                        imgElement.msRequestFullscreen();
                    }
                    imgElement.classList.add('fullscreen');
                }
            }

            // Toggle the visibility of the reply section when the "Reply" button is clicked
            document.getElementById('replyButton').addEventListener('click', function() {
                const replySection = document.getElementById('replySection');
                replySection.classList.toggle('hidden');

                // Scroll to the reply section
                if (!replySection.classList.contains('hidden')) {
                    replySection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        </script>
    </body>

@endsection
