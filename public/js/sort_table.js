
function sortTable(n,type,event) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    
    table = document.getElementById("coin-table");
    switching = true;
    dir = "asc";
    
    const i_tags = table.querySelectorAll('i');
    
    const target = event.getElementsByTagName('i')[0];

    
    i_tags.forEach(function(i_tag){
        if(target != i_tag){
            i_tag.className="fa fa-fw fa-sort";
        }
    });
    

    while (switching) {
        target.className="fa fa-fw fa-sort-"+dir;
    
        switching = false;
        rows = table.rows;
    
        for (i = 1; i < (rows.length - 1); i++) {
        
        shouldSwitch = false;
        
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
            
        console.log(x.firstElementChild.getAttribute("data"));
        if (dir == "asc") {
            if ((type=="int" && parseFloat(x.textContent) > parseFloat(y.textContent)) || (type=="int" && parseFloat(x.firstElementChild.getAttribute("data")) > parseFloat(y.firstElementChild.getAttribute("data"))) ) {
            
            shouldSwitch= true;
            break;
            }
        } else if (dir == "desc") {
            if ((type=="int" && parseFloat(x.textContent) < parseFloat(y.textContent)) || (type=="int" && parseFloat(x.firstElementChild.getAttribute("data")) < parseFloat(y.firstElementChild.getAttribute("data")))) {
            
            shouldSwitch = true;
            break;
            }
        }
        }
        if (shouldSwitch) {
        
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        
        switchcount ++;
        } else {
        
        if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
        }
    
        }
    
    }
    
    }

