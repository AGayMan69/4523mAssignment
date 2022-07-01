$(document).ready(function() {
    ajax();
    $(document).click(function() {
        ajax();
    });
    function ajax(){
        $.ajax({
            type:"get",
            url: "getOrderTotal.php",
            dataType:'json',
            success:function(result){
                document.getElementById('subTotalSpan').innerText = result.originalTotal;
                document.getElementById('differenceSpan').innerText = '-'+result.difference;
                document.getElementById('newTotalSpan').innerText = result.newTotal;
            }
        });
    }
});


