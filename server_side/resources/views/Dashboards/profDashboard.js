const courseStudCnt1 = 69;
const courseStudCnt2 = 42;
const courseStudCnt3 = 27;

function displayCourseStudCnt() 
{
    var menu = document.getElementById("course-select");
    var i = menu.selectedIndex;
    var cnt;

    switch(i)
    {
        case 0:
            cnt = courseStudCnt1; break;
        case 1:
            cnt = courseStudCnt2; break;
        case 2:
            cnt = courseStudCnt3; break;
        default:
            cnt = 0;
    }

    document.getElementById("std-cnt").innerHTML = cnt;
}
