$(document).ready(function () {

    function loadUsers() {
        $.ajax({
            url: 'php/usuarios.php',
            type: 'POST',
            success: function (data) {
                $('#users-list').html(data);
                
            }
        });
    }

    setInterval(() => {
        loadUsers();
    }, 1000);
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