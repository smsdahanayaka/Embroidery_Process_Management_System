/* global rows */

//function sortTableByColumn(table, column, asc = true) {
//    const dirModifier = asc ? 1 : -1;
//    const tBody = table.tBodies[0];
//    const row = Array.from(tBody.querySelectorAll("tr"));
//    //sort each row
//    const sortedRows = rows.sort((a, b) => {
//        const aColText = a.querySelector('td:nth-child(${ column + 1})').textContent.trim();
//        const bColText = b.querySelector('td:nth-child(${ column + 1})').textContent.trim();
//
//        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
//    });
//    //remove all existing TRs from the table
//    while (tBody.firstChild) {
//        tBody.removeChild(tBody.firstChild);
//    }
//    //re-add the newly sorted rows
//    tBody.append(...sortedRows);    
////    Remember how to colum is currently sorted
//table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc" , "th-sort-desc"));
//table.querySelector('th:nth-child(${column +1})').classList.toggle("th-sort-asc", asc);
//table.querySelector('th:nth-child(${column +1})').classList.toggle("th-sort-desc", !asc);
//}
//document.querySelectorAll(".table-sortable th").forEach(headerCell =>{
//    headerCell.addEventListener("click",() =>{
//        const tableElement = headerCell.parentElement.parentElement.parentElement;
//        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
//        const currentIsAscending = headerCell.classList.contains("th-sort-asc");
//        
//        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
//        
//    });
//});

$('th').click(function(){
    var table = $(this).parents('table').eq(0)
    var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
    this.asc = !this.asc
    if (!this.asc){rows = rows.reverse()}
    for (var i = 0; i < rows.length; i++){table.append(rows[i])}
})
function comparer(index) {
    return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index)
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
    }
}
function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

//table Pagination function
var table = '#myTable2';
$('#maxRows').on('change', function () {
    $('.pagination').html('');
    var trnum = 0;
    var maxRows = parseInt($(this).val());
    var totalRows = $(table + ' tbody tr').length;
    $(table + ' tr:gt(0)').each(function () {
        trnum++;
        if (trnum > maxRows) {
            $(this).hide();
        }
        if (trnum <= maxRows) {
            $(this).show();
        }
    });
    if (totalRows > maxRows) {
        var pagenum = Math.ceil(totalRows / maxRows);
        for (var i = 1; i <= pagenum; ) {
            $('.pagination').append('<li class="page-item" data-page="' + i + '"><a class="page-link" href="#">\<span>' + i++ + '<span class="sr-only page-item">(current)</span></span>\</a></li>').show();
        }
    }
    $('.pagination li:first-child').addClass('active');
    $('.pagination li').on('click', function () {
        var pageNum = $(this).attr('data-page');
        var trIndex = 0;
        $('.pagination li').removeClass('active');
        $(this).addClass('active');
        $(table + ' tr:gt(0)').each(function () {
            trIndex++;
            if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) - maxRows)) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
});

// Table Search Function   
$(document).ready(function () {
    $('#Search').keyup(function () {
        search_table($(this).val());
    });
    function search_table(value) {
        $('#myTable tr').each(function () {
            var found = 'false';
            $(this).each(function () {
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                {
                    found = 'true';
                }
            });
            if (found == 'true') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});