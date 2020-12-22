/* Regular expression checking for various inputs. Makes sure user
has entered input in the correct format (i.e. course codes) before
giving option to submit form. */
var suffix;
var weight;
var name;
var codePattern = /^cs[0-9]{4}$/;
var suffixPattern = /^(Z|[AF]\/[BG]){1}$/;
var weightPattern = /^[0-9]{1}.[05]{1}$/;
var namePattern = /[a-z]|[A-Z]/;
var courseWeight = document.getElementById('courseWeight');

function suffixCheck() {
    suffix = document.getElementById('courseSuffix').value;
    if (suffixPattern.test(suffix)) {
        document.getElementById('uwoUpdateSuffix').disabled = false;
    }
    else {
        document.getElementById('uwoUpdateSuffix').disabled = true;
    }
}
function weightCheck() {
    weight = document.getElementById('courseWeight').value;
    if (weightPattern.test(weight)) {
        document.getElementById('uwoUpdateWeight').disabled = false;
    }
    else {
        document.getElementById('uwoUpdateWeight').disabled = true;
    }
}
function nameCheck() {
    name = document.getElementById('courseName').value;
    if (namePattern.test(name)) {
        document.getElementById('uwoUpdateName').disabled = false;
    }
    else {
        document.getElementById('uwoUpdateName').disabled = true;
    }    
}
function courseCheck() {
    courseNum = document.getElementById('newCourseCode').value;
    courseName = document.getElementById('newCourseName').value;
    courseWeight = document.getElementById('newCourseWeight').value;
    courseSuffix = document.getElementById('newCourseSuffix').value;
    if (codePattern.test(courseNum)) {
        if (namePattern.test(courseName)) {
            if (suffixPattern.test(courseSuffix) || courseSuffix) {
                if (weightPattern.test(courseWeight)) {
                    document.getElementById('uwoCreateCourse').disabled = false;
                }
            }
        }
    }
    else {
        document.getElementById('uwoCreateCourse').disabled = true;
    }
}