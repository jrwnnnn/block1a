document.addEventListener("DOMContentLoaded", function () {
    const audio = document.getElementById('background-audio');
    const soundToggle = document.getElementById('sound-toggle');

    soundToggle.addEventListener('click', (event) => {
        event.preventDefault();
        audio.muted = !audio.muted;
        soundToggle.textContent = audio.muted ? 'Unmute Sound' : 'Mute Sound';
    });
});