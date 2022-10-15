$(document).ready(function(){
    $("input[name='optradio']").on('click',function(){
        var radios = $('input[name="optradio"]:checked').val();
        document.getElementById("subj").value = radios;
    });
});

// search function for studentlist
function studentSearch() {
      
    let rowCountO = 0;
    let inputO, filterO, tableO, trO, i;
    let tdO0, tdO1, tdO2;
    let txtValO0, txtValO1, txtValO2;
    inputO = $('#searchStudent').val();
    console.log(inputO)
    filterO = inputO.toUpperCase();
    tableO = document.getElementById("studentTable");
    trO = tableO.getElementsByTagName("tr");
    for (i = 0; i < trO.length; i++) {
      tdO0 = trO[i].getElementsByTagName("td")[0];
      tdO1 = trO[i].getElementsByTagName("td")[1];
      tdO2 = trO[i].getElementsByTagName("td")[2];
      tdO3 = trO[i].getElementsByTagName("td")[3];
      tdO4 = trO[i].getElementsByTagName("td")[4];
      tdO5 = trO[i].getElementsByTagName("td")[5];

      if (tdO1 || tdO2 || tdO3 || tdO4 || tdO5 ) {
        txtValO0 = tdO0.textContent || tdO0.innerText;
        txtValO1 = tdO1.textContent || tdO1.innerText;
        txtValO2 = tdO2.textContent || tdO2.innerText;
        txtValO3 = tdO3.textContent || tdO2.innerText;
        txtValO4 = tdO4.textContent || tdO2.innerText;
        txtValO5 = tdO5.textContent || tdO2.innerText;
        if (txtValO0.toUpperCase().indexOf(filterO) > -1 || txtValO1.toUpperCase().indexOf(filterO) > -1 || txtValO2.toUpperCase().indexOf(filterO) > -1 || txtValO3.toUpperCase().indexOf(filterO) > -1 || txtValO4.toUpperCase().indexOf(filterO) > -1 || txtValO5.toUpperCase().indexOf(filterO) > -1) {
          trO[i].style.display = "";
          rowCountO++;
        } else {
          trO[i].style.display = "none";
        }
      };       
    };
    if (rowCountO == 0) {
      $("#no-student").css("display", "block");
    } else {
      $("#no-student").css("display", "none");
      rowCountO = 0;
    }
  };

 // year & section dropdown
 let fil = $('#filter_').val();

 function getItems(val) {
 let filter_, table_, tr_, i;
 let td0_;
 let txtVal0_;
 filter_ = val.toUpperCase();
 table_ = document.getElementById("studentTable");
 tr_ = table_.getElementsByTagName("tr");

 for (i = 0; i < tr_.length; i++) {
     td0_ = tr_[i].getElementsByTagName("td")[4];
     if (td0_) {
     txtVal0_ = td0_.textContent || td0_.innerText;
     if (txtVal0_.toUpperCase().indexOf(filter_) > -1) {
         tr_[i].style.display = "";
         // console.log('kak')
         // rowCount++;
     } else {
         tr_[i].style.display = "none";
     }
     };       
 };
 }

