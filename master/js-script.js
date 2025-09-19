// JavaScript Document


//  for select / deselect all

$('document').ready(function()
{
    $(".select-all").click(function ()
    {
        $('.chk-box').attr('checked', this.checked)
    });
        
    $(".chk-box").click(function()
    {
        if($(".chk-box").length == $(".chk-box:checked").length)
        {
            $(".select-all").attr("checked", "checked");
        }
        else
        {
            $(".select-all").removeAttr("checked");
        }
    });
});


//  for select / deselect all


//  page redirect on user click edit/delete

function question() 
{
	document.frm.action = "ques_delmulti.php";
	document.frm.submit();		
}
function userlist() 
{
	document.frm.action = "users_delmulti.php";
	document.frm.submit();		
}
//  page redirection