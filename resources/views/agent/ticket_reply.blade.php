<div id="replySection" class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 flex items-center justify-center p-6 hidden">
    <div class="w-full max-w-4xl transition-all duration-300" id="contentContainer">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <!-- Header Section -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-90"></div>
                <div class="relative z-10 p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">Ticket Reply</h2>
                            <p class="text-white text-opacity-80">Ticket #{{ $ticket->id }} - Detailed Response</p>
                        </div>
                        <div class="flex space-x-3">
                            <button id="fullscreenToggle" class="bg-white bg-opacity-20 rounded-full p-3 hover:bg-opacity-30 transition-all duration-200">
                                <i class="fas fa-expand text-white text-xl"></i>
                            </button>
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <i class="fas fa-comment-dots text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <form action="{{ route('ticket.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <!-- Text Editor Area -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-inner hover:border-indigo-300 transition-all duration-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Reply Details
                            </label>
                            <div class="bg-white rounded-lg p-2 border border-gray-200 mb-2">
                                <div class="flex flex-wrap items-center space-x-1 mb-2 border-b pb-2">
                                    <button type="button" class="text-gray-600 hover:text-indigo-600 p-2 rounded hover:bg-indigo-50 transition" title="Bold" onclick="document.execCommand('bold');">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="text-gray-600 hover:text-indigo-600 p-2 rounded hover:bg-indigo-50 transition" title="Italic" onclick="document.execCommand('italic');">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="text-gray-600 hover:text-indigo-600 p-2 rounded hover:bg-indigo-50 transition" title="Underline" onclick="document.execCommand('underline');">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <span class="text-gray-300 mx-1">|</span>
                                    <button type="button" id="insertLink" class="text-gray-600 hover:text-indigo-600 p-2 rounded hover:bg-indigo-50 transition" title="Insert Link">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <span class="text-gray-300 mx-1">|</span>
                                    <button type="button" id="undoBtn" class="text-gray-600 hover:text-indigo-600 p-2 rounded hover:bg-indigo-50 transition" title="Undo" onclick="document.execCommand('undo');">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    <button type="button" id="redoBtn" class="text-gray-600 hover:text-indigo-600 p-2 rounded hover:bg-indigo-50 transition" title="Redo" onclick="document.execCommand('redo');">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                </div>
                                <textarea 
                                    name="response" 
                                    id="responseTextarea"
                                    rows="8" 
                                    class="w-full bg-transparent border-none focus:ring-0 resize-none text-gray-800 placeholder-gray-500"
                                    placeholder="Write your detailed response here..."
                                >{{ old('response') }}</textarea>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-indigo-600">
                                    <i class="fas fa-shield-alt mr-1"></i> Auto-saving draft
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span id="charCount">0</span> / 1000 characters
                                </div>
                            </div>
                        </div>

                        <!-- Templates Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-inner hover:border-indigo-300 transition-all duration-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Quick Templates
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                <button type="button" class="template-btn bg-white border rounded-lg p-2 text-center text-xs hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200 hover:shadow-sm">
                                    <i class="fas fa-handshake text-indigo-400 mr-1"></i> Greeting
                                </button>
                                <button type="button" class="template-btn bg-white border rounded-lg p-2 text-center text-xs hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200 hover:shadow-sm">
                                    <i class="fas fa-reply text-indigo-400 mr-1"></i> Follow-up
                                </button>
                                <button type="button" class="template-btn bg-white border rounded-lg p-2 text-center text-xs hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200 hover:shadow-sm">
                                    <i class="fas fa-check-circle text-indigo-400 mr-1"></i> Closing
                                </button>
                                <button type="button" class="template-btn bg-white border rounded-lg p-2 text-center text-xs hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200 hover:shadow-sm">
                                    <i class="fas fa-clock text-indigo-400 mr-1"></i> Delay Notice
                                </button>
                                <button type="button" class="template-btn bg-white border rounded-lg p-2 text-center text-xs hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200 hover:shadow-sm">
                                    <i class="fas fa-thumbs-up text-indigo-400 mr-1"></i> Thank You
                                </button>
                                <button type="button" class="template-btn bg-white border rounded-lg p-2 text-center text-xs hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200 hover:shadow-sm">
                                    <i class="fas fa-plus text-indigo-400 mr-1"></i> Custom
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- File Upload Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-inner hover:border-indigo-300 transition-all duration-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                File Attachments
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center group hover:border-indigo-500 transition-all duration-300">
                                <input 
                                    type="file" 
                                    multiple 
                                    class="hidden" 
                                    id="fileInput"
                                    name="attachments[]"
                                />
                                <label for="fileInput" class="cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4 block group-hover:text-indigo-500 transition"></i>
                                    <p class="text-gray-600 group-hover:text-indigo-600 transition">
                                        Drag and drop files or <span class="font-semibold text-indigo-500">Browse</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Max file size: 10MB | Supported formats: PDF, DOC, JPG, PNG
                                    </p>
                                </label>
                            </div>

                            <div id="filePreviewContainer" class="mt-4 space-y-2 max-h-48 overflow-y-auto pr-2">
                                <!-- File previews will be dynamically added here -->
                            </div>
                        </div>

                        <!-- Status Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-inner hover:border-indigo-300 transition-all duration-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ticket Properties
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="open">Open</option>
                                        <option value="pending" selected>Pending</option>
                                        <option value="resolved">Resolved</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <div class="flex space-x-4">
                        <button 
                            type="button" 
                            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition flex items-center shadow-sm hover:shadow"
                            id="cancelBtn"
                        >
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                        >
                            <i class="fas fa-paper-plane mr-2"></i> Send Reply
                        </button>
                    </div>
                    <div class="flex items-center space-x-2 text-gray-600">
                        <i class="fas fa-lock text-green-500"></i>
                        <span class="text-sm">Secure and encrypted communication</span>
                    </div>
                </div>
            </form>
        </div>

        <!-- Link Dialog -->
        <div id="linkDialog" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Insert Link</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Text</label>
                        <input type="text" id="linkText" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Text to display">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                        <input type="url" id="linkUrl" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="https://example.com">
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button id="cancelLink" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Cancel</button>
                        <button id="insertLinkBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Insert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Show Reply Button (to trigger the reply section) -->
<div id="showReplyBtn" class="fixed bottom-8 right-8 p-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full shadow-lg cursor-pointer hover:shadow-xl transform hover:scale-105 transition-all duration-300">
    <i class="fas fa-reply text-2xl"></i>
</div>

<script>
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const replySection = document.getElementById('replySection');
    const showReplyBtn = document.getElementById('showReplyBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const textarea = document.getElementById('responseTextarea');
    const charCount = document.getElementById('charCount');
    const fullscreenToggle = document.getElementById('fullscreenToggle');
    const contentContainer = document.getElementById('contentContainer');
    const undoBtn = document.getElementById('undoBtn');
    const redoBtn = document.getElementById('redoBtn');
    const insertLinkBtn = document.getElementById('insertLink');
    const linkDialog = document.getElementById('linkDialog');
    const cancelLinkBtn = document.getElementById('cancelLink');
    const confirmLinkBtn = document.getElementById('insertLinkBtn');
    const linkText = document.getElementById('linkText');
    const linkUrl = document.getElementById('linkUrl');
    const fileInput = document.getElementById('fileInput');
    const filePreviewContainer = document.getElementById('filePreviewContainer');
    const templateBtns = document.querySelectorAll('.template-btn');
    
    // Show/Hide Reply Section
    showReplyBtn.addEventListener('click', function() {
        replySection.classList.remove('hidden');
        showReplyBtn.classList.add('hidden');
    });
    
    cancelBtn.addEventListener('click', function() {
        replySection.classList.add('hidden');
        showReplyBtn.classList.remove('hidden');
    });

    // Character count
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
        
        // Limit character count
        if (this.value.length > 1000) {
            this.value = this.value.substr(0, 1000);
            charCount.textContent = 1000;
        }
        
        // Store in local storage
        localStorage.setItem('ticketReplyDraft', this.value);
    });
    
    // Check for saved draft
    const savedDraft = localStorage.getItem('ticketReplyDraft');
    if (savedDraft) {
        textarea.value = savedDraft;
        charCount.textContent = savedDraft.length;
    }

    // File upload handling
    const dropZone = fileInput?.parentElement?.parentElement;
    
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        dropZone.addEventListener('drop', handleDrop, false);
    }
    
    fileInput?.addEventListener('change', function(e) {
        handleFiles(this.files);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight() {
        dropZone.classList.add('border-indigo-500');
        dropZone.classList.add('bg-indigo-50');
    }
    
    function unhighlight() {
        dropZone.classList.remove('border-indigo-500');
        dropZone.classList.remove('bg-indigo-50');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        handleFiles(files);
    }
    
    function handleFiles(files) {
        filePreviewContainer.innerHTML = ''; // Clear previous previews

        Array.from(files).forEach(file => {
            const filePreview = document.createElement('div');
            filePreview.className = 'flex items-center justify-between bg-white border rounded-lg p-3 shadow-sm hover:shadow transition-all duration-200';
            
            filePreview.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="bg-indigo-100 text-indigo-500 p-2 rounded-full">
                        <i class="fas ${getFileIcon(file.name)} text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">${file.name}</p>
                        <p class="text-xs text-gray-500">${formatFileSize(file.size)}</p>
                    </div>
                </div>
                <button type="button" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                    <i class="fas fa-times-circle text-lg"></i>
                </button>
            `;
            filePreviewContainer.appendChild(filePreview);
            
            // Add remove functionality
            const removeBtn = filePreview.querySelector('button');
            removeBtn.addEventListener('click', function() {
                filePreview.remove();
            });
        });
    }

    function getFileIcon(filename) {
        const ext = filename.split('.').pop().toLowerCase();
        switch(ext) {
            case 'pdf': return 'fa-file-pdf';
            case 'doc':
            case 'docx': return 'fa-file-word';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif': return 'fa-file-image';
            case 'zip':
            case 'rar': return 'fa-file-archive';
            default: return 'fa-file';
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Template buttons
    templateBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const templates = {
                'Greeting': 'Dear Valued Customer,\n\nThank you for reaching out to our support team. We appreciate the opportunity to assist you with your inquiry.',
                'Follow-up': 'I hope this message finds you well. I am following up on your previous inquiry to ensure that everything has been resolved to your satisfaction.',
                'Closing': 'We appreciate your patience and understanding. If you have any further questions or concerns, please don\'t hesitate to reach out.\n\nBest regards,\nSupport Team',
                'Delay Notice': 'Thank you for your patience. We wanted to inform you that we are still working on resolving your issue and will need a little more time to provide a complete solution.',
                'Thank You': 'Thank you for bringing this matter to our attention. We value your feedback as it helps us improve our services and provide better experiences for our customers.',
                'Custom': 'This is a custom template that you can edit to fit your specific needs.'
            };
            
            const templateText = this.textContent.trim();
            const templateKey = templateText.includes('Greeting') ? 'Greeting' : 
                                templateText.includes('Follow-up') ? 'Follow-up' :
                                templateText.includes('Closing') ? 'Closing' :
                                templateText.includes('Delay Notice') ? 'Delay Notice' :
                                templateText.includes('Thank You') ? 'Thank You' : 'Custom';
            
            textarea.value = templates[templateKey];
            charCount.textContent = textarea.value.length;
            localStorage.setItem('ticketReplyDraft', textarea.value);
            
            // Visual feedback
            this.classList.add('bg-indigo-100');
            setTimeout(() => {
                this.classList.remove('bg-indigo-100');
            }, 300);
        });
    });
    
    // Fullscreen toggle
    let isFullscreen = false;
    
    fullscreenToggle.addEventListener('click', function() {
        isFullscreen = !isFullscreen;
        
        if (isFullscreen) {
            contentContainer.classList.add('max-w-6xl');
            this.innerHTML = '<i class="fas fa-compress text-white text-xl"></i>';
        } else {
            contentContainer.classList.remove('max-w-6xl');
            this.innerHTML = '<i class="fas fa-expand text-white text-xl"></i>';
        }
    });
});
</script>

<style>
    /* Custom scrollbar */
    #filePreviewContainer::-webkit-scrollbar {
        width: 6px;
    }
    
    #filePreviewContainer::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    #filePreviewContainer::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    #filePreviewContainer::-webkit-scrollbar-thumb:hover {
        background: #6366f1;
    }
    
    /* Focused elements */
    .hover\:border-indigo-300:hover {
        border-color: #a5b4fc;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Floating button animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    #showReplyBtn {
        animation: pulse 2s ease-in-out infinite;
    }
    
    /* Slide in animation */
    @keyframes slideIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .animate-slide-in {
        animation: slideIn 0.3s ease-out forwards;
    }
</style>
