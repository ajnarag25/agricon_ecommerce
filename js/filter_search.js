function filter_search_home() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("p_row");
    li = ul.getElementsByClassName("prod_c");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("prod_name")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}