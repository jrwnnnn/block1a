function copyToClipboard() {
    const text = "cs1a.minecra.fr";
    document.getElementById("copy-button").innerHTML = "Copied!";
    navigator.clipboard.writeText(text);
  }

  fetch('https://api.mcsrvstat.us/2/invadedlands.net')
  .then(response => response.json())
  .then(data => {
    document.getElementById('player-count').innerText = data.players.online;
  });