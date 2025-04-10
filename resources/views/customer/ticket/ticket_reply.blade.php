<div id="customerReplySection" class="min-h-screen bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 flex items-center justify-center p-6 hidden">
    <div class="w-full max-w-4xl transition-all duration-300" id="customerContentContainer">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <!-- Header Section -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600 opacity-90"></div>
                <div class="relative z-10 p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">My Ticket</h2>
                            <p class="text-white text-opacity-80">Ticket #{{ $ticket->id }} - Your Response</p>
                        </div>
                        <div class="flex space-x-3">
                            <button id="customerFullscreenToggle" class="bg-white bg-opacity-20 rounded-full p-3 hover:bg-opacity-30 transition-all duration-200">
                                <i class="fas fa-expand text-white text-xl"></i>
                            </button>
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <i class="fas fa-ticket-alt text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <form action="{{ route('customer.ticket.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <!-- Text Editor Area -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-inner hover:border-blue-300 transition-all duration-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Your Message
                            </label>
                            <div class="bg-white rounded-lg p-2 border border-gray-200 mb-2">
                                <div class="flex flex-wrap items-center space-x-1 mb-2 border-b pb-2">
                                    <button type="button" class="text-gray-600 hover:text-blue-600 p-2 rounded hover:bg-blue-50 transition" title="Bold" onclick="document.execCommand('bold');">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="text-gray-600 hover:text-blue-600 p-2 rounded hover:bg-blue-50 transition" title="Italic" onclick="document.execCommand('italic');">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="text-gray-600 hover:text-blue-600 p-2 rounded hover:bg-blue-50 transition" title="Underline" onclick="document.execCommand('underline');">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <span class="text-gray-300 mx-1">|</span>
                                    <button type="button" id="customerInsertLink" class="text-gray-600 hover:text-blue-600 p-2 rounded hover:bg-blue-50 transition" title="Insert Link">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <span class="text-gray-300 mx-1">|</span>
                                    <button type="button" id="customerUndoBtn" class="text-gray-600 hover:text-blue-600 p-2 rounded hover:bg-blue-50 transition" title="Undo" onclick="document.execCommand('undo');">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    <button type="button" id="customerRedoBtn" class="text-gray-600 hover:text-blue-600 p-2 rounded hover:bg-blue-50 transition" title="Redo" onclick="document.execCommand('redo');">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                </div>
                                <textarea 
                                    name="customer_response" 
                                    id="customerResponseTextarea"
                                    rows="8" 
                                    class="w-full bg-transparent border-none focus:ring-0 resize-none text-gray-800 placeholder-gray-500"
                                    placeholder="Type your message here..."
                                >{{ old('customer_response') }}</textarea>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-blue-600">
                                    <i class="fas fa-shield-alt mr-1"></i> Auto-saving draft
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span id="customerCharCount">0</span> / 1000 characters
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- File Upload Section -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-inner hover:border-blue-300 transition-all duration-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Attach Files
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center group hover:border-blue-500 transition-all duration-300">
                                <input 
                                    type="file" 
                                    multiple 
                                    class="hidden" 
                                    id="customerFileInput"
                                    name="customer_attachments[]"
                                />
                                <label for="customerFileInput" class="cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4 block group-hover:text-blue-500 transition"></i>
                                    <p class="text-gray-600 group-hover:text-blue-600 transition">
                                        Drag and drop files or <span class="font-semibold text-blue-500">Browse</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Max file size: 10MB | Supported formats: PDF, DOC, JPG, PNG
                                    </p>
                                </label>
                            </div>

                            <div id="customerFilePreviewContainer" class="mt-4 space-y-2 max-h-48 overflow-y-auto pr-2">
                                <!-- File previews will be dynamically added here -->
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
                            id="customerCancelBtn"
                        >
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                        >
                            <i class="fas fa-paper-plane mr-2"></i> Submit Response
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
        <div id="customerLinkDialog" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Insert Link</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Text</label>
                        <input type="text" id="customerLinkText" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Text to display">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                        <input type="url" id="customerLinkUrl" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="https://example.com">
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button id="customerCancelLink" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Cancel</button>
                        <button id="customerInsertLinkBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Insert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Show Reply Button (to trigger the reply section) -->
<div id="showCustomerReplyBtn" class="fixed bottom-8 right-8 p-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-full shadow-lg cursor-pointer hover:shadow-xl transform hover:scale-105 transition-all duration-300">
    <i class="fas fa-reply text-2xl"></i>
</div>

<script>
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const customerReplySection = document.getElementById('customerReplySection');
    const showCustomerReplyBtn = document.getElementById('showCustomerReplyBtn');
    const customerCancelBtn = document.getElementById('customerCancelBtn');
    const textarea = document.getElementById('customerResponseTextarea');
    const charCount = document.getElementById('customerCharCount');
    const fullscreenToggle = document.getElementById('customerFullscreenToggle');
    const contentContainer = document.getElementById('customerContentContainer');
    const undoBtn = document.getElementById('customerUndoBtn');
    const redoBtn = document.getElementById('customerRedoBtn');
    const insertLinkBtn = document.getElementById('customerInsertLink');
    const linkDialog = document.getElementById('customerLinkDialog');
    const cancelLinkBtn = document.getElementById('customerCancelLink');
    const confirmLinkBtn = document.getElementById('customerInsertLinkBtn');
    const linkText = document.getElementById('customerLinkText');
    const linkUrl = document.getElementById('customerLinkUrl');
    const fileInput = document.getElementById('customerFileInput');
    const filePreviewContainer = document.getElementById('customerFilePreviewContainer');
    
    // Show/Hide Reply Section
    showCustomerReplyBtn.addEventListener('click', function() {
        customerReplySection.classList.remove('hidden');
        showCustomerReplyBtn.classList.add('hidden');
    });
    
    customerCancelBtn.addEventListener('click', function() {
        customerReplySection.classList.add('hidden');
        showCustomerReplyBtn.classList.remove('hidden');
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
        localStorage.setItem('customerTicketReplyDraft', this.value);
    });
    
    // Check for saved draft
    const savedDraft = localStorage.getItem('customerTicketReplyDraft');
    if (savedDraft) {
        textarea.value = savedDraft;
        charCount.textContent = savedDraft.length;
    }

    // Link dialog functionality
    insertLinkBtn.addEventListener('click', function() {
        linkDialog.classList.remove('hidden');
    });
    
    cancelLinkBtn.addEventListener('click', function() {
        linkDialog.classList.add('hidden');
    });
    
    confirmLinkBtn.addEventListener('click', function() {
        const text = linkText.value.trim();
        const url = linkUrl.value.trim();
        
        if (text && url) {
            const linkHtml = '<a href="' + url + '" target="_blank">' + text + '</a>';
            document.execCommand('insertHTML', false, linkHtml);
            linkDialog.classList.add('hidden');
            linkText.value = '';
            linkUrl.value = '';
        }
    });

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
        dropZone.classList.add('border-blue-500');
        dropZone.classList.add('bg-blue-50');
    }
    
    function unhighlight() {
        dropZone.classList.remove('border-blue-500');
        dropZone.classList.remove('bg-blue-50');
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
                    <div class="bg-blue-100 text-blue-500 p-2 rounded-full">
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
    #customerFilePreviewContainer::-webkit-scrollbar {
        width: 6px;
    }
    
    #customerFilePreviewContainer::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    #customerFilePreviewContainer::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    #customerFilePreviewContainer::-webkit-scrollbar-thumb:hover {
        background: #3b82f6;
    }
    
    /* Focused elements */
    .hover\:border-blue-300:hover {
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
    
    #showCustomerReplyBtn {
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