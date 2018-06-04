// global function holder
jQuery(window).ready(function()
{
    saveConfig();
});

// setting notification system
function _setNotification(message,type = 'info')
{
	swal({
	  title: vanillePlugin.pluginName,
	  text: message,
	  icon: type,
	  closeOnClickOutside: false,
	  closeOnEsc: false
	});
}

// save plugin settings
function saveConfig()
{
    $('.VanilleNameSpace-setting-form').on('submit', function(e)
    {
        e.preventDefault();
        var setting = {
            action: vanillePlugin.namespace+'save',
            nonce: $('#_wpnonce').val(),
            example: $('input[name="VanilleNameSpace-example"]').val()
        }
        $.ajax({
            type: "POST",
            data: setting,
            dataType:"json",
            url: vanillePlugin.ajaxurl,
            timeout:5000,
            success: function (response)
            {
                _setNotification(response.message,response.state);
            }
        }).fail(function (data)
        {
            _setNotification(vanillePlugin.errorMsg,'error');
            console.log('error : ' + data.statusText);
        }); 
    });
}