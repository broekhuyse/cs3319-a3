<!-- CS3319A Assignment #3 | Alex Broekhuyse | abroekhu@uwo.ca | 250978523 -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
        <link href="style.css" rel="stylesheet" type="text/css">
    </head> 
    <body>
        <script>
            function showDeletePrelim() {
                var check = document.getElementById("uwoCoursesDelete").value;
                if (check != 0) {
                    document.getElementById('uwoDeletePrelim').disabled = false;
                }
                this.form.submit();
            }
        </script>
        <script src="uwo.js"></script>
        <script src="regex.js"></script>
        <?php
            include "connecttodb.php";
        ?>
        <div class="">
        <div style="width:15%">
            <img src="https://westernmustangs.ca/images/logos/site/site.png" id="top" style="width:150px"/>
        </div>
        <div style="width:85%">
            <p>CS3319A Assignment #3</p>
            <p>Alex Broekhuyse | abroekhu@uwo.ca | 250978523</p>
        </div>
        </div>
        <div class="">
        <div class="">
            <h3>Western Course Data</h3>
            <form method="post">
                <select id="uwosort" name="uwosort">
                    <option value="0">Select Sorting Method</option>
                    <option value="1">Sort by Course Number, Ascending</option>
                    <option value="2">Sort by Course Number, Descending</option>
                    <option value="3">Sort by Course Name, Descending</option>
                    <option value="4">Sort by Course Name, Ascending</option>
                </select>
            </form>
            <?php
                include "getuwo.php";
            ?>
        </div>
        </div>
        <div class="">
        <div class="">
            <form method="POST">
                <h3>Modify Western Course Data</h3>
                <select id="uwoCourses" name="uwoCourses">
                    <option value="0">Select a Course:</option>
                    <?php
                        include "getuwocourse.php";
                    ?>
                </select><br><br>
                <label for="courseName">Course Name:</label><br>
                <input type="text" id="courseName" name="courseName" oninput="nameCheck()" ><br>
                <button type="submit" id="uwoUpdateName" name ="uwoUpdateName" disabled>Update</button><br>
                <label for="courseSuffix">Course Suffix:</label><br>
                <input type="text" id="courseSuffix" name="courseSuffix" oninput="suffixCheck()"><br>
                <button type="submit" id="uwoUpdateSuffix" disabled>Update</button><br>
                <label for="courseWeight">Course Weight:</label><br>
                <input type="text" id="courseWeight" name="courseWeight" oninput="weightCheck()"><br>
                <button type="submit" id="uwoUpdateWeight" disabled>Update</button>
            </form>
            <?php
                include "updateuwo.php";
            ?>  
            <p style="font-size:12px">*Course name, suffix and weight must follow proper convention to be able to submit.</p>
        </div>
        </div>
        <div class="">
        <div class="">
            <form method="POST" onsubmit="return confirm('If this course has any equivalent courses, they will also be deleted. Confirm delete?');">
                <h3>Delete Western Course</h3>
                <select id="uwoCoursesDelete" name="uwoCoursesDelete" onchange="showDeletePrelim()">
                    <option value="0">Select a Course:</option>
                    <?php
                        include "getuwocourse.php";
                    ?>
                </select>
                <button id="uwoDeletePrelim" type="submit" disabled>Delete</button><br>
            </form>
            <?php
                include "deleteuwo.php";
            ?>
        </div>
        </div>
        <div class="">
        <div class="">
            <h3>Create Western Course</h3>
            <form method="POST">
                <label for="newCourseCode">Course Code:</label><br>
                <input type="text" id="newCourseCode" name="newCourseCode" oninput="courseCheck()"><br>
                <label for="newCourseName">Course Name:</label><br>
                <input type="text" id="newCourseName" name="newCourseName" oninput="courseCheck()"><br>
                <label for="newCourseSuffix">Course Suffix:</label><br>
                <input type="text" id="newCourseSuffix" name="newCourseSuffix" oninput="courseCheck()"><br>
                <label for="newCourseWeight">Course Weight:</label><br>
                <input type="text" id="newCourseWeight" name="newCourseWeight" oninput="courseCheck()"><br><br>
                <button type="submit" id="uwoCreateCourse" disabled>Create</button>
            </form>
            <?php
                include "createuwo.php";
            ?>
        </div>
        </div>
        <div class="">
        <div class="">
            <h3>Display University Info</h3>
            <form method="POST" action="submit.php">
                <input type="hidden" name="test"/>
                <select id="uniID" name="uniID" onchange="this.form.submit()">
                    <option value="-1">Select a University:</option>
                    <?php
                        include "getuniversity.php";
                    ?>
                </select>
            </form>
        </div>
        </div>
        <div class="">
        <div class="">
            <h3>University Names & Nicknames</h3>
            <form action="submit.php" method="post">
                <select id="uniProvince" name="uniProvince" onchange="this.form.submit()">
                    <option value="0">Select Province Code</option>
                    <option value="AB">AB</option>
                    <option value="BC">BC</option>
                    <option value="MB">MB</option>
                    <option value="NB">NB</option>
                    <option value="NL">NL</option>
                    <option value="NS">NS</option>
                    <option value="NT">NT</option>
                    <option value="NU">NU</option>
                    <option value="ON">ON</option>
                    <option value="PE">PE</option>
                    <option value="QC">QC</option>
                    <option value="SK">SK</option>
                    <option value="YT">YT</option>
                </select>
            </form>
        </div>
        </div>
        <div class="">
        <div class="">
            <form action="submit.php" method="POST">
                <h3>Display UWO Course Equivalencies</h3>
                <select id="uwoEquiv" name="uwoEquiv" onchange="this.form.submit()">
                    <option value="0">Select a Course:</option>
                    <?php
                        include "getuwocourse.php";
                    ?>
                </select>
            </form>
        </div>
        </div>
        <div class="">
        <div class="">
            <h3>Check Equivalencies Based on Date</h3>
            <form action="submit.php" method="POST">
                <input type="date" id="dateCheck" name="dateCheck" value="1990-01-01" min="1900-01-01" max="getDate()"/>
                <button type="submit" id="dateCheck" onclick="this.form.submit()">Check</button>
            </form>
        </div>
        </div>
        <div class="">
            <h3>Create Western Equivalency</h3>
            <form method="POST" action="submit.php">
                <select id="outsideCourse" name="outsideCourse" onchange="equivSelectCheck()">
                    <option value="0">Select a Course:</option>
                    <?php
                        include "getcourseequiv.php";
                    ?>
                </select><br><br>
                <select id="uwoCourse" name="uwoCourse" onchange="equivSelectCheck()">
                    <option value="0">Select a UWO Course:</option>
                    <?php
                        include "getuwocourse.php";
                    ?>
                </select><br><br>
                <button type="submit" id="uwoCreateEquiv" disabled>Create</button>
            </form>
        </div>
        <div>
            <h3>Universities With No Courses in Database</h3>
            <?php
                include 'universitycourse.php'
            ?>
        </div>
        <div>
            <h3>Add Image to University</h3>
            <form method="POST" action="submit.php">
                <input type="hidden" name="test"/>
                <select id="uniimage" name="uniimage" onchange="this.form.submit()">
                    <option value="-1">Select a University:</option>
                    <?php
                        include "getuniversity.php";
                    ?>
                </select><br>
            </form>
        </div>
        <div>
            <br>
            <a href="#top">Back to Top</a>
        </div>
    </body>
</html>