$(document).ready(function () {
    var output = $('#output').val();
    function documents() {
        $.ajax({
            url: 'listPdf.php',
            type: 'POST',
            data: { output, output},
            success: function (data) {
                $('#list-documentos').html(data);
                $console.log(response);
            }
        });
    }

    setInterval(() => {
        documents();
    }, 2000);
    
    // Made by Dazz

    /**
     * 
     *          ( D- A- Z- Z )
     *                /\
     *              /  /
     *            /_  /_
     *             /_   /_
     *              /   /
     *             / /      
     *             \/
     * 
     */
});