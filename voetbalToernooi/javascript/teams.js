document.getElementById('add-player-btn').addEventListener('click', function() {
    const container = document.getElementById('players-container');
    const playerCount = container.getElementsByClassName('player-group').length;
    const newPlayerGroup = document.createElement('div');
    newPlayerGroup.classList.add('player-group', 'd-flex', 'align-items-center');
    newPlayerGroup.innerHTML = `
        <label for="player${playerCount + 1}" class="form-label me-2">Speler ${playerCount + 1}:</label>
        <input type="text" id="player${playerCount + 1}" name="players[]" class="form-control me-2" required>
        <button type="button" class="btn btn-danger btn-sm remove-player-btn">Verwijderen</button>
    `;
    container.appendChild(newPlayerGroup);
    addRemovePlayerEvent(newPlayerGroup.querySelector('.remove-player-btn'));
});

function addRemovePlayerEvent(button) {
    button.addEventListener('click', function() {
        this.parentElement.remove();
        updatePlayerLabels();
    });
}

function updatePlayerLabels() {
    const playerGroups = document.querySelectorAll('.player-group');
    playerGroups.forEach((group, index) => {
        const label = group.querySelector('label');
        label.textContent = `Speler ${index + 1}:`;
        const input = group.querySelector('input');
        input.id = `player${index + 1}`;
    });
}

// Add remove event to initial player
addRemovePlayerEvent(document.querySelector('.remove-player-btn'));
