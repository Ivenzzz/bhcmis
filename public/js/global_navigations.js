export function initializePopover() {
    var popoverTrigger = document.getElementById('avatar');
    if (popoverTrigger) {
        var popover = new bootstrap.Popover(popoverTrigger);
    }
}