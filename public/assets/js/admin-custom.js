
function closeTicket(id, title) {
    document.getElementById('proj').innerHTML = title;
    document.getElementById('ticketID').setAttribute("value", id);
}

function deleteTicket(id) {
    document.getElementById('ticket_id').setAttribute("value", id);
}

function deleteUser(id, name, st) {
    if (st == '1') {
        document.getElementById('type').innerHTML = 'Deactivate';
        document.getElementById('type-status').innerHTML = 'deactivate';
    } else {
        document.getElementById('type').innerHTML = 'Activate';
        document.getElementById('type-status').innerHTML = 'activate';
    }

    document.getElementById('name').innerHTML = name;
    document.getElementById('user_id').setAttribute("value", id);
}

/* Custom Core */
$("form").submit(function () {
    $('.spinner-border').removeClass('d-none');
    $(this).find(":submit").prop('disabled', true);
    $("*").css("cursor", "wait");
});