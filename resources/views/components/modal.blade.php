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
    // Function to open the modal
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
</script>
