document.addEventListener('DOMContentLoaded', (event) => {
    let playerCount = 1;

    document.getElementById('add-player-btn').addEventListener('click', () => {
        playerCount++;
        const playersContainer = document.getElementById('players-container');
        const playerGroup = document.createElement('div');
        playerGroup.classList.add('player-group');

        const label = document.createElement('label');
        label.setAttribute('for', 'player' + playerCount);
        label.textContent = 'Speler ' + playerCount + ':';
        playerGroup.appendChild(label);

        const input = document.createElement('input');
        input.type = 'text';
        input.id = 'player' + playerCount;
        input.name = 'players[]';
        input.required = true;
        playerGroup.appendChild(input);

        playersContainer.appendChild(playerGroup);
    });
});
