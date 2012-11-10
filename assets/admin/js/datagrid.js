$table = '#datagrid'; 

$(document).ready(function ()
{  
    $($table).jTPS( {perPages:[20,40,60,80,100,'ALL'],scrollStep:1,scrollDelay:30,
        clickCallback:function () {     
            // target table selector
            var table = $table;
            // store pagination + sort in cookie 
            document.cookie = 'jTPS=sortasc:' + $(table + ' .sortableHeader').index($(table + ' .sortAsc')) + ',' +
            'sortdesc:' + $(table + ' .sortableHeader').index($(table + ' .sortDesc')) + ',' +
            'page:' + $(table + ' .pageSelector').index($(table + ' .hilightPageSelector')) + ';';
        }
    }); 

    // reinstate sort and pagination if cookie exists
    var cookies = document.cookie.split(';');
    for (var ci = 0, cie = cookies.length; ci < cie; ci++) {
        var cookie = cookies[ci].split('=');
        if (cookie[0] == 'jTPS') {
            var commands = cookie[1].split(',');
            for (var cm = 0, cme = commands.length; cm < cme; cm++) {
                var command = commands[cm].split(':');
                if (command[0] == 'sortasc' && parseInt(command[1]) >= 0) {
                    $($table + ' .sortableHeader:eq(' + parseInt(command[1]) + ')').click();
                } else if (command[0] == 'sortdesc' && parseInt(command[1]) >= 0) {
                    $($table + ' .sortableHeader:eq(' + parseInt(command[1]) + ')').click().click();
                } else if (command[0] == 'page' && parseInt(command[1]) >= 0) {
                    $($table + ' .pageSelector:eq(' + parseInt(command[1]) + ')').click();
                }
            }
        }
    }

    // bind mouseover for each tbody row and change cell (td) hover style
    $($table + ' tbody tr:not(.stubCell)').bind('mouseover mouseout',
    function (e) {
        // hilight the row
        e.type == 'mouseover' ? $(this).children('td').addClass('hilightRow') : $(this).children('td').removeClass('hilightRow');
    }
    );

});


