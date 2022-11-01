// search function for user
function userSearch() {
    let rowCountO = 0;
    let inputO, filterO, tableO, trO, i;
    let tdO0, tdO1, tdO2;
    let txtValO0, txtValO1, txtValO2;
    inputO = document.getElementById("search_user_pd");
    console.log(inputO);
    filterO = inputO.value.toUpperCase();
    tableO = document.getElementById("userTable");
    trO = tableO.getElementsByTagName("tr");
    for (i = 0; i < trO.length; i++) {
      tdO0 = trO[i].getElementsByTagName("td")[0];
      tdO1 = trO[i].getElementsByTagName("td")[1];
      tdO2 = trO[i].getElementsByTagName("td")[2];
      tdO3 = trO[i].getElementsByTagName("td")[3];
      tdO4 = trO[i].getElementsByTagName("td")[4];
      // tdO5 = trO[i].getElementsByTagName("td")[5];

      if (tdO1 || tdO2 || tdO3 || tdO4 ) {
        txtValO0 = tdO0.textContent || tdO0.innerText;
        txtValO1 = tdO1.textContent || tdO1.innerText;
        txtValO2 = tdO2.textContent || tdO2.innerText;
        txtValO3 = tdO3.textContent || tdO2.innerText;
        txtValO4 = tdO4.textContent || tdO2.innerText;
        if (txtValO0.toUpperCase().indexOf(filterO) > -1 || txtValO1.toUpperCase().indexOf(filterO) > -1 || txtValO2.toUpperCase().indexOf(filterO) > -1 || txtValO3.toUpperCase().indexOf(filterO) > -1 || txtValO4.toUpperCase().indexOf(filterO) > -1 ) {
          trO[i].style.display = "";
          rowCountO++;
        } else {
          trO[i].style.display = "none";
        }
      };       
    };
    if (rowCountO == 0) {
      $("#no-user").css("display", "block");
    } else {
      $("#no-user").css("display", "none");
      rowCountO = 0;
    }
  };

