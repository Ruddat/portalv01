<!-- Overlay -->
<div id="imageOverlay" class="overlay" style="display: none;">
    <div class="overlay-content">
        <span class="close-btn" wire:click="closeOverlay">&times;</span>
        <img src="" alt="Preview Image" id="overlayImage" class="img-fluid">
    </div>


<style>
    /* Basic styles for the overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .overlay-content {
        position: relative;
        max-width: 80%;
        max-height: 80%;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        cursor: pointer;
        color: white;
    }
</style>
</div>
