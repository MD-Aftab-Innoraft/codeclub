document.addEventListener('DOMContentLoaded', function() {
    // Select all modal elements
    const modals = document.querySelectorAll('.flash-msg');
    // Set timeout to hide each modal
    modals.forEach(modal => {
        setTimeout(() => {
            // Fade out the modal
            modal.style.opacity = '0';
            setTimeout(() => {
                // Remove the modal from the DOM after fade completes
                modal.remove();
            // Duration for fade effect
            }, 600);
        // Modal display duration
        }, 2000);
    });
});
