
// SO page load behavior
jQuery( () => {

    // hiding error/success feedbacks divs
    $('#err').hide();
    $('#succ').hide();

    // updating offline/users on page load
    getOnlineOfflineUsers();

    $( "pwd_reset_btn" ).on( "click", (e) => {
        e.preventDefault();
        // TODO
        console.log( "clicked" );
    });

});
// EO page load behavior