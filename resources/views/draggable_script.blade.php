<script>
    let task_cards = document.getElementsByClassName("task-card");

    let to_do_card = document.getElementById("card-tasks-todo");
    let in_progress_card = document.getElementById("card-tasks-inprogres");
    let blocked_card = document.getElementById("card-tasks-blocked");
    let done_card = document.getElementById("card-tasks-done");

    let selected = null;

    function handleDragStart(event) {
        selected = event.target;
        return selected;
    }

    function handleDragOver(event) {
        event.preventDefault();
    }

    function handleDrop(targetCard, event) {
        event.stopPropagation();
        let taskId = selected.getAttribute('id');
        targetCard.appendChild(selected);

        fetch(`/updateTaskStatus/${taskId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                taskStatus: targetCard.getAttribute('taskStatus'),
            }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                selected = null;
            })
            .catch(error => {
                // Handle the error if needed
            });

    }
    for (let card of task_cards) {
        to_do_card.addEventListener("dragover", handleDragOver);
        to_do_card.addEventListener("drop", function (event) {
            handleDrop(to_do_card, event);
        });
    }

    for (let card of task_cards) {
        card.addEventListener("dragstart", handleDragStart);
        in_progress_card.addEventListener("dragover", handleDragOver);
        in_progress_card.addEventListener("drop", function (event) {
            handleDrop(in_progress_card, event);
        });
    }

    for (let card of task_cards) {
        card.addEventListener("dragstart", handleDragStart);
        blocked_card.addEventListener("dragover", handleDragOver);
        blocked_card.addEventListener("drop", function (event) {
            handleDrop(blocked_card, event);
        });
    }

    for (let card of task_cards) {
        card.addEventListener("dragstart", handleDragStart);
        done_card.addEventListener("dragover", handleDragOver);
        done_card.addEventListener("drop", function (event) {

            handleDrop(done_card, event);
        });
    }
</script>
