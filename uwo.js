window.onload = function() {
    prepareListener();
}
function prepareListener() {
    var query;
    query = document.getElementById("uwosort");
    query.addEventListener("change",sortCourses);
    document.getElementById("uwoDeleteWarning").style.visibility = "hidden";
}
function sortCourses() {
    this.form.submit();
}
/* For equivalent courses form. Checks that the user has selected both 
courses before allowing form submit. */
function equivSelectCheck() {
    var otherDrop = document.getElementById('outsideCourse').value;
    var uwoDrop = document.getElementById('uwoCourse').value;
    if (otherDrop != "0" && uwoDrop != "0") {
        document.getElementById('uwoCreateEquiv').disabled = false;
    }
    else {
        document.getElementById('uwoCreateEquiv').disabled = true;
    }
}
/* For adding an image. Checks that image field has been filled out
before allowing submit. */
function imageCheck() {
    var result = document.getElementById('imageurl').value;
    if (result) {
        document.getElementById('addImage').disabled = false;
    }
    else {
        document.getElementById('addImage').disabled = true;
    }
}