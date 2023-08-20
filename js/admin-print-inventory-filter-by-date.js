$(document).ready(function() {
    $('#print_filterBYDATEBTN').click(function() {
        $("#print_footer").css({
            "display": "block"
        })
        var contentToPrint = $('#filter_Bydate_print').html()
        var newWindow = window.open(",'_blank'")
        newWindow.document.write('<html><head><title>Print document</title></head><body>'+ contentToPrint + '</body></html>')
        newWindow.document.close()
        newWindow.print()
    })
})