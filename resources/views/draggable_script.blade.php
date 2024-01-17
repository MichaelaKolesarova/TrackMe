<script>
    let task_cards = document.getElementsByClassName("task-card");

    let to_do_card = document.getElementById("card-tasks-todo");
    let in_progress_card = document.getElementById("card-tasks-inprogres");
    let blocked_card = document.getElementById("card-tasks-blocked");
    let done_card = document.getElementById("card-tasks-done");

    function handleDragStart(event) {
        selected = event.target;
    }

    function handleDragOver(event) {
        event.preventDefault();
    }

    function handleDrop(targetCard, event) {
        targetCard.appendChild(selected);
        selected = null;
        let taskId = selected.getAttribute('id');

        fetch(`/updateTaskStatus/${taskId}`, {
            method: 'PATCH', // Assuming you are using a PATCH request for partial updates
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                status: targetCard.getAttribute('taskStatus'),
            }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle the success response if needed
            })
            .catch(error => {
                // Handle the error if needed
            });

    }
    for (let card of task_cards) {
        card.addEventListener("dragstart", handleDragStart);
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



    /*
    document.addEventListener('DOMContentLoaded', function () {
        // Enable draggability for task cards
        interact('.draggable')
            .draggable({
                inertia: true,
                modifiers: [
                    interact.modifiers.restrict({
                        restriction: 'parent',
                        endOnly: true,
                    }),
                ],
                // Set a higher z-index while dragging
                onstart: function (event) {
                    var target = event.target;
                    target.style.zIndex = '9999';
                },
                onmove: function (event) {
                    var target = event.target;

                    // Translate the element
                    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                    target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                },
                onend: function (event) {
                    var target = event.target;

                    // Reset the z-index after dragging ends
                    target.style.zIndex = '';
                },
            })
            .on('dragmove', function (event) {
                var target = event.target;

                // Update the position attributes
                var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            })
            .on('dragend', function (event) {
                var target = event.target;

                // Check if the task card is over a new tasks-card
                var newTasksCard = document.elementFromPoint(event.clientX, event.clientY);
                if (newTasksCard && newTasksCard.classList.contains('new-tasks-card')) {
                    // Append the task card to the new tasks-card
                    newTasksCard.appendChild(target);
                }
            });

        // Enable droppability for cards-card containers
        interact('.cards-card')
            .dropzone({
                accept: '.draggable',
                ondragenter: function (event) {
                    var cardsCard = event.target;

                    // Add a class to highlight the drop zone
                    cardsCard.classList.add('drop-target');
                },
                ondragleave: function (event) {
                    var cardsCard = event.target;

                    // Remove the highlight class when the card leaves the drop zone
                    cardsCard.classList.remove('drop-target');
                },
                ondrop: function (event) {
                    var draggableElement = event.relatedTarget;
                    var cardsCard = event.target;

                    // Remove the highlight class when the card is dropped
                    cardsCard.classList.remove('drop-target');

                    // Implement your logic here (e.g., update task status, move task between cards-cards)
                    var taskId = draggableElement.getAttribute('data-id');
                    var targetCardsCardId = cardsCard.getAttribute('data-cards-card-id');

                    // Example: Update task status or move task between cards-cards via AJAX
                    console.log('Dropped task', taskId, 'into cards-card', targetCardsCardId);
                },
            });
    });

     */
</script>
