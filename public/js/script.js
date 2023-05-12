jQuery(document).ready(function(){
        jQuery("#btn-login").click(function(e){
        e.preventDefault();
        jQuery("input[name='username_en']").removeClass("error-input");
        jQuery("input[name='password_en']").removeClass("error-input");
        jQuery('.login-error').hide();
        jQuery('.requierd').hide();
        var username = jQuery("input[name='username_en']").val();
        var password = jQuery("input[name='password_en']").val();
        if (username == "") {
            jQuery("input[name='username_en']").parent().parent().find('.requierd').html('ضرروری!').show();
            jQuery("input[name='username_en']").addClass("error-input").focus();
            return false;
        }
        if (password == "") {
            jQuery("input[name='password_en']").parent().parent().find('.requierd').html('ضرروری!').show();
            jQuery("input[name='password_en']").addClass("error-input").focus();
            return false;
        }
        else {
            jQuery.ajax({
                url: solo_ajax_object.ajax_url+"wp/v1/login",
                data: {
                    'username':username,
                    'password':password
                },
                type: "POST",
                beforeSend:function() {
                    jQuery('#btn-subuser').css({'pointer-events':'none','opacity': 0.4}).prop('disabled', true);
                },
                success: function (response) {
                    var data = jQuery.parseJSON(response);
                    if(data.status===0){
                        jQuery(".login-error").html(data.msg).show();
                        return false;
                    }
                    else if (data.status === 1) {
                        jQuery('.success-result').css({'pointer-events':'unset','color':'green','text-align': 'center','font-size': '25px','font-weight': '600',}).html('کمی صبر کنید.....');
                        window.location.href = data.url;
                    }
                    else {
                        jQuery(".course-error").html("متاسفانه شبکه با مشکل مواجه شد چند دقیقه بعد.ساخص) باز امتحان کنید").show();
                    }
                },
                complete: function() {
                    jQuery('#btn-subuser').css({'pointer-events':'unset','opacity': 1}).prop('disabled', false);

                },

            });
        }
    });

})