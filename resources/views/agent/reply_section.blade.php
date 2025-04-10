@extends('agent.ticket_details')
@section('reply-section')
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
@endsection