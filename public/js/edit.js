function edit() {
    $('#show:visible').replaceWith($('#edit').clone());
    $('#buttons:visible').replaceWith($('#buttons-in-edit').clone());
}

function save() {
    $('#edit-form:visible').submit();
}

function cancelEdit() {
    $('#edit:visible').replaceWith($('#show').clone());
    $('#buttons-in-edit:visible').replaceWith($('#buttons').clone());
}

function deleteModel() {
    $('#remove-form').submit();
}

//# sourceMappingURL=edit.js.map
