document.getElementById('add-player-btn').addEventListener('click', function() {
    const container = document.getElementById('players-container');
    const playerCount = container.getElementsByClassName('player-group').length;
    const newPlayerDiv = document.createElement('div');
    newPlayerDiv.classList.add('player-group');

    const newPlayerLabel = document.createElement('label');
    newPlayerLabel.setAttribute('for', 'player' + (playerCount + 1));
    newPlayerLabel.textContent = 'Speler ' + (playerCount + 1) + ':';

    const newPlayerInput = document.createElement('input');
    newPlayerInput.setAttribute('type', 'text');
    newPlayerInput.setAttribute('id', 'player' + (playerCount + 1));
    newPlayerInput.setAttribute('name', 'players[]');
    newPlayerInput.required = true;

    newPlayerDiv.appendChild(newPlayerLabel);
    newPlayerDiv.appendChild(newPlayerInput);
    container.appendChild(newPlayerDiv);
});
