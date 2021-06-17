const top25_modal = document.getElementById("top25-modal");
const top25 = document.getElementById("top25-modal-button");
const viewers_modal = document.getElementById("viewers-modal");
const viewers = document.getElementById("viewers-modal-button");
const teams_modal = document.getElementById("teams-modal");
const teams = document.getElementById("teams-modal-button");

top25.onclick = function () {
    top25_modal.style.display = "block";
}

top25_modal.onclick = function (event) {
    if (event.target == top25_modal) {
        top25_modal.style.display = "none";
    }
}

viewers.onclick = function () {
    viewers_modal.style.display = "block";
}

window.onclick = function (event) {
    if (event.target == viewers_modal) {
        viewers_modal.style.display = "none";
    }
}

teams.onclick = function () {
    teams_modal.style.display = "block";
}

teams_modal.onclick = function (event) {
    if (event.target == teams_modal) {
        teams_modal.style.display = "none";
    }
}

