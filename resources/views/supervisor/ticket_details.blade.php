@extends('supervisor.sidebar')

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

        .ticket-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .ticket-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .ticket-avatar {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }

        .ticket-response {
            border-left: 4px solid #667eea;
            padding-left: 1rem;
            margin-left: 1rem;
        }

        .ticket-response:hover {
            border-left-color: #764ba2;
        }

        .attachment-icon {
            color: #667eea;
            transition: color 0.2s ease-in-out;
        }

        .attachment-icon:hover {
            color: #764ba2;
        }

        /* Image styling */
        .attachment-image {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .attachment-image:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .attachment-container {
            max-width: 200px; /* Adjust this value to control the image size */
            margin: 0.5rem 0;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="max-w-6xl mx-auto p-4 sm:p-6 mt-12 lg:p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Ticket Details</h1>
            <a href="{{ route('tickets') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors">
                Return to Tickets List
            </a>
        </div>

        <!-- Ticket Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6 ticket-card">

            <div class="ticket-header p-4 -m-6 mb-6 rounded-t-lg">
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg ticket-avatar flex items-center justify-center text-white font-medium">
                            T
                        </div>
                        <div>
                            <h3 class="font-semibold">Ticket</h3>
                            <p class="text-sm opacity-80">{{ $ticket->customer->name }} ({{ $ticket->customer->email }})</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm opacity-80">{{ $ticket->created_at->format('m/d/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="text-black-600 text-2xl font-bold mb-4">
                {{ $ticket->title }}
            </div>
            <div class="text-gray-600">
                {{ $ticket->description }}
            </div>

            <!-- Department, Priority, Status, and Assigned Agent Section -->
            <div class="mt-6 space-y-4">

                <!-- Department -->
                <div class="flex justify-between">
                    <div class="w-1/3">
                        <strong class="text-sm">Department:</strong>
                        <p>{{ $ticket->department->name }}</p>
                    </div>

                    <!-- Priority Dropdown -->
                    <div class="w-1/3">
                        <strong class="text-sm">Priority:</strong>
                        <form action="{{ route('ticket.update.priority', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="priority" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors">
                                Update Priority
                            </button>
                        </form>
                    </div>

                    <!-- Agent Dropdown -->
                    <div class="w-1/3">
                        <strong class="text-sm">Assigned Agent:</strong>
                        <form action="{{ route('ticket.update.assign', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="agent_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors">
                                Update Agent
                            </button>
                        </form>
                    </div>
                </div>

                <div class="w-full">
                    <strong class="text-sm">Status:</strong>
                    <p class="mt-1">{{ ucfirst($ticket->status) }}</p>
                </div>
            </div>

            <!-- Show Attachments (if any) -->
            @if($ticket->uploads->count() > 0)
            <div class="mt-4">
                <ul class="flex flex-wrap gap-4">
                    @foreach($ticket->uploads as $upload)
                    <li class="attachment-container">
                        @php
                            $filePath = asset('storage/'.$upload->file_path);
                            $extension = pathinfo($upload->file_path, PATHINFO_EXTENSION);
                        @endphp

                        <!-- If the file is an image, display it directly -->
                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                        <img src="{{ $filePath }}" alt="{{ $upload->file_path }}" class="attachment-image" onclick="toggleFullscreen(this)">
                        @elseif($extension == 'pdf')
                            <a href="{{ $filePath }}" class="text-blue-500 hover:underline flex items-center gap-2" target="_blank">
                                <i class="fas fa-file-pdf attachment-icon"></i>
                                View PDF
                            </a>
                        @else
                            <a href="{{ $filePath }}" class="text-blue-500 hover:underline flex items-center gap-2" target="_blank">
                                <i class="fas fa-file-download attachment-icon"></i>
                                Download File
                            </a>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- Ticket Responses -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-900">Ticket Responses</h3>
            @foreach($ticket->responses as $response)
            <div class="bg-white p-6 rounded-lg shadow-sm mt-4 ticket-response">
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
                    <a href="{{ asset('storage/'.$response->file_path) }}" class="text-blue-500 hover:underline flex items-center gap-2" target="_blank">
                        <i class="fas fa-paperclip attachment-icon"></i>
                        View attachment
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>

    </div>

    <script>
        // Function to toggle image between fullscreen and normal size
        function toggleFullscreen(imgElement) {
            if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
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
    </script>

</body>

@endsection