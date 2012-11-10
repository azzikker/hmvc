document_ready();
function document_ready()
{
    $(document).ready(function()
    {
        click_event();
    })
    function click_event()
    {
        $("input[name='cmdlogin']").click(function()
        {
            if($("form[name='register'] input[name='txtPW']").val().length > 0 || $("form[name='register'] input[name='txtCPW']").val().length > 0)
                {
                var txtPW = $("form[name='register'] input[name='txtPW']").val();
                var txtCPW = $("form[name='register'] input[name='txtCPW']").val();
                if(txtPW != txtCPW)
                    {
                    alert("Confirm Password/Password did not match!");
                    return false;
                    }
                }
        })
    }
}