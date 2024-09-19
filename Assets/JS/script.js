function activeMenu() {
    var path = window.location.href; // Get the current URL

    $(".nav-link").each(function() {
        var href = $(this).attr('href'); // Get the href attribute of the nav-link
        if (path === href) {
            $(this).addClass('active'); // Add 'active' class to the current nav-link
            var parent = $(this).closest('.has-treeview');
            parent.addClass('menu-open'); // Add 'menu-open' class to the closest parent with class 'has-treeview'
            $(parent).find('.nav-link').first().addClass('active'); // Add 'active' class to the first nav-link of the parent
            $(parent).find('.nav-treeview').css('display', 'block'); // Show the nested nav-treeview menu
        }
    });
}

$(document).ready(function() {
    activeMenu(); // Call the function after the document is ready
});