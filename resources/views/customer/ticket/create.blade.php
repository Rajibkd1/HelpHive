@extends('customer.sidebar')

@section('sidebar-content')

    <head>

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            /* Ensure that the parent container of the textarea has full height in fullscreen */
            #ticket-body-container {
                position: relative;
                display: flex;
                flex-direction: column;
                height: 100%;
                /* Take full height */
            }

            /* Fullscreen textarea styles */
            #body {
                resize: none;
                width: 100%;
                transition: height 0.3s;
                min-height: 200px;
                /* Ensure it has some minimum height */
            }
        </style>
    </head>

    <body class="bg-gray-50">
        <div class="max-w-7xl mx-auto p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-semibold text-gray-900">New Ticket</h1>
                <button
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Return to tickets list
                </button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Subject -->
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Subject" required>
                    </div>

                    <!-- Department -->
                    <div class="mb-6">
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <div class="relative">
                            <select id="department" name="department"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 pr-10"
                                required>
                                <option value="" disabled selected>Select an option</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket Body -->
                    <div class="mb-6" id="ticket-body-container">
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Ticket Body</label>
                        <div class="border border-gray-300 rounded-md shadow-sm">
                            <!-- Editor Toolbar -->
                            <div class="border-b border-gray-300 p-2 flex items-center gap-2">
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Undo"
                                    onclick="document.execCommand('undo')">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                </button>
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Redo"
                                    onclick="document.execCommand('redo')">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6" />
                                    </svg>
                                </button>
                                <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Insert image"
                                    onclick="document.getElementById('image-upload').click();">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </button>
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Download"
                                    onclick="document.getElementById('file-upload').click();">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </button>
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Insert link"
                                    onclick="insertLink()">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </button>
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Fullscreen"
                                    onclick="toggleFullscreen()">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" />
                                    </svg>
                                </button>
                                <button type="button" class="p-1.5 hover:bg-gray-100 rounded" title="Insert code"
                                    onclick="insertCode()">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Editor Content -->
                            <textarea id="body" name="body" rows="8"
                                class="w-full px-3 py-2 focus:outline-none focus:ring-0 border-0 resize-none"></textarea>

                            <!-- File Inputs (hidden) -->
                            <input type="file" id="image-upload" class="hidden" accept="image/*" />
                            <input type="file" id="file-upload" name="file[]" class="hidden" multiple />
                        </div>
                    </div>
                    <input type="file" name="file" multiple> <!-- Allow file upload -->
                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Create Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Fullscreen toggle for the ticket body section
            function toggleFullscreen() {
                const ticketBody = document.getElementById('ticket-body-container');
                const textarea = document.getElementById('body');

                if (document.fullscreenElement) {
                    document.exitFullscreen();
                    textarea.style.height = 'auto';
                } else {
                    if (ticketBody.requestFullscreen) {
                        ticketBody.requestFullscreen();
                    } else if (ticketBody.mozRequestFullScreen) { // Firefox
                        ticketBody.mozRequestFullScreen();
                    } else if (ticketBody.webkitRequestFullscreen) { // Chrome/Safari
                        ticketBody.webkitRequestFullscreen();
                    } else if (ticketBody.msRequestFullscreen) { // IE/Edge
                        ticketBody.msRequestFullscreen();
                    }
                    textarea.style.height = 'calc(100vh - 180px)';
                }
            }

            // Handle image upload
            document.getElementById('image-upload').addEventListener('change', function(event) {
                alert('Image uploaded: ' + event.target.files[0].name);
            });

            // Handle file upload
            document.getElementById('file-upload').addEventListener('change', function(event) {
                alert('File uploaded: ' + event.target.files[0].name);
            });

            // Insert link
            function insertLink() {
                const url = prompt("Enter the URL:");
                if (url) {
                    document.execCommand('insertHTML', false, `<a href="${url}" target="_blank">${url}</a>`);
                }
            }

            // Insert code snippet
            function insertCode() {
                const code = prompt("Enter your code:");
                if (code) {
                    document.execCommand('insertHTML', false, `<pre><code>${code}</code></pre>`);
                }
            }
        </script>
    </body>
@endsection


