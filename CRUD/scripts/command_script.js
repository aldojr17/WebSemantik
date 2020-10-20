function updateValue(id) {
    window.location = "?menu=catu&cid=" + id;
}

function deleteValue(id) {
    let confirmation = window.confirm("Are you sure want to delete ?");
    if (confirmation) {
        window.location = "?menu=cat&cmd=del&cid=" + id;
    }
}

function updateValueBook(isbn) {
    window.location = "?menu=booku&isbn=" + isbn;
}

function deleteValueBook(isbn) {
    let confirmation = window.confirm("Are you sure want to delete ?");
    if (confirmation) {
        window.location = "?menu=book&cmd=del&isbn=" + isbn;
    }
}